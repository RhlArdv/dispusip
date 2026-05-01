<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;

class PublicBukuController extends Controller
{
    public function index(Request $request)
    {
        $query = Buku::published()->with('kategoriBuku');

        // Search global
        if ($request->has('search') && $request->search) {
            $query = $query->globalSearch($request->search);
        }

        // Filter by kategori
        if ($request->has('kategori') && $request->kategori) {
            $query = $query->filterKategori($request->kategori);
        }

        // Filter by penulis
        if ($request->has('penulis') && $request->penulis) {
            $query = $query->searchPenulis($request->penulis);
        }

        // Filter by penerbit
        if ($request->has('penerbit') && $request->penerbit) {
            $query = $query->searchPenerbit($request->penerbit);
        }

        // Filter by tahun
        if ($request->has('tahun') && $request->tahun) {
            $query = $query->filterTahun($request->tahun);
        }

        // Order by latest
        $buku = $query->orderBy('created_at', 'desc')->paginate(12);

        // Get data untuk filter dropdown
        $kategoriBuku = KategoriBuku::active()->ordered()->get();
        $listPenerbit = Buku::select('penerbit')
            ->whereNotNull('penerbit')
            ->distinct()
            ->orderBy('penerbit')
            ->pluck('penerbit');

        $listTahun = Buku::select('tahun_terbit')
            ->whereNotNull('tahun_terbit')
            ->distinct()
            ->orderBy('tahun_terbit', 'desc')
            ->pluck('tahun_terbit');

        return view('public.buku.index', compact(
            'buku',
            'kategoriBuku',
            'listPenerbit',
            'listTahun'
        ));
    }

    public function show($slug)
    {
        $buku = Buku::with('kategoriBuku')
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        // Related books - same category
        $relatedBooks = collect();
        if ($buku->kategori_buku_id) {
            $relatedBooks = Buku::with('kategoriBuku')
                ->where('kategori_buku_id', $buku->kategori_buku_id)
                ->where('id', '!=', $buku->id)
                ->where('is_published', true)
                ->orderBy('created_at', 'desc')
                ->take(4)
                ->get();
        }

        return view('public.buku.show', compact('buku', 'relatedBooks'));
    }
}

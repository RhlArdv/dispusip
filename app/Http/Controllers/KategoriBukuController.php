<?php

namespace App\Http\Controllers;

use App\Models\KategoriBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class KategoriBukuController extends Controller
{
    public function index()
    {
        $kategoriBuku = KategoriBuku::ordered()->get();
        return view('kategori-buku.index', compact('kategoriBuku'));
    }

    public function create()
    {
        return view('kategori-buku.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'slug' => 'nullable|max:100|unique:kategori_buku,slug',
            'deskripsi' => 'nullable',
            'urutan' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $kategoriBuku = new KategoriBuku();
        $kategoriBuku->nama = $request->nama;
        $kategoriBuku->slug = $request->slug ?? Str::slug($request->nama);
        $kategoriBuku->deskripsi = $request->deskripsi;
        $kategoriBuku->urutan = $request->urutan ?? 0;
        $kategoriBuku->is_active = $request->is_active ?? true;
        $kategoriBuku->save();

        return redirect()->route('kategori-buku.index')
            ->with('success', 'Kategori buku berhasil ditambahkan.');
    }

    public function edit(KategoriBuku $kategoriBuku)
    {
        return view('kategori-buku.edit', compact('kategoriBuku'));
    }

    public function update(Request $request, KategoriBuku $kategoriBuku)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'slug' => 'nullable|max:100|unique:kategori_buku,slug,' . $kategoriBuku->id,
            'deskripsi' => 'nullable',
            'urutan' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $kategoriBuku->nama = $request->nama;
        $kategoriBuku->slug = $request->slug ?? Str::slug($request->nama);
        $kategoriBuku->deskripsi = $request->deskripsi;
        $kategoriBuku->urutan = $request->urutan ?? 0;
        $kategoriBuku->is_active = $request->is_active ?? true;
        $kategoriBuku->save();

        return redirect()->route('kategori-buku.index')
            ->with('success', 'Kategori buku berhasil diperbarui.');
    }

    public function destroy(KategoriBuku $kategoriBuku)
    {
        // Cek apakah ada buku yang menggunakan kategori ini
        if ($kategoriBuku->buku()->count() > 0) {
            return redirect()->route('kategori-buku.index')
                ->with('error', 'Kategori buku tidak dapat dihapus karena masih digunakan oleh buku.');
        }

        $kategoriBuku->delete();

        return redirect()->route('kategori-buku.index')
            ->with('success', 'Kategori buku berhasil dihapus.');
    }
}

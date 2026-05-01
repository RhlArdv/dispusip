<?php

namespace App\Http\Controllers;

use App\Models\Infografis;
use App\Models\Berita;
use App\Models\Koleksi;
use App\Models\Testimoni;
use App\Models\Buku;
use Illuminate\Http\Request;

class EPerpusController extends Controller
{
    public function index()
    {
        // 1. Infografis (Slider Hero)
        $infografis = Infografis::where('is_active', true)->orderBy('order')->get();

        // 2. Berita Terbaru (hanya penulis 'pustaka')
        $beritaTerbaru = Berita::whereHas('user', function ($query) {
            $query->where('name', 'like', '%pustaka%');
        })->latest()->take(6)->get();

        // Fallback jika tidak ada penulis bernama 'pustaka'
        if ($beritaTerbaru->isEmpty()) {
            $beritaTerbaru = Berita::latest()->take(6)->get();
        }

        // 3. Buku Terbaru (Koleksi)
        $bukuTerbaru = Koleksi::latest()->take(8)->get();

        // 4. Testimoni Terbaru
        $testimoni = Testimoni::where('is_active', true)->latest()->take(6)->get();

        // 5. Koleksi Per Kategori — ambil semua, kelompokkan per kategori
        //    Tiap kategori max 8 item, diurutkan terbaru
        $koleksiPerKategori = Koleksi::latest()
            ->get()
            ->groupBy(fn($item) => $item->kategori_nama ?? 'Umum')
            ->map(fn($items) => $items->take(8));

        return view('eperpus.index', compact(
            'infografis',
            'beritaTerbaru',
            'bukuTerbaru',
            'testimoni',
            'koleksiPerKategori'
        ));
    }

    public function rekomendasi()
    {

        $buku = Buku::with('kategoriBuku')->latest()->take(10)->get();

        $koleksiPerKategori = Koleksi::latest()
            ->get()
            ->groupBy(fn($item) => $item->kategori_nama ?? 'Umum');

        return view('public.rekomendasi', compact('buku', 'koleksiPerKategori'));
    }

    public function layanan()
    {
        // Karena datanya statis/hardcoded di view, kita cukup return view-nya saja
        return view('public.layanan'); // Sesuaikan path folder view kamu, misal 'eperpus.layanan'
    }
}

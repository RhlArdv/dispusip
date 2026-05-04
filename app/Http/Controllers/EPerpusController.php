<?php

namespace App\Http\Controllers;

use App\Models\Infografis;
use App\Models\Berita;
use App\Models\Koleksi;
use App\Models\Layanan;
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

        // 6. Layanan — ambil dari database
        // Section 'utama'  = Bento Grid (5 item, tidak bisa tambah/hapus, urut by id)
        // Section 'sekunder' = Layanan Perpustakaan (grid seragam, bisa CRUD)
        $layananUtama = Layanan::utama()->aktif()->orderBy('order_number')->get();
        $layananSekunder = Layanan::sekunder()->aktif()->orderBy('order_number')->get();

        return view('eperpus.index', compact(
            'infografis',
            'beritaTerbaru',
            'bukuTerbaru',
            'testimoni',
            'koleksiPerKategori',
            'layananUtama',
            'layananSekunder'
        ));
    }

    public function rekomendasi(Request $request)
    {
        $buku = Buku::with('kategoriBuku')->latest()->take(10)->get();

        $selectedCategory = $request->query('category');

        // Get all unique categories to build the filter tabs
        $categories = Koleksi::select('kategori')
            ->distinct()
            ->get()
            ->map(function ($item) {
                return [
                    'key' => $item->kategori,
                    'name' => $item->kategori_nama
                ];
            });

        $query = Koleksi::latest();

        if ($selectedCategory) {
            $query->where('kategori', $selectedCategory);
        }

        $koleksi = $query->paginate(8)->withQueryString();

        return view('public.rekomendasi', compact('buku', 'koleksi', 'categories', 'selectedCategory'));
    }

    public function layanan()
    {
        $layananUtama = Layanan::utama()->aktif()->orderBy('order_number')->get();
        $layananSekunder = Layanan::sekunder()->aktif()->orderBy('order_number')->get();

        return view('public.layanan', compact('layananUtama', 'layananSekunder'));
    }
}

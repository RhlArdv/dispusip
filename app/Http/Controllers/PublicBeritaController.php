<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class PublicBeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::latest()->paginate(12);
        return view('public.berita', compact('berita'));
    }

    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();
        
        // Dapatkan 3 berita terbaru lainnya untuk rekomendasi (kecuali yang sedang dibaca)
        $relatedBerita = Berita::where('id', '!=', $berita->id)->latest()->take(3)->get();
        
        return view('public.berita-detail', compact('berita', 'relatedBerita'));
    }
}

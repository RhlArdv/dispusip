<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class PublicKegiatanController extends Controller
{
    public function index()
    {
        $kegiatan = Kegiatan::latest()->paginate(12);
        return view('public.kegiatan', compact('kegiatan'));
    }

    public function show($slug)
    {
        $kegiatan = Kegiatan::where('slug', $slug)->firstOrFail();
        
        // Dapatkan 3 kegiatan terbaru lainnya untuk rekomendasi (kecuali yang sedang dibaca)
        $relatedKegiatan = Kegiatan::where('id', '!=', $kegiatan->id)->latest()->take(3)->get();
        
        return view('public.kegiatan-detail', compact('kegiatan', 'relatedKegiatan'));
    }
}

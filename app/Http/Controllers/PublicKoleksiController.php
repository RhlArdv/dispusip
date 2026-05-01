<?php

namespace App\Http\Controllers;

use App\Models\Koleksi;
use Illuminate\Http\Request;

class PublicKoleksiController extends Controller
{
    /**
     * Display the specified collection detail.
     *
     * @param  string  $slug
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        $koleksi = Koleksi::where('slug', $slug)->firstOrFail();
        
        // Ambil koleksi terkait dari kategori yang sama
        $koleksiTerkait = Koleksi::where('kategori', $koleksi->kategori)
            ->where('id', '!=', $koleksi->id)
            ->latest()
            ->take(4)
            ->get();
            
        return view('eperpus.koleksi-detail', compact('koleksi', 'koleksiTerkait'));
    }
}

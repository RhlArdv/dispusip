<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;

class PublicGaleriController extends Controller
{
    public function index()
    {
        $galeri = Galeri::where('is_active', true)->latest()->paginate(12);
        return view('public.galeri', compact('galeri'));
    }

    public function show($slug)
    {
        $galeri = Galeri::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $relatedGaleri = Galeri::where('id', '!=', $galeri->id)
            ->where('is_active', true)
            ->latest()
            ->take(6)
            ->get();

        return view('public.galeri-detail', compact('galeri', 'relatedGaleri'));
    }
}

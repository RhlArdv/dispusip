<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = (object) [
            'total_arsip'  => \App\Models\Arsip::count(),
            'total_berita' => \App\Models\Berita::count(),
            'total_galeri' => \App\Models\Galeri::count(),
            'total_users'  => \App\Models\User::count(),
            'total_layanan'=> \App\Models\Layanan::count(),
        ];

        return view('dashboard', compact('stats'));
    }
}

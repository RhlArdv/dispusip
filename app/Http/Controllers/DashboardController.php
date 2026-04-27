<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Stats placeholder - akan diupdate setelah migrations arsip/berita dll
        $stats = (object) [
            'total_arsip' => 0,
            'total_berita' => 0,
            'total_galeri' => 0,
            'total_users' => \App\Models\User::count(),
        ];

        return view('dashboard', compact('stats'));
    }
}

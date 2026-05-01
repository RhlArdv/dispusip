<?php

namespace App\Http\Controllers;

use App\Models\Pejabat;
use App\Models\ProfilPerpustakaan;

class PublicProfilPerpustakaanController extends Controller
{
    public function index()
    {
        // Load all active E-Perpus profiles keyed by slug
        $profiles = ProfilPerpustakaan::where('is_active', true)
            ->get()
            ->keyBy('slug');

        // Fetch Kabid Perpustakaan: pejabat whose jabatan matches 'Kepala Bidang Perpustakaan'
        $kabidPerpustakaan = Pejabat::active()
            ->where('jabatan', 'like', '%Kepala Bidang Perpustakaan%')
            ->first();

        return view('public.eperpus.profil', compact('profiles', 'kabidPerpustakaan'));
    }
}

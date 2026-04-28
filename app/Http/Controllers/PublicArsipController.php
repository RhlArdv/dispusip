<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use Illuminate\Http\Request;

class PublicArsipController extends Controller
{
    public function index(Request $request)
    {
        $query = Arsip::query();

        // Fitur pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('indeks', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhere('tahun', 'like', "%{$search}%");
            });
        }

        $arsip = $query->orderBy('tahun', 'desc')
                       ->orderBy('id', 'desc')
                       ->paginate(15)
                       ->withQueryString();

        return view('public.arsip', compact('arsip'));
    }
}

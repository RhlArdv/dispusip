<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use Illuminate\Http\Request;

class PublicTestimoniController extends Controller
{
    public function index()
    {
        $testimoni = Testimoni::where('is_active', true)->latest()->paginate(12);

        return view('public.testimoni', compact('testimoni'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\Video;
use Illuminate\Http\Request;

class PublicMultimediaController extends Controller
{
    public function index()
    {
        // Get Galeri items (limited to 8 for the combined view, or use pagination if needed)
        // User said "isinya persis dengan yg di video blade itu cuma bedanya infografisnya cukup 1 aja di paling atas"
        // This implies we show the full list but combined.
        
        $galeri = Galeri::where('is_active', true)->latest()->paginate(8, ['*'], 'galeri_page');
        $videos = Video::where('is_active', true)->latest()->paginate(8, ['*'], 'video_page');

        return view('public.multimedia', compact('galeri', 'videos'));
    }
}

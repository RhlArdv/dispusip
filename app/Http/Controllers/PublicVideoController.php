<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class PublicVideoController extends Controller
{
    public function index()
    {
        $videos = Video::where('is_active', true)->latest()->paginate(12);
        return view('public.video', compact('videos'));
    }

    public function show($slug)
    {
        $video = Video::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $relatedVideos = Video::where('id', '!=', $video->id)
            ->where('is_active', true)
            ->latest()
            ->take(6)
            ->get();

        return view('public.video-detail', compact('video', 'relatedVideos'));
    }
}

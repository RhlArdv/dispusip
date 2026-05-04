@extends('layouts.eperpus')

@section('title', $video->judul_video . ' | E-Perpus DISPUSIP')

@section('content')
<div class="min-h-screen bg-white">
    {{-- Breadcrumb --}}
    <nav class="py-4 px-6 border-b border-gray-200 bg-white sticky top-0 z-50">
        <div class="max-w-7xl mx-auto">
            <ol class="flex items-center gap-2 text-sm">
                <li>
                    <a href="{{ route('home') }}" class="text-gray-500 hover:text-gray-700 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </a>
                </li>
                <li><span class="text-gray-400">/</span></li>
                <li>
                    <a href="{{ route('public.video.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors">Video</a>
                </li>
                <li><span class="text-gray-400">/</span></li>
                <li class="text-gray-900 font-medium truncate max-w-xs">{{ $video->judul_video }}</li>
            </ol>
        </div>
    </nav>

    {{-- Main Content --}}
    <article class="py-12 px-6">
        <div class="max-w-5xl mx-auto">
            {{-- Video Embed --}}
            <div class="aspect-video rounded-[2.5rem] overflow-hidden mb-8 shadow-2xl bg-black">
                <iframe
                    class="w-full h-full"
                    src="https://www.youtube.com/embed/{{ $video->youtube_id }}?rel=0&modestbranding=1"
                    title="{{ $video->judul_video }}"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen>
                </iframe>
            </div>

            {{-- Content --}}
            <div class="text-center mb-8">
                <h1 class="text-4xl md:text-5xl font-black text-navy-900 mb-6 leading-tight">
                    {{ $video->judul_video }}
                </h1>

                @if($video->deskripsi)
                    <div class="max-w-3xl mx-auto">
                        <p class="text-lg text-gray-600 leading-relaxed">
                            {{ $video->deskripsi }}
                        </p>
                    </div>
                @endif

                {{-- Date & YouTube Link --}}
                <div class="flex items-center justify-center gap-6 mt-6 text-sm text-gray-500">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>{{ $video->created_at->format('d M Y') }}</span>
                    </div>
                    <a href="{{ $video->youtube_url }}" target="_blank" rel="noopener noreferrer"
                       class="flex items-center gap-2 text-red-600 hover:text-red-700 font-medium transition-colors">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                        Tonton di YouTube
                    </a>
                </div>
            </div>

            {{-- Back Button --}}
            <div class="flex justify-center mt-12">
                <a href="{{ route('public.video.index') }}"
                   class="inline-flex items-center gap-2 px-6 py-3 bg-navy-900 text-white font-semibold rounded-xl hover:bg-navy-800 transition-colors shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Video
                </a>
            </div>
        </div>
    </article>

    {{-- Related Videos --}}
    @if($relatedVideos->count() > 0)
        <section class="py-20 px-6 bg-slate-50">
            <div class="max-w-7xl mx-auto">
                <div class="flex items-center justify-between mb-12">
                    <div>
                        <span class="text-gold-600 font-bold tracking-[0.2em] uppercase text-xs mb-2 block">Video Lainnya</span>
                        <h2 class="text-3xl md:text-4xl font-black text-navy-900 leading-none">
                            Video Terkait
                        </h2>
                    </div>
                    <a href="{{ route('public.video.index') }}"
                       class="hidden md:inline-flex items-center gap-2 text-navy-900 hover:text-gold-600 transition-colors font-bold border-b-2 border-navy-200 hover:border-gold-500 pb-1">
                        Lihat Semua
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($relatedVideos as $related)
                        <a href="{{ route('public.video.show', $related->slug) }}" class="group block">
                            <div class="bg-white rounded-[2rem] overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 border border-navy-50 group-hover:border-gold-400/30">
                                <!-- Thumbnail -->
                                <div class="aspect-video overflow-hidden bg-navy-900 relative">
                                    <img src="https://img.youtube.com/vi/{{ $related->youtube_id }}/mqdefault.jpg"
                                         alt="{{ $related->judul_video }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">

                                    <!-- Play Button Overlay -->
                                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-80 group-hover:opacity-90 transition-opacity">
                                        <div class="w-14 h-14 rounded-full bg-red-600 flex items-center justify-center shadow-xl transform group-hover:scale-110 transition-transform duration-300">
                                            <svg class="w-7 h-7 text-white ml-1" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M8 5v14l11-7z"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- Content -->
                                <div class="p-6">
                                    <h3 class="text-lg font-black text-navy-900 group-hover:text-gold-600 transition-colors leading-tight line-clamp-2">
                                        {{ $related->judul_video }}
                                    </h3>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</div>
@endsection

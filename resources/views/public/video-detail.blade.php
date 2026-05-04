@extends('layouts.eperpus')

@section('title', $video->judul_video . ' | Video DISPUSIP')

@section('hero_title')
    <h1 class="text-4xl md:text-6xl font-black text-navy-900 tracking-tighter uppercase leading-tight max-w-4xl">
        {{ $video->judul_video }}
    </h1>
@endsection

@section('hero_badge')
    <span class="text-red-600 font-bold">Arsip Visual</span>
@endsection

@section('content')
<div class="min-h-screen bg-white pb-32">
    <div class="max-w-7xl mx-auto px-6">
        {{-- Main Video Player --}}
        <div class="relative -mt-10 mb-20 animate-fade-in-up">
            <div class="aspect-video rounded-[3rem] overflow-hidden shadow-[0_40px_100px_rgba(239,68,68,0.2)] border-8 border-white bg-navy-900">
                <iframe 
                    class="w-full h-full"
                    src="https://www.youtube.com/embed/{{ $video->youtube_id }}?rel=0&modestbranding=1&autoplay=1" 
                    title="{{ $video->judul_video }}" 
                    frameborder="0" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                    allowfullscreen>
                </iframe>
            </div>
            
            {{-- YouTube Badge --}}
            <div class="absolute -top-6 right-10">
                <div class="px-6 py-3 rounded-2xl bg-red-600 text-white text-xs font-black uppercase tracking-[0.2em] shadow-2xl">
                    Now Playing
                </div>
            </div>
        </div>

        {{-- Content Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 mb-32">
            {{-- Main Description --}}
            <div class="lg:col-span-8 animate-fade-in-up delay-100">
                <div class="prose prose-xl prose-navy max-w-none">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 rounded-2xl bg-navy-50 flex items-center justify-center text-red-600">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M10 15.5l5.5-3.5-5.5-3.5v7zM21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9zm-9-10c-5.52 0-10 4.48-10 10s4.48 10 10 10 10-4.48 10-10-4.48-10-10-10z"/></svg>
                        </div>
                        <h2 class="text-3xl font-black text-navy-900 uppercase tracking-tight m-0">Detail Video</h2>
                    </div>
                    <p class="text-navy-600 leading-relaxed text-lg whitespace-pre-line">
                        {{ $video->deskripsi ?? 'Tidak ada deskripsi tambahan untuk video ini.' }}
                    </p>
                </div>
            </div>

            {{-- Sidebar / Stats --}}
            <div class="lg:col-span-4 space-y-8 animate-fade-in-up delay-200">
                <div class="p-8 rounded-[2.5rem] bg-navy-900 text-white shadow-2xl relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-red-500/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
                    <h3 class="text-xl font-black mb-6 uppercase tracking-widest text-red-500">Info Publikasi</h3>
                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-navy-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-navy-400 uppercase tracking-widest">Diupload Pada</p>
                                <p class="font-bold">{{ $video->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                        <a href="https://www.youtube.com/watch?v={{ $video->youtube_id }}" target="_blank" class="flex items-center justify-center gap-3 w-full py-4 bg-red-600 hover:bg-red-700 text-white font-black rounded-2xl transition-all uppercase text-xs tracking-widest">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                            Tonton di YouTube
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Related Videos --}}
        @if($relatedVideos->count() > 0)
            <div class="mt-32">
                <div class="flex items-center gap-4 mb-12">
                    <h3 class="text-3xl font-black text-navy-900 uppercase tracking-tight">Video Terkait</h3>
                    <div class="h-1 flex-grow bg-navy-50"></div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    @foreach($relatedVideos as $related)
                        <a href="{{ route('public.video.show', $related->slug) }}" class="group">
                            <div class="aspect-video rounded-[2.5rem] overflow-hidden bg-navy-900 mb-6 shadow-lg transform group-hover:-translate-y-2 transition-all duration-500 relative">
                                <img src="https://img.youtube.com/vi/{{ $related->youtube_id }}/mqdefault.jpg" alt="{{ $related->judul_video }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 opacity-60">
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <div class="w-12 h-12 rounded-full bg-red-600 flex items-center justify-center text-white shadow-xl transform group-hover:scale-110 transition-all duration-300">
                                        <svg class="w-6 h-6 ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                    </div>
                                </div>
                            </div>
                            <h4 class="text-xl font-black text-navy-900 group-hover:text-red-600 transition-colors leading-tight line-clamp-2">
                                {{ $related->judul_video }}
                            </h4>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

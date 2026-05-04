@extends('layouts.eperpus')

@section('title', 'Multimedia | Galeri & Video DISPUSIP')

@section('hero_title')
    <h1 class="text-5xl md:text-7xl font-black text-navy-900 tracking-tighter uppercase leading-[0.9]">
        Multimedia<br>
        <span class="text-transparent" style="-webkit-text-stroke: 1.5px #0f2440;">Archive</span>
    </h1>
@endsection

@section('content')
<div class="min-h-screen bg-slate-50 relative pb-32">
    
    {{-- Galeri Section --}}
    <section class="py-24 px-6 relative border-b border-navy-50">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row items-end justify-between mb-20 gap-8">
                <div class="animate-fade-in-up">
                    <span class="text-gold-600 font-bold tracking-[0.3em] uppercase text-[10px] mb-4 flex items-center gap-3">
                        <span class="w-12 h-px bg-gold-500"></span> Visual Archive
                    </span>
                    <h2 class="text-4xl md:text-5xl font-black text-navy-900 tracking-tight leading-none uppercase">
                        Galeri <br>Dokumentasi.
                    </h2>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($galeri as $index => $item)
                    <div class="animate-fade-in-up" style="animation-delay: {{ $index * 100 }}ms">
                        <a href="{{ route('public.galeri.show', $item->slug) }}" class="group block relative">
                            <div class="bg-white rounded-[2.5rem] overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 border border-navy-50 transform group-hover:-translate-y-2">
                                <div class="aspect-square overflow-hidden bg-navy-50 relative">
                                    <img src="{{ asset($item->foto_galeri) }}" alt="{{ $item->judul_galeri }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                    <div class="absolute inset-0 bg-navy-950/20 group-hover:bg-transparent transition-colors"></div>
                                </div>
                                <div class="p-6">
                                    <h3 class="text-lg font-black text-navy-900 group-hover:text-gold-600 transition-colors leading-tight line-clamp-2">
                                        {{ $item->judul_galeri }}
                                    </h3>
                                    <p class="text-[10px] font-black text-navy-400 uppercase tracking-widest mt-3">
                                        {{ $item->created_at->format('d M Y') }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-span-full text-center py-20 bg-white rounded-[3rem] border-2 border-dashed border-navy-100">
                        <p class="text-navy-500 font-medium uppercase tracking-widest">Belum ada dokumentasi</p>
                    </div>
                @endforelse
            </div>

            @if($galeri->hasPages())
                <div class="mt-12 flex justify-center">
                    {{ $galeri->appends(['video_page' => $videos->currentPage()])->links('partials.pagination') }}
                </div>
            @endif
        </div>
    </section>

    {{-- Video Section --}}
    <section class="py-24 px-6 relative">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row items-end justify-between mb-20 gap-8">
                <div class="animate-fade-in-up">
                    <span class="text-red-600 font-bold tracking-[0.3em] uppercase text-[10px] mb-4 flex items-center gap-3">
                        <span class="w-12 h-px bg-red-500"></span> Visual Journey
                    </span>
                    <h2 class="text-4xl md:text-5xl font-black text-navy-900 tracking-tight leading-none uppercase">
                        Koleksi <br>Video.
                    </h2>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($videos as $index => $item)
                    <div class="animate-fade-in-up" style="animation-delay: {{ $index * 100 }}ms">
                        <a href="{{ route('public.video.show', $item->slug) }}" class="group block relative">
                            <div class="bg-white rounded-[2.5rem] overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 border border-navy-50 transform group-hover:-translate-y-2">
                                <div class="aspect-video overflow-hidden bg-navy-900 relative">
                                    <img src="https://img.youtube.com/vi/{{ $item->youtube_id }}/mqdefault.jpg" alt="{{ $item->judul_video }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-80 group-hover:opacity-100">
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <div class="w-10 h-10 rounded-full bg-red-600 flex items-center justify-center text-white shadow-lg transform group-hover:scale-110 transition-transform">
                                            <svg class="w-5 h-5 ml-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <h3 class="text-lg font-black text-navy-900 group-hover:text-red-600 transition-colors leading-tight line-clamp-2">
                                        {{ $item->judul_video }}
                                    </h3>
                                    <p class="text-[10px] font-black text-navy-400 uppercase tracking-widest mt-3">
                                        {{ $item->created_at->format('d M Y') }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-span-full text-center py-20 bg-white rounded-[3rem] border-2 border-dashed border-navy-100">
                        <p class="text-navy-500 font-medium uppercase tracking-widest">Belum ada video</p>
                    </div>
                @endforelse
            </div>

            @if($videos->hasPages())
                <div class="mt-12 flex justify-center">
                    {{ $videos->appends(['galeri_page' => $galeri->currentPage()])->links('partials.pagination') }}
                </div>
            @endif
        </div>
    </section>
</div>
@endsection

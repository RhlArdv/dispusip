@extends('layouts.eperpus')

@section('title', 'Video | E-Perpus DISPUSIP')

@section('hero_title')
    <h1 class="text-4xl md:text-6xl lg:text-7xl font-black text-white tracking-tight uppercase leading-[1.1]">
        Video<br>
        <span class="text-transparent bg-clip-text bg-gradient-to-r from-gold-400 to-gold-600">Dokumentasi</span>
    </h1>
@endsection

@section('content')
<div class="min-h-screen bg-slate-50 relative pb-20">
    <!-- Hero Section -->
    <section class="py-24 px-6 bg-white relative">
        <!-- Background Image -->
        <div class="absolute inset-0 bg-cover bg-center bg-fixed opacity-5"
             style="background-image: url('{{ asset('assets/img/kerangka.jpeg') }}');"></div>

        <div class="max-w-7xl mx-auto relative z-10">
            <div class="text-center mb-16">
                <span class="text-gold-600 font-bold tracking-[0.2em] uppercase text-xs mb-4 flex items-center justify-center gap-2">
                    <span class="w-8 h-px bg-gold-500"></span> Arsip Visual <span class="w-8 h-px bg-gold-500"></span>
                </span>
                <h2 class="text-4xl md:text-5xl font-black tracking-tight text-navy-900 leading-none">
                    Video Dokumentasi
                </h2>
                <p class="text-navy-600 mt-6 max-w-2xl mx-auto text-lg">
                    Dokumentasi video kegiatan dan program Dinas Perpustakaan dan Kearsipan
                </p>
            </div>

            <!-- Video Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($videos as $item)
                    <a href="{{ route('public.video.show', $item->slug) }}" class="group block">
                        <div class="bg-white rounded-[2.5rem] overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 border border-navy-50 group-hover:border-gold-400/30">
                            <!-- Thumbnail Container -->
                            <div class="aspect-video overflow-hidden bg-navy-900 relative">
                                <img src="https://img.youtube.com/vi/{{ $item->youtube_id }}/mqdefault.jpg"
                                     alt="{{ $item->judul_video }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">

                                <!-- Play Button Overlay -->
                                <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-80 group-hover:opacity-90 transition-opacity">
                                    <div class="w-16 h-16 rounded-full bg-red-600 flex items-center justify-center shadow-2xl transform group-hover:scale-110 transition-transform duration-300">
                                        <svg class="w-8 h-8 text-white ml-1" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M8 5v14l11-7z"/>
                                        </svg>
                                    </div>
                                </div>

                                <!-- YouTube Badge -->
                                <div class="absolute top-4 right-4 bg-red-600 text-white text-xs font-black px-3 py-1 rounded-full shadow-lg">
                                    YouTube
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-8">
                                <h3 class="text-xl font-black text-navy-900 group-hover:text-gold-600 transition-colors leading-tight line-clamp-2">
                                    {{ $item->judul_video }}
                                </h3>
                                @if($item->deskripsi)
                                    <p class="text-navy-600 mt-3 text-sm line-clamp-2 leading-relaxed">
                                        {{ $item->deskripsi }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-16">
                        <div class="w-20 h-20 rounded-full bg-navy-100 flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-navy-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-black text-navy-900 mb-3">Belum Ada Video</h3>
                        <p class="text-navy-600">Belum ada video dokumentasi yang ditampilkan. Kunjungi lagi nanti!</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($videos->hasPages())
                <div class="mt-16 flex justify-center">
                    {{ $videos->links() }}
                </div>
            @endif
        </div>
    </section>
</div>
@endsection

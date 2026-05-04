@extends('layouts.eperpus')

@section('title', $galeri->judul_galeri . ' | E-Perpus DISPUSIP')

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
                    <a href="{{ route('public.galeri.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors">Galeri</a>
                </li>
                <li><span class="text-gray-400">/</span></li>
                <li class="text-gray-900 font-medium truncate max-w-xs">{{ $galeri->judul_galeri }}</li>
            </ol>
        </div>
    </nav>

    {{-- Main Content --}}
    <article class="py-12 px-6">
        <div class="max-w-5xl mx-auto">
            {{-- Hero Image --}}
            @if($galeri->foto_galeri)
                <div class="aspect-[16/9] rounded-[2.5rem] overflow-hidden mb-8 shadow-2xl">
                    <img src="{{ asset($galeri->foto_galeri) }}"
                         alt="{{ $galeri->judul_galeri }}"
                         class="w-full h-full object-cover">
                </div>
            @endif

            {{-- Content --}}
            <div class="text-center mb-8">
                <h1 class="text-4xl md:text-5xl font-black text-navy-900 mb-6 leading-tight">
                    {{ $galeri->judul_galeri }}
                </h1>

                @if($galeri->deskripsi)
                    <div class="max-w-3xl mx-auto">
                        <p class="text-lg text-gray-600 leading-relaxed">
                            {{ $galeri->deskripsi }}
                        </p>
                    </div>
                @endif

                {{-- Date Info --}}
                <div class="flex items-center justify-center gap-2 mt-6 text-sm text-gray-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>{{ $galeri->created_at->format('d M Y') }}</span>
                </div>
            </div>

            {{-- Back Button --}}
            <div class="flex justify-center mt-12">
                <a href="{{ route('public.galeri.index') }}"
                   class="inline-flex items-center gap-2 px-6 py-3 bg-navy-900 text-white font-semibold rounded-xl hover:bg-navy-800 transition-colors shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Galeri
                </a>
            </div>
        </div>
    </article>

    {{-- Related Galeri --}}
    @if($relatedGaleri->count() > 0)
        <section class="py-20 px-6 bg-slate-50">
            <div class="max-w-7xl mx-auto">
                <div class="flex items-center justify-between mb-12">
                    <div>
                        <span class="text-gold-600 font-bold tracking-[0.2em] uppercase text-xs mb-2 block">Galeri Lainnya</span>
                        <h2 class="text-3xl md:text-4xl font-black text-navy-900 leading-none">
                            Dokumentasi Terkait
                        </h2>
                    </div>
                    <a href="{{ route('public.galeri.index') }}"
                       class="hidden md:inline-flex items-center gap-2 text-navy-900 hover:text-gold-600 transition-colors font-bold border-b-2 border-navy-200 hover:border-gold-500 pb-1">
                        Lihat Semua
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($relatedGaleri as $related)
                        <a href="{{ route('public.galeri.show', $related->slug) }}" class="group block">
                            <div class="bg-white rounded-[2rem] overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 border border-navy-50 group-hover:border-gold-400/30">
                                <!-- Image -->
                                <div class="aspect-[4/3] overflow-hidden bg-navy-50 relative">
                                    <img src="{{ asset($related->foto_galeri) }}"
                                         alt="{{ $related->judul_galeri }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">

                                    <!-- Overlay -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-navy-900/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                                    <!-- View Icon -->
                                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                        <div class="w-14 h-14 rounded-full bg-white/90 backdrop-blur-sm flex items-center justify-center shadow-lg transform scale-50 group-hover:scale-100 transition-transform duration-500">
                                            <svg class="w-7 h-7 text-navy-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- Content -->
                                <div class="p-6">
                                    <h3 class="text-lg font-black text-navy-900 group-hover:text-gold-600 transition-colors leading-tight line-clamp-2">
                                        {{ $related->judul_galeri }}
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

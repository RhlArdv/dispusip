@extends('layouts.eperpus')

@section('title', 'Galeri | E-Perpus DISPUSIP')

@section('hero_title')
    <h1 class="text-4xl md:text-6xl lg:text-7xl font-black text-white tracking-tight uppercase leading-[1.1]">
        Galeri<br>
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
                    <span class="w-8 h-px bg-gold-500"></span> Dokumentasi Visual <span class="w-8 h-px bg-gold-500"></span>
                </span>
                <h2 class="text-4xl md:text-5xl font-black tracking-tight text-navy-900 leading-none">
                    Galeri Kegiatan
                </h2>
                <p class="text-navy-600 mt-6 max-w-2xl mx-auto text-lg">
                    Dokumentasi visual kegiatan dan program Dinas Perpustakaan dan Kearsipan
                </p>
            </div>

            <!-- Gallery Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($galeri as $item)
                    <a href="{{ route('public.galeri.show', $item->slug) }}" class="group block">
                        <div class="bg-white rounded-[2.5rem] overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 border border-navy-50 group-hover:border-gold-400/30">
                            <!-- Image Container -->
                            <div class="aspect-[4/3] overflow-hidden bg-navy-50 relative">
                                <img src="{{ asset($item->foto_galeri) }}"
                                     alt="{{ $item->judul_galeri }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">

                                <!-- Overlay on Hover -->
                                <div class="absolute inset-0 bg-gradient-to-t from-navy-900/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                                <!-- View Icon -->
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                    <div class="w-16 h-16 rounded-full bg-white/90 backdrop-blur-sm flex items-center justify-center shadow-lg transform scale-50 group-hover:scale-100 transition-transform duration-500">
                                        <svg class="w-8 h-8 text-navy-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-8">
                                <h3 class="text-xl font-black text-navy-900 group-hover:text-gold-600 transition-colors leading-tight line-clamp-2">
                                    {{ $item->judul_galeri }}
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
                            <svg class="w-10 h-10 text-navy-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-black text-navy-900 mb-3">Belum Ada Galeri</h3>
                        <p class="text-navy-600">Belum ada dokumentasi yang ditampilkan. Kunjungi lagi nanti!</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($galeri->hasPages())
                <div class="mt-16 flex justify-center">
                    {{ $galeri->links() }}
                </div>
            @endif
        </div>
    </section>
</div>
@endsection

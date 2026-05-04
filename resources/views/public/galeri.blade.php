@extends('layouts.eperpus')

@section('title', 'Galeri Dokumentasi | E-Perpus DISPUSIP')

@section('hero_title')
    <h1 class="text-5xl md:text-7xl font-black text-navy-900 tracking-tighter uppercase leading-[0.9]">
        Galeri<br>
        <span class="text-transparent" style="-webkit-text-stroke: 1.5px #0f2440;">Dokumentasi</span>
    </h1>
@endsection

@section('content')
<div class="min-h-screen bg-slate-50 relative pb-32">
    <!-- Grid Section -->
    <section class="py-24 px-6 relative">
        <div class="max-w-7xl mx-auto">
            {{-- Section Header --}}
            <div class="flex flex-col md:flex-row items-end justify-between mb-20 gap-8">
                <div class="animate-fade-in-up">
                    <span class="text-gold-600 font-bold tracking-[0.3em] uppercase text-[10px] mb-4 flex items-center gap-3">
                        <span class="w-12 h-px bg-gold-500"></span> Visual Archive
                    </span>
                    <h2 class="text-4xl md:text-5xl font-black text-navy-900 tracking-tight leading-none uppercase">
                        Momen & <br>Kegiatan.
                    </h2>
                </div>
                <p class="text-navy-500 font-medium max-w-sm text-lg border-l-2 border-gold-500 pl-6 py-2 animate-fade-in-up delay-100">
                    Dokumentasi visual perjalanan dan aktivitas Dinas Perpustakaan dan Kearsipan Kota Padang.
                </p>
            </div>

            <!-- Gallery Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @forelse($galeri as $index => $item)
                    <div class="animate-fade-in-up" style="animation-delay: {{ $index * 100 }}ms">
                        <a href="{{ route('public.galeri.show', $item->slug) }}" class="group block relative">
                            {{-- Card Container --}}
                            <div class="bg-white rounded-[3rem] overflow-hidden shadow-[0_20px_50px_rgba(15,36,64,0.05)] hover:shadow-[0_40px_80px_rgba(15,36,64,0.15)] transition-all duration-700 border border-navy-50/50 group-hover:border-gold-400/30 transform group-hover:-translate-y-4">
                                
                                {{-- Image Wrapper --}}
                                <div class="aspect-[4/5] overflow-hidden bg-navy-50 relative">
                                    <img src="{{ asset($item->foto_galeri) }}"
                                         alt="{{ $item->judul_galeri }}"
                                         class="w-full h-full object-cover transition-transform duration-[1.5s] ease-out group-hover:scale-110">
                                    
                                    {{-- Glass Overlay --}}
                                    <div class="absolute inset-0 bg-gradient-to-t from-navy-950/80 via-transparent to-transparent opacity-60 group-hover:opacity-40 transition-opacity duration-700"></div>
                                    
                                    {{-- Floating Date/Badge --}}
                                    <div class="absolute top-8 left-8">
                                        <div class="px-4 py-2 rounded-2xl bg-white/10 backdrop-blur-xl border border-white/20 text-white text-[10px] font-black uppercase tracking-widest">
                                            {{ $item->created_at->format('d M Y') }}
                                        </div>
                                    </div>

                                    {{-- Action Icon --}}
                                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500 scale-50 group-hover:scale-100">
                                        <div class="w-20 h-20 rounded-full bg-gold-500 flex items-center justify-center text-navy-900 shadow-2xl">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </div>
                                    </div>
                                </div>

                                {{-- Content --}}
                                <div class="p-10">
                                    <h3 class="text-2xl font-black text-navy-900 group-hover:text-gold-600 transition-colors leading-tight mb-4">
                                        {{ $item->judul_galeri }}
                                    </h3>
                                    <p class="text-navy-500 font-medium text-sm line-clamp-2 leading-relaxed">
                                        {{ $item->deskripsi ?? 'Lihat dokumentasi lengkap kegiatan ini.' }}
                                    </p>
                                    
                                    <div class="mt-8 pt-8 border-t border-navy-50 flex items-center justify-between">
                                        <span class="text-[10px] font-black text-navy-400 uppercase tracking-widest">View Details</span>
                                        <div class="w-8 h-8 rounded-full border border-navy-100 flex items-center justify-center group-hover:bg-navy-900 group-hover:text-white group-hover:border-navy-900 transition-all duration-500">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-32 bg-white rounded-[4rem] border-2 border-dashed border-navy-100">
                        <div class="w-24 h-24 rounded-full bg-navy-50 flex items-center justify-center mx-auto mb-8">
                            <svg class="w-12 h-12 text-navy-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <h3 class="text-3xl font-black text-navy-900 mb-4 uppercase">Belum Ada Dokumentasi</h3>
                        <p class="text-navy-500 font-medium max-w-md mx-auto">Kami sedang mempersiapkan galeri dokumentasi terbaru untuk Anda. Silakan kembali lagi nanti.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($galeri->hasPages())
                <div class="mt-24">
                    {{ $galeri->links('partials.pagination') }}
                </div>
            @endif
        </div>
    </section>
</div>
@endsection

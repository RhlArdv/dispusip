@extends('layouts.eperpus')

@section('title', 'Video Dokumentasi | E-Perpus DISPUSIP')

@section('hero_title')
    <h1 class="text-5xl md:text-7xl font-black text-navy-900 tracking-tighter uppercase leading-[0.9]">
        Video<br>
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
                    <span class="text-red-600 font-bold tracking-[0.3em] uppercase text-[10px] mb-4 flex items-center gap-3">
                        <span class="w-12 h-px bg-red-500"></span> Visual Journey
                    </span>
                    <h2 class="text-4xl md:text-5xl font-black text-navy-900 tracking-tight leading-none uppercase">
                        Arsip <br>Visual.
                    </h2>
                </div>
                <p class="text-navy-500 font-medium max-w-sm text-lg border-l-2 border-red-500 pl-6 py-2 animate-fade-in-up delay-100">
                    Koleksi video dokumentasi kegiatan, sosialisasi, dan program unggulan Dinas Perpustakaan dan Kearsipan.
                </p>
            </div>

            <!-- Video Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @forelse($videos as $index => $item)
                    <div class="animate-fade-in-up" style="animation-delay: {{ $index * 100 }}ms">
                        <a href="{{ route('public.video.show', $item->slug) }}" class="group block relative">
                            {{-- Card Container --}}
                            <div class="bg-white rounded-[3rem] overflow-hidden shadow-[0_20px_50px_rgba(15,36,64,0.05)] hover:shadow-[0_40px_80px_rgba(15,36,64,0.15)] transition-all duration-700 border border-navy-50/50 group-hover:border-red-400/30 transform group-hover:-translate-y-4">
                                
                                {{-- Video Thumbnail Wrapper --}}
                                <div class="aspect-video overflow-hidden bg-navy-900 relative">
                                    <img src="https://img.youtube.com/vi/{{ $item->youtube_id }}/maxresdefault.jpg"
                                         onerror="this.src='https://img.youtube.com/vi/{{ $item->youtube_id }}/mqdefault.jpg'"
                                         alt="{{ $item->judul_video }}"
                                         class="w-full h-full object-cover transition-transform duration-[1.5s] ease-out group-hover:scale-110">
                                    
                                    {{-- Play Button Overlay --}}
                                    <div class="absolute inset-0 bg-navy-950/40 flex items-center justify-center opacity-80 group-hover:opacity-60 transition-all duration-500">
                                        <div class="w-20 h-20 rounded-full bg-red-600 flex items-center justify-center text-white shadow-2xl transform group-hover:scale-110 transition-all duration-500">
                                            <svg class="w-8 h-8 ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                        </div>
                                    </div>
                                    
                                    {{-- YouTube Badge --}}
                                    <div class="absolute top-8 right-8">
                                        <div class="px-4 py-2 rounded-2xl bg-red-600 text-white text-[10px] font-black uppercase tracking-widest shadow-lg">
                                            YouTube
                                        </div>
                                    </div>
                                </div>

                                {{-- Content --}}
                                <div class="p-10">
                                    <h3 class="text-2xl font-black text-navy-900 group-hover:text-red-600 transition-colors leading-tight mb-4">
                                        {{ $item->judul_video }}
                                    </h3>
                                    <p class="text-navy-500 font-medium text-sm line-clamp-2 leading-relaxed">
                                        {{ $item->deskripsi ?? 'Tonton video dokumentasi kegiatan lengkap di sini.' }}
                                    </p>
                                    
                                    <div class="mt-8 pt-8 border-t border-navy-50 flex items-center justify-between">
                                        <span class="text-[10px] font-black text-navy-400 uppercase tracking-widest">Watch Now</span>
                                        <div class="w-8 h-8 rounded-full border border-navy-100 flex items-center justify-center group-hover:bg-red-600 group-hover:text-white group-hover:border-red-600 transition-all duration-500">
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
                            <svg class="w-12 h-12 text-navy-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <h3 class="text-3xl font-black text-navy-900 mb-4 uppercase">Belum Ada Video</h3>
                        <p class="text-navy-500 font-medium max-w-md mx-auto">Kami sedang mengunggah video dokumentasi terbaru. Silakan kembali lagi nanti.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($videos->hasPages())
                <div class="mt-24">
                    {{ $videos->links('partials.pagination') }}
                </div>
            @endif
        </div>
    </section>
</div>
@endsection

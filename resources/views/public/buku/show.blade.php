@extends('layouts.public')

@section('title', $buku->judul)

@section('content')
<div class="min-h-screen bg-slate-50 pb-20">

    {{-- Dynamic Overlapping Header Background --}}
    <div class="relative h-[45vh] lg:h-[55vh] min-h-[300px] w-full bg-slate-900 overflow-hidden">
        {{-- Blur backdrop from cover --}}
        @if($buku->sampul_url)
            <div class="absolute inset-0 bg-cover bg-center opacity-30 blur-2xl scale-110" style="background-image: url('{{ $buku->sampul_url }}')"></div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/80 to-transparent"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-transparent to-transparent"></div>
        
        {{-- Floating Nav --}}
        <div class="absolute top-0 inset-x-0 z-20 py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <a href="{{ route('public.buku.index') }}" class="inline-flex items-center gap-2 text-white/90 hover:text-white transition-colors group bg-white/10 hover:bg-white/20 backdrop-blur-md px-4 py-2 rounded-full text-sm font-medium border border-white/10">
                    <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali ke Katalog
                </a>
            </div>
        </div>
    </div>

    {{-- Main Content - Negative Margin Overlap --}}
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-[25vh] lg:-mt-[35vh]">
        <div class="flex flex-col lg:flex-row gap-8 lg:gap-12">
            
            {{-- Left Column: Cover & Primary Actions --}}
            <div class="lg:w-1/3 xl:w-1/4 flex-shrink-0">
                <div class="sticky top-28">
                    {{-- Cover Image --}}
                    <div class="aspect-[3/4] rounded-3xl overflow-hidden shadow-2xl shadow-black/40 border-4 border-white/10 bg-slate-800 mb-6 group">
                        @if($buku->sampul_url)
                            <img src="{{ $buku->sampul_url }}" alt="{{ $buku->judul }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-500">
                                <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            </div>
                        @endif
                    </div>

                    {{-- Actions (Desktop) --}}
                    <div class="space-y-3 bg-white p-5 rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 hidden lg:block">
                        @if($buku->file_pdf)
                            <a href="{{ $buku->pdf_url }}" target="_blank" class="flex items-center justify-center gap-2 w-full py-3.5 px-4 bg-rose-600 hover:bg-rose-700 text-white font-bold rounded-2xl transition-all shadow-lg shadow-rose-500/30 hover:shadow-rose-500/50 active:scale-95 group">
                                <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                                Baca PDF Sekarang
                            </a>
                            <a href="{{ $buku->pdf_url }}" download class="flex items-center justify-center gap-2 w-full py-3.5 px-4 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold rounded-2xl transition-all active:scale-95">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                Download PDF
                            </a>
                        @else
                            <div class="text-center py-4 text-slate-500 text-sm font-medium flex flex-col items-center gap-2">
                                <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                File PDF tidak tersedia
                            </div>
                        @endif

                        @if($buku->sumber)
                            <a href="{{ $buku->sumber }}" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center gap-2 w-full py-3 px-4 text-indigo-600 hover:text-indigo-700 hover:bg-indigo-50 font-semibold rounded-2xl transition-colors text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                Lihat Sumber Asli
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Right Column: Details --}}
            <div class="lg:w-2/3 xl:w-3/4 flex flex-col gap-6">
                {{-- Title & Metadata Box --}}
                <div class="bg-white rounded-3xl p-6 md:p-10 shadow-xl shadow-slate-200/50 border border-slate-100">
                    @if($buku->kategoriBuku)
                        <span class="inline-flex px-3 py-1.5 bg-indigo-50 text-indigo-700 font-bold text-xs uppercase tracking-wider rounded-lg mb-4 border border-indigo-100">
                            {{ $buku->kategoriBuku->nama }}
                        </span>
                    @endif
                    
                    <h1 class="text-3xl md:text-5xl font-extrabold text-slate-900 leading-tight mb-4">
                        {{ $buku->judul }}
                    </h1>

                    @if($buku->penulis)
                        <p class="text-lg md:text-xl text-slate-600 font-medium mb-8">
                            Oleh <span class="text-slate-900">{{ $buku->penulis }}</span>
                        </p>
                    @endif

                    {{-- Data Grid --}}
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 p-5 bg-slate-50 rounded-2xl border border-slate-100">
                        @if($buku->penerbit)
                        <div>
                            <p class="text-[10px] md:text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Penerbit</p>
                            <p class="font-semibold text-slate-800">{{ $buku->penerbit }}</p>
                        </div>
                        @endif
                        @if($buku->tahun_terbit)
                        <div>
                            <p class="text-[10px] md:text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Tahun</p>
                            <p class="font-semibold text-slate-800">{{ $buku->tahun_terbit }}</p>
                        </div>
                        @endif
                        @if($buku->isbn)
                        <div>
                            <p class="text-[10px] md:text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">ISBN</p>
                            <p class="font-semibold text-slate-800 text-sm font-mono">{{ $buku->isbn }}</p>
                        </div>
                        @endif
                        <div>
                            <p class="text-[10px] md:text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Ditambahkan</p>
                            <p class="font-semibold text-slate-800">{{ $buku->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>

                {{-- Mobile Actions (Visible only on mobile/tablet) --}}
                <div class="lg:hidden bg-white p-5 rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 space-y-3">
                    @if($buku->file_pdf)
                        <a href="{{ $buku->pdf_url }}" target="_blank" class="flex items-center justify-center gap-2 w-full py-4 px-4 bg-rose-600 active:bg-rose-700 text-white font-bold rounded-2xl transition-all shadow-lg shadow-rose-500/30">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                            Baca PDF Sekarang
                        </a>
                        <a href="{{ $buku->pdf_url }}" download class="flex items-center justify-center gap-2 w-full py-3.5 px-4 bg-slate-100 active:bg-slate-200 text-slate-700 font-semibold rounded-2xl transition-all border border-slate-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            Download PDF
                        </a>
                    @else
                        <div class="text-center py-4 text-slate-500 text-sm font-medium flex flex-col items-center gap-2">
                            <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            File PDF tidak tersedia
                        </div>
                    @endif

                    @if($buku->sumber)
                        <a href="{{ $buku->sumber }}" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center gap-2 w-full py-3 px-4 text-indigo-600 hover:bg-indigo-50 font-semibold rounded-2xl transition-colors text-sm border border-indigo-100">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            Lihat Sumber Asli
                        </a>
                    @endif
                </div>

                {{-- Abstrak --}}
                @if($buku->abstrak)
                <div class="bg-white rounded-3xl p-6 md:p-10 shadow-sm border border-slate-100">
                    <h2 class="text-xl md:text-2xl font-bold text-slate-900 mb-5 flex items-center gap-3">
                        <span class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/></svg>
                        </span>
                        Abstrak
                    </h2>
                    <p class="text-slate-600 leading-relaxed md:text-lg">{{ $buku->abstrak }}</p>
                </div>
                @endif

                {{-- Uraian --}}
                @if($buku->uraian)
                <div class="bg-white rounded-3xl p-6 md:p-10 shadow-sm border border-slate-100">
                    <h2 class="text-xl md:text-2xl font-bold text-slate-900 mb-5 flex items-center gap-3">
                        <span class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </span>
                        Informasi Tambahan
                    </h2>
                    <div class="prose prose-lg prose-slate max-w-none prose-headings:font-bold prose-a:text-indigo-600 prose-img:rounded-xl">
                        {!! $buku->uraian !!}
                    </div>
                </div>
                @endif

                {{-- Related Books --}}
                @if($relatedBooks->count() > 0)
                <div class="mt-4">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-slate-900">Mungkin Anda Suka</h2>
                        @if($buku->kategori_buku_id)
                        <a href="{{ route('public.buku.index', ['kategori' => $buku->kategori_buku_id]) }}" class="text-indigo-600 hover:text-indigo-800 font-semibold text-sm flex items-center gap-1 group">
                            Lihat Kategori <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                        @endif
                    </div>
                    
                    {{-- Horizontal Scroll on Mobile, Grid on Desktop --}}
                    <div class="flex overflow-x-auto pb-8 -mx-4 px-4 sm:mx-0 sm:px-0 sm:grid sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6 snap-x snap-mandatory hide-scrollbar">
                        @foreach($relatedBooks as $related)
                            <a href="{{ route('public.buku.show', $related->slug) }}" class="group w-[200px] sm:w-auto flex-shrink-0 snap-start flex flex-col bg-white rounded-3xl p-3 shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                                <div class="aspect-[3/4] rounded-2xl overflow-hidden bg-slate-100 mb-4 relative shadow-inner">
                                    @if($related->sampul_url)
                                        <img src="{{ $related->sampul_url }}" alt="{{ $related->judul }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-slate-300 bg-slate-50">
                                            <svg class="w-10 h-10 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                        </div>
                                    @endif
                                </div>
                                <h3 class="font-bold text-sm text-slate-900 line-clamp-2 group-hover:text-indigo-600 transition-colors leading-snug mb-1">
                                    {{ $related->judul }}
                                </h3>
                                @if($related->penulis)
                                    <p class="text-xs text-slate-500 line-clamp-1 mt-auto font-medium">{{ $related->penulis }}</p>
                                @endif
                            </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
/* Hide scrollbar for horizontal scroll on mobile */
.hide-scrollbar::-webkit-scrollbar {
    display: none;
}
.hide-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>
@endsection

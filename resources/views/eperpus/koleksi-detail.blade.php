@extends('layouts.eperpus')

@section('title', $koleksi->judul_koleksi . ' | E-Perpus DISPUSIP Padang')

@section('content')
    <!-- Header Section -->
    <section class="pt-32 pb-12 px-6 bg-[#F8FAFC]">
        <div class="max-w-5xl mx-auto">
            <a href="{{ route('eperpus.index') }}" class="inline-flex items-center gap-2 text-navy-500 hover:text-gold-600 transition-colors font-semibold text-sm mb-8">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke E-Perpus
            </a>
            
            <div class="flex items-center gap-3 mb-6">
                <span class="px-3 py-1 bg-gold-500 text-navy-900 rounded-full text-xs font-black uppercase tracking-widest">{{ $koleksi->kategori_nama }}</span>
                <span class="text-navy-500 font-medium text-sm">Ditambahkan pada {{ $koleksi->created_at->translatedFormat('d F Y') }}</span>
            </div>
            
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-navy-900 leading-[1.1] tracking-tight mb-8">
                {{ $koleksi->judul_koleksi }}
            </h1>
        </div>
    </section>

    <!-- Main Content -->
    <section class="pb-24 px-6 bg-white relative border-t border-navy-50">
        <div class="max-w-5xl mx-auto py-12 flex flex-col md:flex-row gap-12 items-start">
            
            <!-- Left Sidebar: Cover Image & Action -->
            <div class="w-full md:w-1/3 md:sticky md:top-32 flex flex-col gap-6">
                @if($koleksi->cover_image)
                    <div class="rounded-3xl overflow-hidden shadow-2xl border border-navy-50 bg-navy-50 aspect-[3/4]">
                        <img src="{{ $koleksi->cover_image }}" alt="{{ $koleksi->judul_koleksi }}" class="w-full h-full object-cover">
                    </div>
                @else
                    <div class="rounded-3xl overflow-hidden shadow-2xl border border-navy-50 bg-navy-100 aspect-[3/4] flex items-center justify-center">
                        <svg class="w-24 h-24 text-navy-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                @endif

                @if($koleksi->link)
                    <a href="{{ $koleksi->link }}" target="_blank" rel="noopener noreferrer" class="w-full py-4 bg-navy-900 text-white font-bold rounded-2xl hover:bg-gold-500 hover:text-navy-900 transition-all shadow-md hover:shadow-lg flex items-center justify-center gap-2 transform hover:-translate-y-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                        Akses Koleksi
                    </a>
                @endif
            </div>

            <!-- Right Content: Description -->
            <div class="w-full md:w-2/3">
                <h3 class="text-2xl font-black text-navy-900 mb-6 uppercase tracking-tight">Sinopsis & Deskripsi</h3>
                
                <div class="prose prose-lg max-w-none text-navy-700 leading-relaxed 
                            prose-headings:font-black prose-headings:text-navy-900 
                            prose-a:text-gold-600 hover:prose-a:text-gold-500
                            prose-img:rounded-2xl prose-img:shadow-sm">
                    @if($koleksi->isi_koleksi)
                        {!! $koleksi->isi_koleksi !!}
                    @else
                        <p class="text-navy-400 italic">Deskripsi belum tersedia untuk koleksi ini.</p>
                    @endif
                </div>

                <!-- Share Section -->
                <div class="mt-16 pt-8 border-t border-navy-100 flex flex-col sm:flex-row items-center gap-6">
                    <h4 class="font-bold text-navy-900 text-lg">Bagikan Koleksi Ini:</h4>
                    <div class="flex gap-4">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="w-10 h-10 rounded-full bg-navy-50 text-navy-600 flex items-center justify-center hover:bg-gold-500 hover:text-white transition-all">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path></svg>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($koleksi->judul_koleksi) }}" target="_blank" class="w-10 h-10 rounded-full bg-navy-50 text-navy-600 flex items-center justify-center hover:bg-gold-500 hover:text-white transition-all">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path></svg>
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($koleksi->judul_koleksi . ' ' . request()->fullUrl()) }}" target="_blank" class="w-10 h-10 rounded-full bg-navy-50 text-navy-600 flex items-center justify-center hover:bg-gold-500 hover:text-white transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Koleksi -->
    @if($koleksiTerkait->count() > 0)
    <section class="py-20 px-6 bg-[#F8FAFC] border-t border-navy-50">
        <div class="max-w-5xl mx-auto">
            <div class="flex items-center justify-between mb-12">
                <h3 class="text-3xl font-black text-navy-900 tracking-tight uppercase">Koleksi Terkait</h3>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($koleksiTerkait as $terkait)
                <a href="{{ route('public.koleksi.show', $terkait->slug) }}" class="group bg-white rounded-2xl overflow-hidden border border-navy-100 hover:border-gold-300 hover:shadow-xl transition-all duration-400 flex flex-col">
                    <div class="relative aspect-[3/4] bg-navy-50 overflow-hidden flex-shrink-0">
                        @if($terkait->cover_image)
                            <img src="{{ $terkait->cover_image }}" alt="{{ $terkait->judul_koleksi }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center gap-2 bg-gradient-to-br from-navy-100 to-navy-200">
                                <svg class="w-8 h-8 text-navy-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-navy-900/0 group-hover:bg-navy-900/10 transition-colors duration-300"></div>
                    </div>
                    <div class="p-4 flex-1 flex flex-col justify-between">
                        <h3 class="text-sm font-bold text-navy-900 line-clamp-2 leading-snug group-hover:text-gold-600 transition-colors mb-2">
                            {{ $terkait->judul_koleksi }}
                        </h3>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif
@endsection

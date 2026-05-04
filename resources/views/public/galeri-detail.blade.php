@extends('layouts.eperpus')

@section('title', $galeri->judul_galeri . ' | Galeri DISPUSIP')

@section('hero_title')
    <h1 class="text-4xl md:text-6xl font-black text-navy-900 tracking-tighter uppercase leading-tight max-w-4xl">
        {{ $galeri->judul_galeri }}
    </h1>
@endsection

@section('hero_badge')
    <span class="text-gold-600 font-bold">Dokumentasi Kegiatan</span>
@endsection

@section('content')
<div class="min-h-screen bg-white pb-32">
    <div class="max-w-7xl mx-auto px-6">
        {{-- Main Feature Image --}}
        <div class="relative -mt-10 mb-20 animate-fade-in-up">
            <div class="aspect-[16/9] md:aspect-[21/9] rounded-[3rem] overflow-hidden shadow-[0_40px_100px_rgba(15,36,64,0.2)] border-8 border-white bg-navy-50">
                <img src="{{ asset($galeri->foto_galeri) }}" 
                     alt="{{ $galeri->judul_galeri }}"
                     class="w-full h-full object-cover">
            </div>
            
            {{-- Floating Info Card --}}
            <div class="absolute -bottom-10 right-10 hidden md:block">
                <div class="bg-white/90 backdrop-blur-2xl p-8 rounded-[2rem] shadow-2xl border border-navy-50 max-w-xs">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-gold-500 flex items-center justify-center text-navy-900">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-navy-400 uppercase tracking-widest">Tanggal</p>
                            <p class="font-bold text-navy-900">{{ $galeri->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Content Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 mb-32">
            {{-- Main Description --}}
            <div class="lg:col-span-8 animate-fade-in-up delay-100">
                <div class="prose prose-xl prose-navy max-w-none">
                    <h2 class="text-3xl font-black text-navy-900 mb-8 uppercase tracking-tight">Tentang Kegiatan</h2>
                    <p class="text-navy-600 leading-relaxed text-lg whitespace-pre-line">
                        {{ $galeri->deskripsi ?? 'Tidak ada deskripsi tambahan untuk kegiatan ini.' }}
                    </p>
                </div>
            </div>

            {{-- Sidebar / Stats --}}
            <div class="lg:col-span-4 space-y-8 animate-fade-in-up delay-200">
                <div class="p-8 rounded-[2.5rem] bg-navy-900 text-white shadow-2xl relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gold-500/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
                    <h3 class="text-xl font-black mb-6 uppercase tracking-widest text-gold-500">Bagikan</h3>
                    <div class="flex gap-4">
                        <button class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center hover:bg-gold-500 hover:text-navy-900 transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </button>
                        <button class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center hover:bg-gold-500 hover:text-navy-900 transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.336 3.608 1.31.974.974 1.248 2.242 1.31 3.608.058 1.266.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.062 1.366-.336 2.633-1.31 3.608-.974.974-2.242 1.248-3.608 1.31-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.366-.062-2.633-.336-3.608-1.31-.974-.974-1.248-2.242-1.31-3.608-.058-1.266-.07-1.646-.07-4.85s.012-3.584.07-4.85c.062-1.366.336-2.633 1.31-3.608.974-.974 2.242-1.248 3.608-1.31 1.266-.058 1.646-.07 4.85-.07zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948s.014 3.667.072 4.947c.2 4.337 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072s3.667-.014 4.947-.072c4.337-.2 6.78-2.618 6.98-6.98.058-1.281.072-1.689.072-4.948s-.014-3.667-.072-4.947c-.2-4.358-2.618-6.78-6.98-6.98-1.28-.058-1.689-.072-4.948-.072zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4s1.791-4 4-4 4 1.791 4 4-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Related Items --}}
        @if($relatedGaleri->count() > 0)
            <div class="mt-32">
                <div class="flex items-center gap-4 mb-12">
                    <h3 class="text-3xl font-black text-navy-900 uppercase tracking-tight">Dokumentasi Lainnya</h3>
                    <div class="h-1 flex-grow bg-navy-50"></div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    @foreach($relatedGaleri as $related)
                        <a href="{{ route('public.galeri.show', $related->slug) }}" class="group">
                            <div class="aspect-square rounded-[2.5rem] overflow-hidden bg-navy-50 mb-6 shadow-lg transform group-hover:-translate-y-2 transition-all duration-500">
                                <img src="{{ asset($related->foto_galeri) }}" alt="{{ $related->judul_galeri }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            </div>
                            <h4 class="text-xl font-black text-navy-900 group-hover:text-gold-600 transition-colors leading-tight line-clamp-2">
                                {{ $related->judul_galeri }}
                            </h4>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

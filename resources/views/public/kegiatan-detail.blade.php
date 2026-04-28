@extends('layouts.public')

@section('title', $kegiatan->title . ' | DISPUSIP Padang')

@section('content')
    <!-- Article Header -->
    <section class="pt-32 pb-12 px-6 bg-[#F8FAFC]">
        <div class="max-w-4xl mx-auto">
            <a href="{{ route('public.kegiatan.index') }}" class="inline-flex items-center gap-2 text-navy-500 hover:text-gold-600 transition-colors font-semibold text-sm mb-8">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Agenda Kegiatan
            </a>
            
            <div class="flex items-center gap-3 mb-6">
                <span class="px-3 py-1 bg-gold-100 text-gold-700 rounded-full text-xs font-black uppercase tracking-widest">Kegiatan</span>
                <span class="text-navy-500 font-medium text-sm">{{ $kegiatan->created_at->translatedFormat('l, d F Y') }}</span>
            </div>
            
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-navy-900 leading-[1.1] tracking-tight mb-8">
                {{ $kegiatan->title }}
            </h1>
            
            <div class="flex items-center gap-4 py-6 border-y border-navy-100">
                <div class="w-12 h-12 rounded-full bg-navy-100 text-navy-600 flex items-center justify-center font-bold text-lg">
                    {{ substr($kegiatan->user->name ?? 'A', 0, 1) }}
                </div>
                <div>
                    <p class="text-sm font-bold text-navy-900 uppercase tracking-wider">Ditulis oleh</p>
                    <p class="text-navy-600 font-medium">{{ $kegiatan->user->name ?? 'Admin DISPUSIP' }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Article Content -->
    <section class="pb-24 px-6 bg-white relative">
        <div class="max-w-4xl mx-auto -mt-8 relative z-10">
            @if($kegiatan->cover_image || $kegiatan->foto)
            <div class="rounded-[2rem] overflow-hidden mb-12 shadow-lg border border-navy-50 bg-navy-50">
                <img src="{{ $kegiatan->cover_image ?? asset('storage/' . $kegiatan->foto) }}" alt="{{ $kegiatan->title }}" class="w-full object-cover max-h-[600px]">
            </div>
            @endif

            <div class="prose prose-lg md:prose-xl max-w-none text-navy-700 leading-relaxed 
                        prose-headings:font-black prose-headings:text-navy-900 
                        prose-a:text-gold-600 hover:prose-a:text-gold-500
                        prose-img:rounded-2xl prose-img:shadow-sm">
                {!! $kegiatan->content !!}
            </div>

            <!-- Share Section -->
            <div class="mt-16 pt-8 border-t border-navy-100 flex flex-col md:flex-row items-center justify-between gap-6">
                <h4 class="font-bold text-navy-900 text-lg">Bagikan Informasi Ini:</h4>
                <div class="flex gap-4">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="w-12 h-12 rounded-full bg-navy-50 text-navy-600 flex items-center justify-center hover:bg-gold-500 hover:text-white transition-all">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path></svg>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($kegiatan->title) }}" target="_blank" class="w-12 h-12 rounded-full bg-navy-50 text-navy-600 flex items-center justify-center hover:bg-gold-500 hover:text-white transition-all">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path></svg>
                    </a>
                    <a href="https://wa.me/?text={{ urlencode($kegiatan->title . ' ' . request()->fullUrl()) }}" target="_blank" class="w-12 h-12 rounded-full bg-navy-50 text-navy-600 flex items-center justify-center hover:bg-gold-500 hover:text-white transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Kegiatan -->
    @if($relatedKegiatan->count() > 0)
    <section class="py-20 px-6 bg-[#F8FAFC] border-t border-navy-50">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center justify-between mb-12">
                <h3 class="text-3xl font-black text-navy-900 tracking-tight">Kegiatan Lainnya</h3>
                <a href="{{ route('public.kegiatan.index') }}" class="text-gold-600 font-bold hover:text-gold-500 hidden sm:block">Lihat Semua</a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($relatedKegiatan as $item)
                <a href="{{ route('public.kegiatan.show', $item->slug) }}" class="group block bg-white rounded-[2rem] p-4 shadow-sm hover:shadow-lg transition-all duration-300 border border-navy-50">
                    @if($item->cover_image || $item->foto)
                        <div class="aspect-[4/3] rounded-2xl overflow-hidden mb-4">
                            <img src="{{ $item->cover_image ?? asset('storage/' . $item->foto) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                    @else
                        <div class="aspect-[4/3] rounded-2xl bg-navy-900 mb-4 flex items-center justify-center">
                            <svg class="w-10 h-10 text-gold-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    @endif
                    <div class="px-2 pb-2">
                        <p class="text-xs font-bold text-gold-600 uppercase tracking-widest mb-2">{{ $item->created_at->format('d M Y') }}</p>
                        <h4 class="text-lg font-bold text-navy-900 group-hover:text-gold-500 transition-colors line-clamp-2 leading-snug">{{ $item->title }}</h4>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif
@endsection

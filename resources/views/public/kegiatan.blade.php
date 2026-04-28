@extends('layouts.public')

@section('title', 'Agenda & Kegiatan Terkini | DISPUSIP Padang')

@section('content')
    <!-- Header Section -->
    <section class="pt-40 pb-16 px-6 bg-[#F8FAFC]">
        <div class="max-w-7xl mx-auto text-center opacity-0 animate-fade-in-up">
            <h1 class="text-5xl md:text-7xl font-black tracking-tight text-navy-900 uppercase">Agenda <span class="text-transparent bg-clip-text bg-gradient-to-r from-gold-400 to-gold-600">Kegiatan</span></h1>
            <p class="text-navy-500 font-medium mt-6 text-lg max-w-2xl mx-auto">Dokumentasi berbagai aktivitas, program, dan acara terbaru dari Dinas Perpustakaan dan Kearsipan Kota Padang.</p>
        </div>
    </section>

    <!-- Kegiatan Grid Section -->
    <section class="pb-32 px-6 bg-[#F8FAFC]">
        <div class="max-w-7xl mx-auto opacity-0 animate-fade-in-up delay-100">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                @forelse($kegiatan as $item)
                    <a href="{{ route('public.kegiatan.show', $item->slug) }}" class="group cursor-pointer block">
                        @if($item->cover_image || $item->foto)
                            <div class="aspect-[4/3] rounded-[2rem] overflow-hidden mb-6 bg-navy-50 shadow-sm border border-navy-100">
                                <img src="{{ $item->cover_image ?? asset('storage/' . $item->foto) }}" alt="{{ $item->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                            </div>
                        @else
                            <div
                                class="aspect-[4/3] rounded-[2rem] overflow-hidden mb-6 bg-navy-900 flex items-center justify-center relative shadow-sm border border-navy-100">
                                <div class="absolute inset-0 bg-gradient-to-br from-navy-800 to-navy-950"></div>
                                <svg class="w-16 h-16 text-gold-400 relative z-10 group-hover:scale-110 transition-transform duration-500"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                        <div class="flex items-center gap-3 mb-4">
                            <span
                                class="px-3 py-1 border border-gold-200 bg-gold-50 text-[10px] font-black text-gold-700 uppercase tracking-widest rounded-full">Kegiatan</span>
                            <span
                                class="text-sm font-semibold text-navy-400">{{ $item->created_at->format('d M Y') }}</span>
                        </div>
                        <h3
                            class="text-2xl font-black text-navy-900 group-hover:text-gold-500 transition-colors leading-tight mb-3">
                            {{ $item->title }}</h3>
                        <p class="text-navy-600 text-sm font-medium line-clamp-3">
                            {{ Str::limit(strip_tags(html_entity_decode($item->content)), 150) }}</p>
                    </a>
                @empty
                    <div class="col-span-full text-center py-20 bg-white rounded-3xl shadow-sm border border-navy-100">
                        <div class="w-20 h-20 bg-navy-50 rounded-full flex items-center justify-center mx-auto mb-4 text-navy-300">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-navy-900 mb-2">Belum Ada Kegiatan</h3>
                        <p class="text-navy-500 font-medium">Informasi agenda terbaru akan segera diperbarui di halaman ini.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination Wrapper -->
            @if($kegiatan->hasPages())
                <div class="mt-16 bg-white p-6 rounded-[2rem] shadow-sm border border-navy-100">
                    {{ $kegiatan->links('partials.pagination') }}
                </div>
            @endif
        </div>
    </section>

@endsection

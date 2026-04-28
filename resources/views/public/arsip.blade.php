@extends('layouts.public')

@section('title', 'Katalog Arsip Publik | DISPUSIP Padang')

@section('content')
    <!-- Header Section -->
    <section class="pt-40 pb-16 px-6 bg-[#F8FAFC]">
        <div class="max-w-7xl mx-auto text-center opacity-0 animate-fade-in-up">
            <h1 class="text-5xl md:text-7xl font-black tracking-tight text-navy-900 uppercase">Katalog <span class="text-transparent bg-clip-text bg-gradient-to-r from-gold-400 to-gold-600">Arsip</span></h1>
            <p class="text-navy-500 font-medium mt-6 text-lg max-w-2xl mx-auto">Penelusuran arsip statis kesejarahan dan dokumen otentik daerah secara terbuka untuk publik.</p>
        </div>
    </section>

    <!-- Arsip List Section -->
    <section class="pb-32 px-6 bg-[#F8FAFC]">
        <div class="max-w-7xl mx-auto opacity-0 animate-fade-in-up delay-100">
            
            <!-- Search Bar -->
            <div class="bg-white p-4 rounded-3xl shadow-sm border border-navy-100 mb-8 max-w-2xl mx-auto">
                <form action="{{ route('public.arsip.index') }}" method="GET" class="flex items-center gap-3">
                    <div class="flex-1 relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-navy-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan indeks, deskripsi, atau tahun..."
                               class="w-full pl-11 pr-4 py-3 bg-gray-50 border-transparent focus:bg-white focus:border-gold-500 focus:ring-2 focus:ring-gold-500/20 rounded-2xl text-navy-900 font-medium transition-all">
                    </div>
                    <button type="submit" class="px-6 py-3 bg-navy-900 text-white font-bold rounded-2xl hover:bg-navy-800 transition-colors shrink-0">
                        Cari Arsip
                    </button>
                    @if(request('search'))
                        <a href="{{ route('public.arsip.index') }}" class="px-4 py-3 bg-red-50 text-red-600 font-bold rounded-2xl hover:bg-red-100 transition-colors shrink-0" title="Reset">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </a>
                    @endif
                </form>
            </div>

            <!-- Table Card -->
            <div class="bg-white rounded-[2rem] shadow-sm border border-navy-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left whitespace-nowrap">
                        <thead>
                            <tr class="bg-navy-50/50 border-b border-navy-100">
                                <th class="px-6 py-4 text-xs font-bold text-navy-900 uppercase tracking-widest">No</th>
                                <th class="px-6 py-4 text-xs font-bold text-navy-900 uppercase tracking-widest">Tahun</th>
                                <th class="px-6 py-4 text-xs font-bold text-navy-900 uppercase tracking-widest">Indeks / Masalah</th>
                                <th class="px-6 py-4 text-xs font-bold text-navy-900 uppercase tracking-widest">Deskripsi</th>
                                <th class="px-6 py-4 text-xs font-bold text-navy-900 uppercase tracking-widest">Tk. Perkembangan</th>
                                <th class="px-6 py-4 text-xs font-bold text-navy-900 uppercase tracking-widest">Jumlah</th>
                                <th class="px-6 py-4 text-xs font-bold text-navy-900 uppercase tracking-widest">Lokasi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-navy-50">
                            @forelse($arsip as $index => $item)
                                <tr class="hover:bg-navy-50/30 transition-colors">
                                    <td class="px-6 py-4 text-sm font-medium text-navy-500">
                                        {{ $arsip->firstItem() + $index }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex px-3 py-1 bg-gold-50 text-gold-700 font-bold text-xs rounded-full">
                                            {{ $item->tahun ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-bold text-navy-900">
                                        {{ $item->indeks ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium text-navy-600 max-w-xs truncate" title="{{ $item->deskripsi }}">
                                        {{ $item->deskripsi ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium text-navy-600">
                                        {{ $item->tingkat_perkembangan_display }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-bold text-navy-900">
                                        {{ $item->jumlah ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium text-navy-600">
                                        {{ $item->lokasi_display }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-16 text-center">
                                        <div class="w-16 h-16 bg-navy-50 rounded-full flex items-center justify-center mx-auto mb-4 text-navy-300">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                        </div>
                                        <p class="text-navy-900 font-bold text-lg mb-1">Pencarian Tidak Ditemukan</p>
                                        <p class="text-navy-500 text-sm">Coba gunakan kata kunci yang berbeda atau hapus filter pencarian.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($arsip->hasPages())
                    <div class="p-6 border-t border-navy-50 bg-white">
                        {{ $arsip->links('partials.pagination') }}
                    </div>
                @endif
            </div>
            
        </div>
    </section>
@endsection

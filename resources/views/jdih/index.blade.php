@extends('layouts.public')

@section('title', 'Produk Hukum JDIH | DISPUSIP')

@section('content')
<!-- Hero Section -->
<div class="relative pt-32 pb-20 lg:pt-40 lg:pb-28 overflow-hidden bg-navy-50">
    <!-- Decorative background elements -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0">
        <div class="absolute -top-[20%] -right-[10%] w-[50%] h-[50%] rounded-full bg-gold-400/20 blur-[120px] animate-pulse-slow"></div>
        <div class="absolute top-[20%] -left-[10%] w-[40%] h-[40%] rounded-full bg-navy-400/20 blur-[100px] animate-float"></div>
        <div class="absolute bottom-0 left-0 w-full h-full bg-grid opacity-50"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/60 backdrop-blur-md border border-navy-100 shadow-sm mb-8 animate-fade-in-up">
            <span class="flex h-2 w-2 rounded-full bg-green-500 animate-pulse"></span>
            <span class="text-sm font-bold text-navy-800 tracking-wide">TERINTEGRASI JDIH KOTA PADANG</span>
        </div>
        
        <h1 class="text-5xl md:text-7xl font-black text-navy-950 tracking-tight mb-6 animate-fade-in-up delay-100 font-serif">
            Produk <span class="text-transparent bg-clip-text bg-gradient-to-r from-gold-500 to-gold-600">Hukum</span><br/>
            <span class="text-3xl md:text-5xl font-sans">Perpustakaan & Kearsipan</span>
        </h1>
        
        <p class="text-lg text-navy-600/80 max-w-2xl mx-auto mb-10 animate-fade-in-up delay-200">
            Kumpulan peraturan, keputusan, dan produk hukum terkait perpustakaan dan kearsipan di lingkungan Pemerintah Kota Padang.
        </p>
    </div>
</div>

<!-- Main Content -->
<div class="relative z-20 -mt-8 max-w-7xl mx-auto px-6 pb-24">
    @if(session('success'))
        <div class="bg-green-100 border border-green-200 text-green-800 px-6 py-4 rounded-2xl mb-8 flex items-center gap-3 shadow-sm animate-fade-in-up">
            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Search & Filter Card -->
    <div class="bento-card rounded-3xl p-6 lg:p-8 mb-12 animate-fade-in-up delay-300">
        <form method="GET" action="{{ route('jdih.index') }}" class="flex flex-col md:flex-row gap-4">
            <div class="relative flex-1">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-navy-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" name="q" value="{{ $query }}" placeholder="Cari judul peraturan..." class="w-full pl-12 pr-4 py-4 bg-navy-50/50 border border-navy-100 rounded-2xl focus:bg-white focus:ring-2 focus:ring-gold-400 focus:border-transparent transition-all outline-none text-navy-900 font-medium">
            </div>
            
            <div class="flex gap-4 md:w-auto w-full">
                <!-- Wrapper for select to add custom arrow -->
                <div class="relative w-full md:w-48">
                    <select name="jenis" class="w-full h-full px-4 py-4 bg-navy-50/50 border border-navy-100 rounded-2xl focus:bg-white focus:ring-2 focus:ring-gold-400 focus:border-transparent transition-all outline-none text-navy-900 font-medium appearance-none pr-10">
                        <option value="">Semua Jenis</option>
                        @foreach($jenisOptions as $j)
                            <option value="{{ $j }}" @selected($jenis === $j)>{{ $j }}</option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                        <svg class="w-4 h-4 text-navy-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>
                
                <div class="relative w-full md:w-36">
                    <select name="tahun" class="w-full h-full px-4 py-4 bg-navy-50/50 border border-navy-100 rounded-2xl focus:bg-white focus:ring-2 focus:ring-gold-400 focus:border-transparent transition-all outline-none text-navy-900 font-medium appearance-none pr-10">
                        <option value="">Semua Tahun</option>
                        @foreach($tahunOptions as $t)
                            <option value="{{ $t }}" @selected($tahun === $t)>{{ $t }}</option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                        <svg class="w-4 h-4 text-navy-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>
            </div>

            <button type="submit" class="bg-navy-900 hover:bg-navy-800 text-white px-8 py-4 rounded-2xl font-bold transition-all shadow-lg hover:shadow-navy-900/20 hover:-translate-y-0.5 whitespace-nowrap flex items-center justify-center gap-2">
                <span>Cari</span>
            </button>
        </form>
    </div>

    <!-- Stats & Refresh -->
    <div class="flex flex-col sm:flex-row justify-between items-center mb-8 gap-4 animate-fade-in-up delay-400">
        <p class="text-navy-600 font-medium bg-white/60 px-4 py-2 rounded-full border border-navy-100 shadow-sm text-sm">
            Menampilkan <strong class="text-navy-900 font-black text-base">{{ $total }}</strong> produk hukum
            @if($query || $jenis || $tahun)
                <span class="text-navy-500">yang sesuai filter</span>
            @endif
        </p>
        <a href="{{ route('jdih.refresh') }}" class="inline-flex items-center gap-2 text-sm font-bold text-navy-700 bg-white hover:bg-navy-50 border border-navy-200 px-5 py-2.5 rounded-full transition-all shadow-sm hover:shadow-md group">
            <svg class="w-4 h-4 group-hover:rotate-180 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
            Perbarui Data JDIH
        </a>
    </div>

    <!-- Cards Grid -->
    @if($total > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($peraturan as $i => $item)
                <div class="group relative bg-white rounded-3xl p-6 border border-navy-100 shadow-sm hover:shadow-2xl hover:shadow-navy-900/5 hover:-translate-y-1 transition-all duration-300 flex flex-col animate-fade-in-up" style="animation-delay: {{ 300 + ($i % 10) * 50 }}ms">
                    <!-- Decorative corner gradient -->
                    <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-bl from-gold-100/50 to-transparent rounded-tr-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                    <!-- Top Badges -->
                    <div class="flex flex-wrap gap-2 mb-4 relative z-10">
                        @if($item['jenis'])
                            <span class="px-3 py-1 bg-navy-50 text-navy-700 text-[11px] font-bold tracking-wider rounded-full border border-navy-100 uppercase">{{ $item['singkatanJenis'] ?? $item['jenis'] }}</span>
                        @endif
                        @if($item['tahun_pengundangan'])
                            <span class="px-3 py-1 bg-gold-50 text-gold-700 text-[11px] font-bold tracking-wider rounded-full border border-gold-100">{{ $item['tahun_pengundangan'] }}</span>
                        @endif
                        @if($item['status'])
                            <span class="px-3 py-1 text-[11px] font-bold tracking-wider rounded-full border uppercase {{ $item['status'] === 'Masih Berlaku' ? 'bg-green-50 text-green-700 border-green-200' : 'bg-red-50 text-red-700 border-red-200' }}">
                                {{ $item['status'] }}
                            </span>
                        @endif
                    </div>

                    <!-- Ref Number -->
                    @if($item['noPanggil'])
                        <div class="text-xs font-bold text-navy-400 mb-2 tracking-widest uppercase">NO. {{ $item['noPeraturan'] }}</div>
                    @endif

                    <!-- Title -->
                    <h3 class="text-lg font-bold text-navy-900 leading-snug mb-5 group-hover:text-gold-600 transition-colors line-clamp-3 flex-1 relative z-10">
                        {{ Str::title(strtolower($item['judul'])) }}
                    </h3>

                    <!-- Meta Details -->
                    <div class="space-y-2 mb-6 relative z-10 bg-navy-50/50 rounded-2xl p-4 border border-navy-100/50">
                        @if($item['tanggal_pengundangan'])
                            <div class="flex items-start gap-3 text-sm text-navy-700 font-medium">
                                <svg class="w-4 h-4 mt-0.5 text-gold-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span>{{ \Carbon\Carbon::parse($item['tanggal_pengundangan'])->translatedFormat('d F Y') }}</span>
                            </div>
                        @endif
                        @if($item['penerbit'])
                            <div class="flex items-start gap-3 text-sm text-navy-700 font-medium">
                                <svg class="w-4 h-4 mt-0.5 text-gold-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m3-4h1m-1 4h1m-5 8h8"></path></svg>
                                <span class="line-clamp-1">{{ $item['penerbit'] }}</span>
                            </div>
                        @endif
                        @if($item['bidangHukum'])
                            <div class="flex items-start gap-3 text-sm text-navy-700 font-medium">
                                <svg class="w-4 h-4 mt-0.5 text-gold-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>
                                <span class="line-clamp-1">{{ $item['bidangHukum'] }}</span>
                            </div>
                        @endif
                    </div>

                    <!-- Footer Actions -->
                    <div class="pt-2 flex items-center justify-between gap-3 mt-auto relative z-10">
                        @if($item['urlDetailPeraturan'])
                            <a href="{{ $item['urlDetailPeraturan'] }}" target="_blank" class="text-sm font-bold text-navy-600 hover:text-navy-900 flex items-center gap-1.5 transition-colors">
                                <span>Detail</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                            </a>
                        @endif

                        @if($item['urlDownload'])
                            <a href="{{ $item['urlDownload'] }}" target="_blank" class="bg-navy-900 hover:bg-gold-400 text-white hover:text-navy-900 text-sm font-bold px-4 py-2.5 rounded-xl flex items-center gap-2 transition-all shadow-sm hover:shadow-md transform hover:-translate-y-0.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                <span>Unduh PDF</span>
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white/80 backdrop-blur-sm rounded-3xl border border-navy-100 p-12 text-center shadow-sm max-w-2xl mx-auto animate-fade-in-up delay-500">
            <div class="w-24 h-24 bg-navy-50 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-navy-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <h3 class="text-2xl font-bold text-navy-900 mb-3">Tidak ada peraturan ditemukan</h3>
            <p class="text-navy-600">Coba sesuaikan kata kunci, jenis, atau tahun pada filter pencarian di atas untuk menemukan dokumen yang Anda cari.</p>
        </div>
    @endif
</div>
@endsection
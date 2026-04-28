@extends('layouts.public')

@section('title', 'DISPUSIP | Dinas Perpustakaan dan Kearsipan')

@section('content')
    <!-- Super Premium Hero Section -->
    <main class="relative z-10 pt-40 pb-20 px-6 min-h-screen flex items-center overflow-hidden bg-[#F8FAFC]">
        <!-- Background Layer -->
        <div class="absolute inset-0 bg-grid opacity-60 z-0"></div>
        <div
            class="absolute top-0 right-0 w-[800px] h-[800px] bg-gold-200/40 rounded-full mix-blend-multiply filter blur-[120px] opacity-70 animate-pulse-slow translate-x-1/3 -translate-y-1/4 z-0">
        </div>
        <div
            class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-navy-200/40 rounded-full mix-blend-multiply filter blur-[100px] opacity-70 translate-y-1/3 -translate-x-1/4 z-0">
        </div>

        <div class="max-w-[90rem] mx-auto w-full relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">

                <!-- Left: Typography & Actions -->
                <div class="col-span-1 lg:col-span-6 relative">
                    <div
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-navy-100 bg-white/80 backdrop-blur-md mb-8 shadow-sm opacity-0 animate-fade-in-up">
                        <span class="w-2 h-2 rounded-full bg-gold-500 animate-ping"></span>
                        <span class="text-[10px] sm:text-xs font-black tracking-widest text-navy-900 uppercase">Pemerintah
                            Kota Padang</span>
                    </div>

                    <h1
                        class="text-6xl lg:text-[5.5rem] xl:text-[6.5rem] font-black leading-[0.85] tracking-tighter text-navy-900 uppercase opacity-0 animate-fade-in-up delay-100">
                        Dinas<br>
                        <span
                            class="text-transparent bg-clip-text bg-gradient-to-br from-navy-500 to-navy-900">Perpustakaan</span><br>
                        <div class="flex items-center gap-4 mt-4">
                            <span
                                class="text-gold-500 italic font-serif lowercase text-6xl lg:text-[6rem] xl:text-[7rem] translate-y-1 md:translate-y-2">dan</span>
                            <span class="relative z-10 text-navy-900">
                                Kearsipan
                                <!-- Asymmetric underline -->
                                <svg class="absolute w-[110%] h-4 -bottom-1 -left-2 text-gold-400/50 -z-10"
                                    viewBox="0 0 100 20" preserveAspectRatio="none">
                                    <path d="M0,10 Q50,20 100,10" stroke="currentColor" stroke-width="8" fill="none" />
                                </svg>
                            </span>
                        </div>
                    </h1>

                    <p
                        class="mt-8 text-lg font-medium text-navy-600 max-w-md leading-relaxed opacity-0 animate-fade-in-up delay-200">
                        Eksplorasi ribuan koleksi literatur dan telusuri arsip otentik sejarah daerah dalam satu
                        ekosistem digital terpadu.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 mt-10 relative z-20 opacity-0 animate-fade-in-up delay-300">
                        <a href="#"
                            class="px-8 py-4 bg-navy-900 text-white font-bold rounded-full hover:bg-navy-800 transition-all duration-300 text-center text-base shadow-[0_10px_20px_rgba(15,36,64,0.3)] hover:shadow-[0_15px_30px_rgba(15,36,64,0.4)] transform hover:-translate-y-1 flex items-center justify-center gap-3 group">
                            <span>Mulai Telusuri</span>
                            <span
                                class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center group-hover:bg-gold-500 group-hover:text-navy-900 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </span>
                        </a>
                        <a href="{{ route('public.arsip.index') }}"
                            class="px-8 py-4 bg-white/80 backdrop-blur-md border border-navy-200 text-navy-900 font-bold rounded-full hover:bg-white hover:border-gold-400 transition-all duration-300 text-center text-base shadow-sm flex items-center justify-center gap-2">
                            <span>Jaringan Arsip</span>
                        </a>
                    </div>
                </div>

                <!-- Right: The Hyper-Modern Floating Composition -->
                <div
                    class="col-span-1 lg:col-span-6 relative h-[450px] sm:h-[550px] lg:h-[700px] flex items-center justify-center perspective mt-10 lg:mt-0 opacity-0 animate-fade-in-up delay-400">

                    <!-- Main Big Image (Library) -->
                    <div
                        class="absolute right-0 lg:right-10 w-[85%] h-[75%] rounded-[2.5rem] overflow-hidden shadow-2xl animate-float border-[8px] border-white bg-navy-100 z-10 rotate-3 hover:rotate-0 transition-transform duration-700 ease-out">
                        <img src="https://images.unsplash.com/photo-1541963463532-d68292c34b19?auto=format&fit=crop&q=80&w=1200"
                            alt="Library Interior" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-navy-900/90 via-navy-900/20 to-transparent">
                        </div>
                        <div class="absolute bottom-6 right-6 lg:bottom-8 lg:right-8 text-right">
                            <span
                                class="px-3 py-1 bg-gold-400/20 backdrop-blur-md text-gold-400 border border-gold-400/30 text-xs font-bold rounded-full uppercase tracking-wider mb-3 inline-block">Ekosistem
                                Digital</span>
                            <h3 class="text-white text-2xl lg:text-3xl font-black">Ruang Baca Interaktif</h3>
                        </div>
                    </div>

                    <!-- Smaller Floating Image (Archive) in front -->
                    <a href="#">
                        <div
                            class="absolute left-0 bottom-[5%] lg:bottom-[10%] w-48 h-56 lg:w-56 lg:h-64 rounded-[2rem] overflow-hidden shadow-[0_20px_50px_rgba(15,36,64,0.3)] animate-float delay-200 border-[6px] border-white bg-gold-100 z-20 -rotate-6 hover:rotate-0 transition-transform duration-700 ease-out cursor-pointer group">
                            <img src="https://images.unsplash.com/photo-1568667256549-094345857637?auto=format&fit=crop&q=80&w=500"
                                alt="Archive Document"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div
                                class="absolute inset-0 bg-navy-900/40 group-hover:bg-navy-900/20 transition-colors duration-500">
                            </div>
                            <div class="absolute inset-0 flex flex-col items-center justify-center p-4 text-center">
                                <div
                                    class="w-10 h-10 lg:w-12 lg:h-12 rounded-full bg-gold-400/90 backdrop-blur-sm flex items-center justify-center text-navy-900 shadow-lg mb-3">
                                    <svg class="w-5 h-5 lg:w-6 lg:h-6" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                </div>
                                <h4 class="text-white font-black text-base lg:text-lg">LAVAS</h4>
                            </div>
                        </div>
                    </a>

                    <!-- Floating Glass Stat Card -->
                    <div
                        class="absolute top-[5%] left-[5%] lg:top-[10%] lg:left-[10%] bg-white/90 backdrop-blur-xl p-4 lg:p-5 rounded-2xl shadow-xl z-30 animate-float delay-100 border border-white/50 flex items-center gap-4">
                        <div
                            class="w-10 h-10 lg:w-12 lg:h-12 rounded-xl bg-gradient-to-br from-gold-400 to-gold-500 flex items-center justify-center text-navy-900 shadow-inner">
                            <svg class="w-5 h-5 lg:w-6 lg:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl lg:text-3xl font-black text-navy-900 tracking-tight">50K+</p>
                            <p
                                class="text-[10px] lg:text-[0.65rem] font-bold text-navy-500 uppercase tracking-widest mt-0.5">
                                Koleksi Digital</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <!-- The Tilted Marquee (Gen Z vibe) -->
    <div
        class="relative w-full bg-white py-6 lg:py-8 border-y-[8px] border-gold-400 shadow-2xl transform -rotate-2 scale-105 my-12 z-20 flex overflow-hidden">
        <div class="animate-marquee whitespace-nowrap flex items-center gap-8 lg:gap-12 shrink-0">
            <span class="text-4xl md:text-6xl font-black uppercase text-transparent tracking-wider"
                style="-webkit-text-stroke: 2px #0f2440;">LITERASI UNTUK SEMUA</span>
            <span class="text-gold-500 text-4xl lg:text-5xl">✦</span>
            <span class="text-4xl md:text-6xl font-black uppercase text-navy-900 tracking-wider drop-shadow-sm">RUANG
                BELAJAR INTERAKTIF</span>
            <span class="text-gold-500 text-4xl lg:text-5xl">✦</span>
            <span class="text-4xl md:text-6xl font-black uppercase text-transparent tracking-wider"
                style="-webkit-text-stroke: 2px #f59e0b;">PELESTARIAN SEJARAH</span>
            <span class="text-gold-500 text-4xl lg:text-5xl">✦</span>
            <span class="text-4xl md:text-6xl font-black uppercase text-navy-900 tracking-wider drop-shadow-sm">AKSES
                INFORMASI MUDAH</span>
            <span class="text-gold-500 text-4xl lg:text-5xl">✦</span>
        </div>
        <div class="animate-marquee whitespace-nowrap flex items-center gap-8 lg:gap-12 shrink-0 ml-8 lg:ml-12"
            aria-hidden="true">
            <span class="text-4xl md:text-6xl font-black uppercase text-transparent tracking-wider"
                style="-webkit-text-stroke: 2px #0f2440;">LITERASI UNTUK SEMUA</span>
            <span class="text-gold-500 text-4xl lg:text-5xl">✦</span>
            <span class="text-4xl md:text-6xl font-black uppercase text-navy-900 tracking-wider drop-shadow-sm">RUANG
                BELAJAR INTERAKTIF</span>
            <span class="text-gold-500 text-4xl lg:text-5xl">✦</span>
            <span class="text-4xl md:text-6xl font-black uppercase text-transparent tracking-wider"
                style="-webkit-text-stroke: 2px #f59e0b;">PELESTARIAN SEJARAH</span>
            <span class="text-gold-500 text-4xl lg:text-5xl">✦</span>
            <span class="text-4xl md:text-6xl font-black uppercase text-navy-900 tracking-wider drop-shadow-sm">AKSES
                INFORMASI MUDAH</span>
            <span class="text-gold-500 text-4xl lg:text-5xl">✦</span>
        </div>
    </div>

    <!-- Expressive Bento Services Section -->
    <section class="py-24 lg:py-32 px-6 bg-white relative">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row items-end justify-between mb-16 gap-8">
                <div>
                    <span class="text-navy-500 font-bold tracking-[0.2em] uppercase text-xs mb-4 flex items-center gap-2">
                        <span class="w-8 h-px bg-gold-500"></span> Ekosistem Digital
                    </span>
                    <h2 class="text-5xl md:text-7xl font-black text-navy-900 tracking-tighter uppercase leading-none">
                        Fasilitas<br>
                        <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-gold-400 to-gold-600">Publik.</span>
                    </h2>
                </div>
                <p
                    class="text-navy-500 font-medium max-w-sm text-lg md:text-right border-l-2 md:border-l-0 md:border-r-2 border-gold-500 pl-4 md:pl-0 md:pr-4 py-2">
                    Akses cepat ke fasilitas utama perpustakaan dan kearsipan daerah secara terintegrasi.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 auto-rows-[320px]">

                <!-- Card 1: OPAC (Span 7) -->
                <a href="https://inlislite.pdg.web.id/opac" target="_blank"
                    class="block col-span-1 md:col-span-7 rounded-[2.5rem] overflow-hidden relative group cursor-pointer shadow-[0_20px_50px_rgba(15,36,64,0.1)]">
                    <img src="https://images.unsplash.com/photo-1507842217343-583bb7270b66?auto=format&fit=crop&q=80&w=1200"
                        class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-navy-900/60 group-hover:bg-navy-900/40 transition-colors duration-500">
                    </div>
                    <div class="absolute inset-0 flex flex-col justify-between p-8 lg:p-10">
                        <div class="flex justify-between items-start">
                            <span
                                class="px-4 py-2 rounded-full bg-white/20 backdrop-blur-md text-white text-xs font-bold uppercase tracking-widest border border-white/30">Katalog</span>
                            <div
                                class="w-12 h-12 rounded-full bg-gold-500 flex items-center justify-center text-navy-900 transform -rotate-45 group-hover:rotate-0 transition-transform duration-500 shadow-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-4xl font-black text-white mb-2">OPAC & E-Library</h3>
                            <p class="text-navy-100 font-medium max-w-md">Eksplorasi dan pinjam ribuan koleksi literatur
                                digital secara instan dari mana saja.</p>
                        </div>
                    </div>
                </a>

                <!-- Card 2: Keanggotaan (Span 5) -->
                <a href="https://inlislite.pdg.web.id/pendaftaran" target="_blank"
                    class="block col-span-1 md:col-span-5 bg-gradient-to-br from-gold-400 to-gold-500 rounded-[2.5rem] p-8 lg:p-10 relative overflow-hidden group cursor-pointer hover:shadow-[0_20px_50px_rgba(245,158,11,0.3)] transition-shadow duration-500">
                    <div
                        class="absolute -right-10 -top-10 text-9xl font-black text-navy-900/10 group-hover:rotate-12 transition-transform duration-700">
                        <svg class="w-64 h-64" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2">
                            </path>
                        </svg>
                    </div>
                    <div class="relative z-10 flex flex-col justify-between h-full">
                        <span
                            class="px-4 py-2 rounded-full bg-navy-900/10 text-navy-900 border border-navy-900/20 text-xs font-bold uppercase tracking-widest w-fit">Registrasi</span>
                        <div>
                            <h3 class="text-4xl font-black text-navy-900 mb-2">Daftar Anggota</h3>
                            <p class="text-navy-900/80 font-medium mb-6">Gabung sekarang dan nikmati seluruh akses
                                layanan eksklusif kami.</p>
                            <span
                                class="inline-flex items-center gap-2 pb-1 border-b-2 border-navy-900 text-navy-900 font-bold uppercase tracking-widest text-sm hover:gap-4 transition-all w-fit">
                                Daftar Sekarang <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </span>
                        </div>
                    </div>
                </a>

                <!-- Card 3: Arsip (Span 12) -->
                <div
                    class="col-span-1 md:col-span-12 bg-navy-900 rounded-[2.5rem] p-8 lg:p-12 relative overflow-hidden group cursor-pointer flex flex-col md:flex-row items-start md:items-center justify-between gap-8 hover:shadow-[0_20px_50px_rgba(15,36,64,0.3)] transition-shadow duration-500">
                    <div
                        class="absolute top-0 right-0 w-96 h-96 bg-gold-500/20 rounded-full blur-[80px] -translate-y-1/2 translate-x-1/3 group-hover:bg-gold-500/30 transition-colors duration-700">
                    </div>

                    <div class="relative z-10 max-w-2xl">
                        <div class="flex items-center gap-4 mb-6">
                            <span
                                class="px-4 py-2 rounded-full bg-white/10 text-white border border-white/20 text-xs font-bold uppercase tracking-widest">Penelusuran</span>
                            <span
                                class="px-4 py-2 rounded-full bg-gold-500 text-navy-900 text-xs font-bold uppercase tracking-widest">SIKN</span>
                        </div>
                        <h3 class="text-4xl md:text-5xl font-black text-white mb-4">Jaringan Informasi<br>Arsip Nasional
                        </h3>
                        <p class="text-navy-200 font-medium text-lg leading-relaxed max-w-xl">Pusat penelusuran arsip
                            statis kesejarahan dan dokumen otentik daerah terintegrasi skala nasional.</p>
                    </div>

                    <a href="{{ route('public.arsip.index') }}"
                        class="relative z-10 shrink-0 w-20 h-20 md:w-32 md:h-32 rounded-full bg-white/10 border border-white/20 backdrop-blur-sm flex items-center justify-center text-white group-hover:bg-gold-500 group-hover:text-navy-900 group-hover:border-gold-500 transition-all duration-500">
                        <svg class="w-10 h-10 md:w-12 md:h-12 transform -rotate-45 group-hover:rotate-0 transition-transform duration-500"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                </div>

            </div>
        </div>
    </section>

    <!-- Highlighted Kegiatan Section -->
    <section class="py-24 lg:py-32 px-6 bg-[#F8FAFC] relative overflow-hidden">
        <div class="absolute inset-0 bg-grid opacity-30 z-0"></div>
        <div class="max-w-7xl mx-auto relative z-10">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-8">
                <div>
                    <span class="text-gold-600 font-bold tracking-[0.2em] uppercase text-xs mb-4 flex items-center gap-2">
                        <span class="w-8 h-px bg-gold-500"></span> Agenda & Kegiatan
                    </span>
                    <h2 class="text-4xl md:text-6xl font-black tracking-tight text-navy-900 leading-none">Aktivitas<br>Dinas
                        Terkini</h2>
                </div>
                <a href="{{ route('public.kegiatan.index') }}"
                    class="inline-flex items-center gap-2 text-navy-900 hover:text-gold-600 transition-colors font-bold text-lg border-b-2 border-navy-200 hover:border-gold-500 pb-1">
                    Semua Kegiatan <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3">
                        </path>
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 auto-rows-[250px] md:auto-rows-[300px]">
                @forelse($kegiatanTerbaru as $index => $kegiatan)
                    <a href="{{ route('public.kegiatan.show', $kegiatan->slug) }}"
                        class="group relative rounded-3xl overflow-hidden bg-white shadow-[0_10px_30px_rgba(15,36,64,0.05)] hover:shadow-[0_20px_40px_rgba(15,36,64,0.15)] transition-all duration-500 block {{ $index === 0 ? 'md:col-span-2 md:row-span-2' : '' }}">
                        <div class="w-full h-full relative">
                            @if($kegiatan->cover_image)
                                <img src="{{ $kegiatan->cover_image }}" alt="{{ $kegiatan->title }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-in-out">
                            @else
                                <div class="w-full h-full bg-navy-800 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-navy-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                            @endif
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-navy-900/95 via-navy-900/40 to-transparent opacity-90 group-hover:opacity-100 transition-opacity duration-500">
                            </div>
                        </div>

                        <div
                            class="absolute bottom-0 left-0 right-0 p-6 {{ $index === 0 ? 'md:p-10' : '' }} transform translate-y-2 group-hover:translate-y-0 transition-transform duration-500">
                            <div class="flex items-center gap-3 mb-3">
                                <span
                                    class="px-3 py-1 bg-gold-500 text-navy-900 text-[10px] font-black uppercase tracking-widest rounded-full">Kegiatan</span>
                                <span
                                    class="text-white/80 text-xs font-semibold tracking-wider">{{ $kegiatan->created_at->format('d M Y') }}</span>
                            </div>
                            <h3
                                class="text-white font-black leading-tight {{ $index === 0 ? 'text-3xl md:text-4xl mb-4' : 'text-lg md:text-xl mb-1' }} group-hover:text-gold-400 transition-colors">
                                {{ $kegiatan->title }}
                            </h3>
                            @if($index === 0)
                                <p class="text-white/70 text-base font-medium line-clamp-2 hidden md:block">
                                    {{ Str::limit(strip_tags(html_entity_decode($kegiatan->content)), 150) }}
                                </p>
                            @endif
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-16 bg-white rounded-3xl border border-navy-50 shadow-sm">
                        <div class="w-16 h-16 bg-navy-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-navy-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                </path>
                            </svg>
                        </div>
                        <p class="text-navy-500 font-medium text-lg">Belum ada aktivitas dinas terbaru saat ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Editorial News Section -->
    <section class="py-24 lg:py-32 px-6 bg-white border-t border-navy-50">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-8">
                <div>
                    <h2 class="text-4xl md:text-6xl font-black tracking-tight text-navy-900">Kabar Terbaru</h2>
                    <p class="text-navy-500 font-medium mt-4">Informasi dan kegiatan terkini dari Dinas Perpustakaan.
                    </p>
                </div>
                <a href="{{ route('public.berita.index') }}"
                    class="inline-flex items-center gap-2 text-navy-900 hover:text-gold-600 transition-colors font-bold text-lg border-b-2 border-navy-200 hover:border-gold-500 pb-1">
                    Semua Berita <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3">
                        </path>
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                @forelse($beritaTerbaru as $index => $news)
                    <!-- Clean Editorial Card -->
                    <a href="{{ route('public.berita.show', $news->slug) }}"
                        class="group cursor-pointer block {{ $index === 2 ? 'hidden lg:block' : '' }}">
                        @if($news->cover_image)
                            <div class="aspect-[4/3] rounded-[2rem] overflow-hidden mb-6 bg-navy-50">
                                <img src="{{ $news->cover_image }}" alt="{{ $news->judul_berita }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                            </div>
                        @else
                            <div
                                class="aspect-[4/3] rounded-[2rem] overflow-hidden mb-6 bg-navy-900 flex items-center justify-center relative">
                                <div class="absolute inset-0 bg-gradient-to-br from-navy-800 to-navy-950"></div>
                                <svg class="w-16 h-16 text-gold-400 relative z-10 group-hover:scale-110 transition-transform duration-500"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                                    </path>
                                </svg>
                            </div>
                        @endif
                        <div class="flex items-center gap-3 mb-4">
                            <span
                                class="px-3 py-1 border border-navy-200 rounded-full text-[10px] font-black text-navy-900 uppercase tracking-widest">Berita</span>
                            <span class="text-sm font-semibold text-navy-400">{{ $news->created_at->format('d M Y') }}</span>
                        </div>
                        <h3
                            class="text-2xl font-black text-navy-900 group-hover:text-gold-500 transition-colors leading-tight mb-3">
                            {{ $news->judul_berita }}
                        </h3>
                        <p class="text-navy-600 text-sm font-medium line-clamp-2">
                            {{ Str::limit(strip_tags(html_entity_decode($news->isi_berita)), 120) }}
                        </p>
                    </a>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-navy-500 font-medium">Belum ada berita terbaru saat ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-24 lg:py-32 px-6 bg-white border-t border-navy-50 relative">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 lg:gap-24 items-start">

                <!-- Left: Typography -->
                <div class="lg:col-span-5 sticky top-32">
                    <span class="text-navy-500 font-bold tracking-wider uppercase text-sm mb-4 block">
                        Pertanyaan Yang Sering Ditanyakan
                    </span>
                    <h2
                        class="text-4xl md:text-5xl lg:text-[3.5rem] font-black tracking-tight text-navy-900 leading-[1.1] mb-6">
                        Apakah Kamu Punya<br>Pertanyaan?
                    </h2>
                    <p class="text-navy-500 font-medium text-lg leading-relaxed mb-10 pr-4">
                        Temukan jawaban dari berbagai pertanyaan yang sering diajukan terkait layanan dan fitur Dinas
                        Perpustakaan dan Kearsipan Kota Padang. Bagian ini kami sediakan untuk membantu Anda memperoleh
                        informasi dengan lebih cepat, jelas, dan tanpa kebingungan.
                    </p>
                    <a href="#contact-us"
                        class="inline-flex px-8 py-4 bg-navy-900 text-white font-bold rounded-xl hover:bg-navy-800 transition-all shadow-md hover:shadow-lg transform hover:-translate-y-1">
                        Hubungi Kami
                    </a>
                </div>

                <!-- Right: FAQ Accordions (Alpine.js) -->
                <div class="lg:col-span-7 flex flex-col gap-4" x-data="{ activeFaq: null }">
                    @forelse($faqs ?? [] as $index => $faq)
                        <div class="bg-white border border-navy-100 rounded-2xl shadow-[0_4px_20px_rgba(15,36,64,0.03)] overflow-hidden transition-all duration-300"
                            :class="{ 'ring-2 ring-gold-400 border-transparent shadow-md': activeFaq === {{ $index }} }">
                            <button @click="activeFaq = activeFaq === {{ $index }} ? null : {{ $index }}"
                                class="w-full flex items-center justify-between p-6 md:p-8 text-left focus:outline-none group">
                                <h3 class="text-lg md:text-xl font-bold text-navy-900 pr-8 transition-colors"
                                    :class="{ 'text-gold-600': activeFaq === {{ $index }} }">
                                    {{ $faq->pertanyaan }}
                                </h3>
                                <div class="flex-shrink-0 text-navy-300 transition-all duration-300 group-hover:text-gold-500"
                                    :class="{ 'rotate-90 text-gold-500': activeFaq === {{ $index }} }">
                                    <!-- Double Chevron Icon -->
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </button>
                            <div x-show="activeFaq === {{ $index }}" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 -translate-y-2"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                class="px-6 md:px-8 pb-6 md:pb-8 text-navy-600 font-medium leading-relaxed border-t border-gray-100 pt-6"
                                style="display: none;">
                                {!! nl2br(e($faq->jawaban)) !!}
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12 bg-navy-50 rounded-2xl border border-navy-100">
                            <p class="text-navy-500 font-medium">Belum ada FAQ yang tersedia saat ini.</p>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
    </section>

    <!-- Visitor Stats Section -->
    <section class="py-24 px-6 bg-[#F8FAFC] border-t border-navy-50">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-8">
                <div>
                    <span class="text-gold-600 font-bold tracking-[0.2em] uppercase text-xs mb-4 flex items-center gap-2">
                        <span class="w-8 h-px bg-gold-500"></span> Analitik Pengunjung
                    </span>
                    <h2 class="text-4xl md:text-5xl font-black tracking-tight text-navy-900">Statistik<br>Kunjungan</h2>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- Summary Stats -->
                <div class="lg:col-span-4 flex flex-col gap-6">
                    <!-- Hari Ini -->
                    <div
                        class="bg-white rounded-3xl p-8 border border-navy-50 shadow-sm flex items-center gap-6 group hover:shadow-md transition-all">
                        <div
                            class="w-16 h-16 rounded-2xl bg-sky-50 text-sky-500 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-navy-400 text-sm font-bold uppercase tracking-widest mb-1">Hari Ini</p>
                            <p class="text-4xl font-black text-navy-900">{{ number_format($visitorToday ?? 0) }}</p>
                        </div>
                    </div>
                    <!-- Bulan Ini -->
                    <div
                        class="bg-white rounded-3xl p-8 border border-navy-50 shadow-sm flex items-center gap-6 group hover:shadow-md transition-all">
                        <div
                            class="w-16 h-16 rounded-2xl bg-gold-50 text-gold-500 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-navy-400 text-sm font-bold uppercase tracking-widest mb-1">Bulan Ini</p>
                            <p class="text-4xl font-black text-navy-900">{{ number_format($visitorMonth ?? 0) }}</p>
                        </div>
                    </div>
                    <!-- Total -->
                    <div
                        class="bg-navy-900 rounded-3xl p-8 shadow-lg flex items-center gap-6 group hover:shadow-xl transition-all relative overflow-hidden">
                        <div class="absolute -right-6 -top-6 w-32 h-32 bg-gold-500/20 rounded-full blur-2xl"></div>
                        <div
                            class="w-16 h-16 rounded-2xl bg-white/10 text-white flex items-center justify-center group-hover:scale-110 transition-transform backdrop-blur-sm border border-white/20">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                        <div class="relative z-10">
                            <p class="text-gold-400 text-sm font-bold uppercase tracking-widest mb-1">Total Visitor</p>
                            <p class="text-4xl font-black text-white">{{ number_format($visitorTotal ?? 0) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Chart -->
                <div
                    class="lg:col-span-8 bg-white rounded-3xl p-6 md:p-8 border border-navy-50 shadow-sm relative overflow-hidden">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-navy-900">Grafik Kunjungan 7 Hari Terakhir</h3>
                        <div
                            class="px-3 py-1 bg-green-50 text-green-600 text-[10px] uppercase font-bold tracking-widest rounded-full flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span> Live Data
                        </div>
                    </div>
                    <div id="visitor-chart" class="w-full h-[300px]"></div>
                </div>
            </div>
        </div>
    </section>

    </section>

    <!-- Tickets & Contact Section -->
    <section id="contact-us" class="py-24 lg:py-32 px-6 bg-white border-t border-navy-50 relative">
        <div class="max-w-7xl mx-auto">
            <div class="text-center max-w-3xl mx-auto mb-16 md:mb-20">
                <span class="text-navy-500 font-bold tracking-wider uppercase text-sm mb-4 block">
                    Layanan Bantuan
                </span>
                <h2 class="text-4xl md:text-5xl font-black tracking-tight text-navy-900 leading-[1.1] mb-6">
                    Kirimkan Saran &<br>Masukan Anda
                </h2>
                <p class="text-navy-600 font-medium text-lg leading-relaxed">
                    Kami sangat menghargai setiap saran, kritik, maupun pertanyaan Anda. Silakan isi formulir di bawah ini,
                    dan kami akan segera menindaklanjutinya demi pelayanan yang lebih baik.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-start">

                <!-- Left: Maps & Contact Info -->
                <div class="space-y-8">
                    @if(isset($settings['maps_embed_link']) && $settings['maps_embed_link']->value)
                        <div class="rounded-3xl overflow-hidden border border-navy-100 shadow-sm h-[350px] bg-gray-50 relative">
                            <iframe src="{{ $settings['maps_embed_link']->value }}" width="100%" height="100%" style="border:0;"
                                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                                class="absolute inset-0"></iframe>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @if(isset($settings['contact_email']) && $settings['contact_email']->value)
                            <div class="bg-[#F8FAFC] p-6 rounded-2xl border border-navy-50">
                                <div class="w-12 h-12 rounded-xl bg-sky-100 text-sky-500 flex items-center justify-center mb-4">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                <h4 class="text-sm font-bold text-navy-900 uppercase tracking-wider mb-1">Email</h4>
                                <p class="text-navy-600 font-medium">{{ $settings['contact_email']->value }}</p>
                            </div>
                        @endif

                        @if(isset($settings['contact_phone']) && $settings['contact_phone']->value)
                            <div class="bg-[#F8FAFC] p-6 rounded-2xl border border-navy-50">
                                <div
                                    class="w-12 h-12 rounded-xl bg-gold-50 text-gold-500 flex items-center justify-center mb-4">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                        </path>
                                    </svg>
                                </div>
                                <h4 class="text-sm font-bold text-navy-900 uppercase tracking-wider mb-1">Telepon</h4>
                                <p class="text-navy-600 font-medium">{{ $settings['contact_phone']->value }}</p>
                            </div>
                        @endif
                    </div>

                    @if(isset($settings['contact_address']) && $settings['contact_address']->value)
                        <div class="bg-[#F8FAFC] p-6 rounded-2xl border border-navy-50 flex gap-4">
                            <div
                                class="w-12 h-12 rounded-xl bg-navy-100 text-navy-600 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-navy-900 uppercase tracking-wider mb-1">Alamat</h4>
                                <p class="text-navy-600 font-medium leading-relaxed">{{ $settings['contact_address']->value }}
                                </p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Right: Contact Form -->
                <div class="bg-white rounded-3xl p-8 md:p-10 border border-navy-100 shadow-[0_8px_30px_rgb(15,36,64,0.04)]">
                    @if(session('success'))
                        <div
                            class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 font-medium flex items-start gap-3">
                            <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('tickets.submit') }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label class="block text-sm font-bold text-navy-900 mb-2">Nama Lengkap</label>
                            <input type="text" name="nama" value="{{ old('nama') }}" required
                                class="w-full px-5 py-4 bg-[#F8FAFC] border-transparent rounded-xl focus:border-gold-500 focus:bg-white focus:ring-4 focus:ring-gold-500/10 transition-all font-medium text-navy-900 placeholder:text-navy-300"
                                placeholder="Masukkan nama Anda">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-navy-900 mb-2">Alamat Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                class="w-full px-5 py-4 bg-[#F8FAFC] border-transparent rounded-xl focus:border-gold-500 focus:bg-white focus:ring-4 focus:ring-gold-500/10 transition-all font-medium text-navy-900 placeholder:text-navy-300"
                                placeholder="nama@email.com">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-navy-900 mb-2">Pesan & Saran <span
                                    class="text-red-500">*</span></label>
                            <textarea name="pesan" required rows="5"
                                class="w-full px-5 py-4 bg-[#F8FAFC] border-transparent rounded-xl focus:border-gold-500 focus:bg-white focus:ring-4 focus:ring-gold-500/10 transition-all font-medium text-navy-900 placeholder:text-navy-300 resize-none"
                                placeholder="Tuliskan pesan, pertanyaan, atau saran Anda di sini..."></textarea>
                            @error('pesan')
                                <p class="text-red-500 text-sm mt-2 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit"
                            class="w-full py-4 px-8 bg-navy-900 text-white font-bold rounded-xl hover:bg-navy-800 transition-all shadow-md hover:shadow-lg transform hover:-translate-y-1 flex items-center justify-center gap-2">
                            <span>Kirim Pesan</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var options = {
                series: [{
                    name: 'Pengunjung',
                    data: @json($chartCounts ?? [])
                }],
                chart: {
                    type: 'area',
                    height: 300,
                    fontFamily: 'inherit',
                    toolbar: { show: false },
                    zoom: { enabled: false }
                },
                colors: ['#0f2440'], // navy-900
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.4,
                        opacityTo: 0.05,
                        stops: [0, 100]
                    }
                },
                dataLabels: { enabled: false },
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                xaxis: {
                    categories: @json($chartDates ?? []),
                    axisBorder: { show: false },
                    axisTicks: { show: false },
                    labels: {
                        style: { colors: '#64748b', fontSize: '12px', fontWeight: 500 }
                    }
                },
                yaxis: {
                    labels: {
                        style: { colors: '#64748b', fontSize: '12px', fontWeight: 500 }
                    }
                },
                grid: {
                    borderColor: '#f1f5f9',
                    strokeDashArray: 4,
                    yaxis: { lines: { show: true } },
                    xaxis: { lines: { show: false } },
                    padding: { top: 0, right: 0, bottom: 0, left: 10 }
                },
                theme: { mode: 'light' },
                tooltip: {
                    theme: 'light',
                    y: { formatter: function (val) { return val + " visitor" } }
                }
            };

            var chart = new ApexCharts(document.querySelector("#visitor-chart"), options);
            chart.render();
        });
    </script>
@endpush
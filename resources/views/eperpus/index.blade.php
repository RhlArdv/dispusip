@extends('layouts.eperpus')

@section('title', 'E-Perpus | Dinas Perpustakaan dan Kearsipan')

@section('content')

    <!-- HERO CAROUSEL INFOGRAFIS -->
    <div class="relative w-full h-[60vh] md:h-[80vh] bg-navy-950 overflow-hidden mt-20 group" x-data="{
                    activeSlide: 0,
                    slides: {{ $infografis->count() > 0 ? $infografis->count() : 1 }},
                    autoPlay() {
                        setInterval(() => {
                            this.activeSlide = this.activeSlide === this.slides - 1 ? 0 : this.activeSlide + 1
                        }, 5000)
                    }
                }" x-init="autoPlay()">

        @if($infografis->count() > 0)
            @foreach($infografis as $index => $info)
                <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out bg-navy-950"
                    x-show="activeSlide === {{ $index }}" x-transition:enter="transition-opacity duration-1000"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition-opacity duration-1000" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0">

                    <!-- Blurred background to fill empty space elegantly -->
                    <img src="{{ Storage::url($info->image) }}"
                        class="absolute inset-0 w-full h-full object-cover blur-2xl opacity-50 scale-110" alt="">

                    <!-- Image with original proportions (object-contain) to prevent zooming -->
                    <img src="{{ Storage::url($info->image) }}" alt="{{ $info->title }}"
                        class="relative w-full h-full object-contain">

                    <!-- Subtle bottom gradient only for indicator visibility -->
                    <div class="absolute inset-x-0 bottom-0 h-40 bg-gradient-to-t from-navy-900/90 to-transparent opacity-80 z-10">
                    </div>
                </div>
            @endforeach
        @else
            <!-- Placeholder if no infografis -->
            <div class="absolute inset-0 flex items-center justify-center bg-navy-900">
                <img src="https://images.unsplash.com/photo-1507842217343-583bb7270b66?auto=format&fit=crop&q=80&w=1920"
                    class="w-full h-full object-cover opacity-40">
                <div class="absolute inset-0 bg-gradient-to-t from-navy-950 via-navy-900/40 to-transparent"></div>
                <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-4 z-10">
                    <span
                        class="px-5 py-2 rounded-full bg-gold-500/20 text-gold-400 text-sm font-bold tracking-widest uppercase mb-6 border border-gold-500/30 backdrop-blur-md">Koleksi
                        Digital</span>
                    <h1 class="text-4xl md:text-6xl lg:text-7xl font-black text-white tracking-tight uppercase leading-[1.1]">
                        Jelajahi Dunia <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-gold-300 to-gold-500">E-Perpus</span>
                    </h1>
                </div>
            </div>
        @endif

        <!-- Controls -->
        @if($infografis->count() > 1)
            <button @click="activeSlide = activeSlide === 0 ? slides - 1 : activeSlide - 1"
                class="absolute left-6 top-1/2 -translate-y-1/2 w-14 h-14 rounded-full bg-white/10 backdrop-blur-xl border border-white/20 flex items-center justify-center text-white hover:bg-white hover:text-navy-900 hover:scale-110 transition-all duration-300 z-20 shadow-lg opacity-0 group-hover:opacity-100 translate-x-4 group-hover:translate-x-0">
                <svg class="w-6 h-6 ml-[-2px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            <button @click="activeSlide = activeSlide === slides - 1 ? 0 : activeSlide + 1"
                class="absolute right-6 top-1/2 -translate-y-1/2 w-14 h-14 rounded-full bg-white/10 backdrop-blur-xl border border-white/20 flex items-center justify-center text-white hover:bg-white hover:text-navy-900 hover:scale-110 transition-all duration-300 z-20 shadow-lg opacity-0 group-hover:opacity-100 -translate-x-4 group-hover:translate-x-0">
                <svg class="w-6 h-6 mr-[-2px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        @endif
    </div>

    <!-- SERVICES (LAYANAN BENTO GRID) -->
    <section class="py-24 px-6 bg-white relative">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <span
                    class="text-gold-600 font-bold tracking-[0.2em] uppercase text-xs mb-4 flex items-center justify-center gap-2">
                    <span class="w-8 h-px bg-gold-500"></span> Layanan Kami <span class="w-8 h-px bg-gold-500"></span>
                </span>
                <h2 class="text-4xl md:text-6xl font-black text-navy-900 tracking-tighter uppercase leading-none">
                    Layanan Pemustaka &<br>
                    <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-gold-400 to-gold-600">Pengunjung.</span>
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 auto-rows-[250px] md:auto-rows-[300px]">

                <!-- 1. Onesearch (Span 4) -->
                <a href="https://onesearch.id/" target="_blank"
                    class="block col-span-1 md:col-span-4 bg-navy-50 rounded-[2.5rem] p-8 relative overflow-hidden group cursor-pointer border border-navy-100 hover:border-gold-300 hover:shadow-xl transition-all duration-500">
                    <div
                        class="absolute -right-6 -bottom-6 w-32 h-32 bg-gold-400 rounded-full blur-3xl opacity-20 group-hover:opacity-40 transition-opacity">
                    </div>
                    <div class="relative z-10 flex flex-col justify-between h-full">
                        <div
                            class="w-12 h-12 rounded-full bg-white flex items-center justify-center text-navy-900 shadow-sm group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-black text-navy-900 mb-2">Onesearch.id</h3>
                            <p class="text-navy-600 font-medium text-sm">Pintu pencarian tunggal untuk semua koleksi publik
                                dari perpustakaan di Indonesia.</p>
                        </div>
                    </div>
                </a>

                <!-- 2. OPAC (Span 8) -->
                <a href="https://inlislite.pdg.web.id/opac" target="_blank"
                    class="block col-span-1 md:col-span-8 rounded-[2.5rem] overflow-hidden relative group cursor-pointer shadow-[0_20px_50px_rgba(15,36,64,0.1)]">
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

                <!-- 3. Keanggotaan (Span 5) -->
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
                            <p class="text-navy-900/80 font-medium mb-6">Gabung sekarang dan nikmati seluruh akses layanan
                                eksklusif kami.</p>
                        </div>
                    </div>
                </a>

                <!-- 4. iPusnas (Span 3) -->
                <a href="#" target="_blank"
                    class="block col-span-1 md:col-span-3 bg-navy-900 rounded-[2.5rem] p-8 relative overflow-hidden group cursor-pointer shadow-lg">
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-gold-500 rounded-full blur-[50px] opacity-20 group-hover:opacity-40 transition-opacity">
                    </div>
                    <div class="relative z-10 flex flex-col justify-between h-full">
                        <div
                            class="w-12 h-12 rounded-full bg-navy-800 flex items-center justify-center text-gold-400 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-black text-white mb-2">iPusnas</h3>
                            <p class="text-navy-200 font-medium text-sm">Aplikasi perpustakaan digital nasional berbasis
                                media sosial.</p>
                        </div>
                    </div>
                </a>

                <!-- 5. Agenda Kegiatan (Span 4) -->
                <a href="{{ route('public.kegiatan.index') }}"
                    class="block col-span-1 md:col-span-4 bg-navy-50 rounded-[2.5rem] p-8 relative overflow-hidden group cursor-pointer border border-navy-100 hover:border-gold-300 hover:shadow-xl transition-all duration-500">
                    <div
                        class="absolute -left-6 -bottom-6 w-32 h-32 bg-navy-400 rounded-full blur-3xl opacity-20 group-hover:opacity-40 transition-opacity">
                    </div>
                    <div class="relative z-10 flex flex-col justify-between h-full">
                        <div
                            class="w-12 h-12 rounded-full bg-white flex items-center justify-center text-navy-900 shadow-sm group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-black text-navy-900 mb-2">Agenda Kegiatan</h3>
                            <p class="text-navy-600 font-medium text-sm">Informasi lengkap terkait jadwal acara dan
                                aktivitas dinas perpustakaan.</p>
                        </div>
                    </div>
                </a>

            </div>
        </div>
    </section>

    <!-- WRAPPER BACKGROUND SVG -->
    <div class="relative bg-fixed bg-bottom bg-no-repeat"
        style="background-image: url('{{ asset('assets/img/backgroudndisp.svg') }}'); background-size: 100% auto;">

        <!-- LAYANAN PERPUSTAKAAN SECTION -->
        <section class="py-16 px-6 bg-white/60 border-t border-white/50">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-black text-navy-900 tracking-tight uppercase">Layanan Perpustakaan
                    </h2>
                    <div class="w-24 h-1 bg-gold-500 mx-auto mt-4 rounded-full"></div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- ISBN & QRCBN -->
                    <a href="#"
                        class="group bg-white p-6 rounded-3xl shadow-sm border border-navy-100 hover:shadow-xl transition-all duration-300 flex flex-col items-center text-center">
                        <div
                            class="w-16 h-16 rounded-2xl bg-navy-100 text-navy-900 flex items-center justify-center mb-4 group-hover:bg-gold-500 transition-colors">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-navy-900 group-hover:text-gold-600 transition-colors">Layanan ISBN
                            &
                            QRCBN</h3>
                        <p class="text-sm text-navy-500 mt-2">Pengajuan nomor standar buku dan kode QR.</p>
                    </a>

                    <!-- Data Perpustakaan -->
                    <a href="#"
                        class="group bg-white p-6 rounded-3xl shadow-sm border border-navy-100 hover:shadow-xl transition-all duration-300 flex flex-col items-center text-center">
                        <div
                            class="w-16 h-16 rounded-2xl bg-navy-100 text-navy-900 flex items-center justify-center mb-4 group-hover:bg-gold-500 transition-colors">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-navy-900 group-hover:text-gold-600 transition-colors">Data
                            Perpustakaan</h3>
                        <p class="text-sm text-navy-500 mt-2">Pangkalan data perpustakaan se-Kota Padang.</p>
                    </a>

                    <!-- JDIH Perpustakaan -->
                    <a href="{{ route('jdih.index') }}"
                        class="group bg-white p-6 rounded-3xl shadow-sm border border-navy-100 hover:shadow-xl transition-all duration-300 flex flex-col items-center text-center">
                        <div
                            class="w-16 h-16 rounded-2xl bg-navy-100 text-navy-900 flex items-center justify-center mb-4 group-hover:bg-gold-500 transition-colors">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-navy-900 group-hover:text-gold-600 transition-colors">JDIH
                            Perpustakaan</h3>
                        <p class="text-sm text-navy-500 mt-2">Jaringan Dokumentasi dan Informasi Hukum.</p>
                    </a>

                    <!-- FAQ Perpustakaan -->
                    <a href="/#faq"
                        class="group bg-white p-6 rounded-3xl shadow-sm border border-navy-100 hover:shadow-xl transition-all duration-300 flex flex-col items-center text-center">
                        <div
                            class="w-16 h-16 rounded-2xl bg-navy-100 text-navy-900 flex items-center justify-center mb-4 group-hover:bg-gold-500 transition-colors">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-navy-900 group-hover:text-gold-600 transition-colors">FAQ
                            Perpustakaan
                        </h3>
                        <p class="text-sm text-navy-500 mt-2">Pertanyaan umum seputar layanan kami.</p>
                    </a>
                </div>
            </div>
        </section>

        <!-- BERITA TERBARU (PUSTAKA) -->
        <section class="py-24 bg-white/70 border-t border-white/50">
            <div class="max-w-7xl mx-auto px-6">
                <div class="flex flex-col md:flex-row items-end justify-between mb-12 gap-8">
                    <div>
                        <span
                            class="text-gold-600 font-bold tracking-[0.2em] uppercase text-xs mb-4 flex items-center gap-2">
                            <span class="w-8 h-px bg-gold-500"></span> Kabar Pustaka
                        </span>
                        <h2 class="text-4xl md:text-5xl font-black tracking-tight text-navy-900 leading-none">
                            Berita<br>Terbaru</h2>
                    </div>
                    <a href="{{ route('public.berita.index') }}"
                        class="inline-flex items-center gap-2 text-navy-900 hover:text-gold-600 transition-colors font-bold text-lg border-b-2 border-navy-200 hover:border-gold-500 pb-1">
                        Semua Berita <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @forelse($beritaTerbaru as $berita)
                        <a href="{{ route('public.berita.show', $berita->slug) }}"
                            class="group bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl hover:shadow-navy-900/5 transition-all duration-500 flex flex-col border border-navy-100/50">
                            <div class="relative h-64 overflow-hidden bg-navy-50">
                                @if($berita->cover_image)
                                    <img src="{{ $berita->cover_image }}" alt="{{ $berita->judul_berita }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-navy-900 text-gold-400">
                                        <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                                            </path>
                                        </svg>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-navy-900/80 to-transparent opacity-60"></div>
                                <div class="absolute bottom-4 left-4 flex gap-2">
                                    <span
                                        class="bg-gold-500 text-navy-900 text-xs font-black uppercase tracking-wider px-3 py-1 rounded-full">Berita</span>
                                </div>
                            </div>
                            <div class="p-8 flex-1 flex flex-col">
                                <div
                                    class="flex items-center gap-2 text-xs font-semibold text-navy-400 mb-4 uppercase tracking-wider">
                                    <span>{{ $berita->created_at->format('d M Y') }}</span>
                                    <span class="w-1 h-1 rounded-full bg-gold-400"></span>
                                    <span>{{ $berita->user->name ?? 'Admin' }}</span>
                                </div>
                                <h3
                                    class="text-xl font-black text-navy-900 mb-4 line-clamp-2 leading-snug group-hover:text-gold-600 transition-colors">
                                    {{ $berita->judul_berita }}
                                </h3>
                                <p class="text-navy-600/80 line-clamp-3 text-sm leading-relaxed mb-6 flex-1">
                                    {{ Str::limit(strip_tags(html_entity_decode($berita->isi_berita)), 120) }}
                                </p>
                            </div>
                        </a>
                    @empty
                        <div class="col-span-3 text-center py-12 text-navy-400">
                            Belum ada berita terbaru.
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- TESTIMONI TERBARU -->
        <section class="py-24 bg-white/60 border-t border-white/50 relative">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-16">
                    <span
                        class="text-navy-400 font-bold tracking-[0.2em] uppercase text-xs mb-4 flex items-center justify-center gap-2">
                        <span class="w-8 h-px bg-gold-500"></span> Ulasan Pemustaka <span
                            class="w-8 h-px bg-gold-500"></span>
                    </span>
                    <h2 class="text-4xl md:text-5xl font-black tracking-tight text-navy-900 leading-none">Testimoni</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @forelse($testimoni as $testi)
                        <div
                            class="bg-white/70 p-6 rounded-3xl border border-white/50 relative shadow-md hover:shadow-xl transition-all duration-300 flex flex-col">
                            @if($testi->youtube_id)
                                <div
                                    class="w-full aspect-video rounded-2xl overflow-hidden mb-5 shadow-lg bg-navy-900 border border-white/20">
                                    <iframe class="w-full h-full" src="https://www.youtube.com/embed/{{ $testi->youtube_id }}"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                                </div>
                            @else
                                <div
                                    class="w-full aspect-video rounded-2xl overflow-hidden mb-5 shadow-lg bg-navy-900 border border-white/20 flex items-center justify-center">
                                    <span class="text-white/50 text-sm">Video tidak tersedia</span>
                                </div>
                            @endif
                            <h4 class="font-bold text-navy-900 text-lg mb-2 line-clamp-2">{{ $testi->title }}</h4>
                        </div>
                    @empty
                        <!-- Placeholder Testimoni if empty -->
                        @for($i = 1; $i <= 3; $i++)
                            <div class="bg-white/70 p-6 rounded-3xl border border-white/50 relative shadow-md">
                                <div
                                    class="w-full aspect-video rounded-2xl overflow-hidden mb-5 shadow-lg bg-navy-900 flex items-center justify-center relative group cursor-pointer border border-white/20">
                                    <img src="https://images.unsplash.com/photo-1507842217343-583bb7270b66?auto=format&fit=crop&q=80&w=800"
                                        class="w-full h-full object-cover opacity-50 group-hover:scale-105 transition-transform duration-700">
                                    <div
                                        class="absolute w-14 h-14 bg-red-600 rounded-full flex items-center justify-center text-white shadow-xl group-hover:scale-110 transition-transform">
                                        <svg class="w-6 h-6 ml-1" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M8 5v14l11-7z" />
                                        </svg>
                                    </div>
                                </div>
                                <h4 class="font-bold text-navy-900 text-lg mb-2">Review Fasilitas E-Perpus</h4>
                            </div>
                        @endfor
                    @endforelse
                </div>

                <div class="mt-12 text-center">
                    <a href="{{ route('public.testimoni.index') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-white border border-navy-100 text-navy-600 font-bold rounded-xl hover:bg-navy-50 hover:text-gold-600 transition-all shadow-sm">
                        Lihat Semua Testimoni
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </section>


        <!-- BUKU TERBARU (KOLEKSI) -->
        <!-- <section class="py-24 bg-navy-950 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-full bg-grid opacity-10"></div>
                <div class="max-w-7xl mx-auto px-6 relative z-10">
                    <div class="text-center mb-16">
                        <span
                            class="text-gold-600 font-bold tracking-[0.2em] uppercase text-xs mb-4 flex items-center justify-center gap-2">
                            <span class="w-8 h-px bg-gold-500"></span> Koleksi Pilihan <span
                                class="w-8 h-px bg-gold-500"></span>
                        </span>
                        <h2 class="text-4xl md:text-5xl font-black tracking-tight text-white leading-none">Buku<br><span
                                class="text-gold-400">Terbaru</span></h2>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        @forelse($bukuTerbaru as $buku)
                            <a href="{{ $buku->slug ? route('public.koleksi.show', $buku->slug) : '#' }}"
                                class="group block relative rounded-2xl overflow-hidden aspect-[3/4] bg-navy-800 border border-navy-700 shadow-xl">
                                @if($buku->foto_koleksi)
                                    <img src="{{ Storage::url($buku->foto_koleksi) }}" alt="{{ $buku->judul_koleksi }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-navy-800 text-navy-600">
                                        <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                            </path>
                                        </svg>
                                    </div>
                                @endif
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-navy-950 via-navy-900/60 to-transparent opacity-80 group-hover:opacity-90 transition-opacity">
                                </div>
                                <div
                                    class="absolute bottom-0 left-0 w-full p-6 translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                    <span
                                        class="text-gold-400 text-[10px] font-bold uppercase tracking-wider mb-2 block">{{ $buku->kategori ?? 'Umum' }}</span>
                                    <h3 class="text-white font-bold leading-snug line-clamp-2">{{ $buku->judul_koleksi }}</h3>
                                </div>
                            </a>
                        @empty
                            <div class="col-span-2 md:col-span-4 text-center py-12 text-navy-500">
                                Belum ada koleksi buku terbaru.
                            </div>
                        @endforelse
                    </div>
                </div>
            </section> -->

        {{-- KOLEKSI PER KATEGORI --}}
        @if($koleksiPerKategori->isNotEmpty())
            <section class="py-24 bg-white/70 border-t border-white/50 relative" id="koleksi-kategori" x-data="{
                                activeTab: '{{ $koleksiPerKategori->keys()->first() }}',
                                tabs: {{ json_encode($koleksiPerKategori->keys()->values()->all()) }}
                            }">
                <div class="max-w-7xl mx-auto px-6">

                    {{-- Header --}}
                    <div class="flex flex-col md:flex-row items-end justify-between mb-10 gap-6">
                        <div>
                            <span
                                class="text-gold-600 font-bold tracking-[0.2em] uppercase text-xs mb-4 flex items-center gap-2">
                                <span class="w-8 h-px bg-gold-500"></span> Jelajahi Koleksi
                            </span>
                            <h2 class="text-4xl md:text-5xl font-black tracking-tight text-navy-900 leading-none">
                                Koleksi<br><span
                                    class="text-transparent bg-clip-text bg-gradient-to-r from-gold-400 to-gold-600">Per
                                    Kategori</span>
                            </h2>
                        </div>
                        <p class="text-navy-500 font-medium max-w-sm text-sm">
                            Temukan koleksi pilihan yang dikelompokkan berdasarkan kategori untuk memudahkan pencarian Anda.
                        </p>
                    </div>

                    {{-- Tab Pills --}}
                    <div class="flex flex-nowrap md:flex-wrap gap-2 mb-10 overflow-x-auto pb-2 scrollbar-hide">
                        @foreach($koleksiPerKategori as $kategori => $items)
                            <button @click="activeTab = '{{ $kategori }}'"
                                :class="activeTab === '{{ $kategori }}'
                                                    ? 'bg-navy-900 text-white shadow-lg shadow-navy-900/20'
                                                    : 'bg-white text-navy-600 border border-navy-200 hover:border-gold-400 hover:text-gold-600'"
                                class="px-5 py-2.5 rounded-full font-bold text-sm transition-all duration-200 flex items-center gap-2">
                                <span>{{ $kategori }}</span>
                                <span
                                    :class="activeTab === '{{ $kategori }}' ? 'bg-gold-400 text-navy-900' : 'bg-navy-100 text-navy-500'"
                                    class="text-[10px] font-black px-2 py-0.5 rounded-full transition-colors">
                                    {{ $items->count() }}
                                </span>
                            </button>
                        @endforeach
                    </div>

                    {{-- Content per Kategori --}}
                    @foreach($koleksiPerKategori as $kategori => $items)
                        <div x-show="activeTab === '{{ $kategori }}'" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-4"
                            style="display: none;">
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-5">
                                @foreach($items as $koleksi)
                                    <a href="{{ $koleksi->slug ? route('public.koleksi.show', $koleksi->slug) : '#' }}"
                                        class="group bg-white rounded-2xl overflow-hidden border border-navy-100 hover:border-gold-300 hover:shadow-xl hover:shadow-navy-900/5 transition-all duration-400 flex flex-col">

                                        {{-- Cover --}}
                                        <div class="relative aspect-[3/4] bg-navy-50 overflow-hidden flex-shrink-0">
                                            @if($koleksi->cover_image)
                                                <img src="{{ $koleksi->cover_image }}" alt="{{ $koleksi->judul_koleksi }}"
                                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                            @else
                                                <div
                                                    class="w-full h-full flex flex-col items-center justify-center gap-3 bg-gradient-to-br from-navy-100 to-navy-200">
                                                    <svg class="w-10 h-10 text-navy-400" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                                    </svg>
                                                    <span class="text-navy-400 text-xs font-medium px-3 text-center">Tidak ada sampul</span>
                                                </div>
                                            @endif
                                            {{-- Category Badge --}}
                                            <div class="absolute top-3 left-3">
                                                <span
                                                    class="bg-gold-500/90 backdrop-blur-sm text-navy-900 text-[10px] font-black uppercase tracking-wider px-2.5 py-1 rounded-full">
                                                    {{ $kategori }}
                                                </span>
                                            </div>
                                            {{-- Hover overlay --}}
                                            <div
                                                class="absolute inset-0 bg-navy-900/0 group-hover:bg-navy-900/20 transition-colors duration-300 flex items-center justify-center">
                                                @if($koleksi->link)
                                                    <div
                                                        class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 w-10 h-10 bg-gold-400 rounded-full flex items-center justify-center shadow-lg">
                                                        <svg class="w-5 h-5 text-navy-900" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        {{-- Info --}}
                                        <div class="p-4 flex-1 flex flex-col justify-between">
                                            <h3
                                                class="text-sm font-bold text-navy-900 line-clamp-2 leading-snug group-hover:text-gold-600 transition-colors mb-2 min-h-[2.5rem]">
                                                {{ $koleksi->judul_koleksi }}
                                            </h3>
                                            @if($koleksi->isi_koleksi)
                                                <p class="text-xs text-navy-500 line-clamp-2 leading-relaxed">
                                                    {{ Str::limit(strip_tags($koleksi->isi_koleksi), 60) }}
                                                </p>
                                            @endif
                                        </div>
                                    </a>
                                @endforeach
                            </div>

                            {{-- Empty state per kategori --}}
                            @if($items->isEmpty())
                                <div class="text-center py-16 text-navy-400">
                                    <svg class="w-16 h-16 mx-auto mb-4 text-navy-200" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    <p class="font-medium">Belum ada koleksi di kategori ini.</p>
                                </div>
                            @endif
                        </div>
                    @endforeach

                </div>
            </section>
        @endif

    </div> <!-- END WRAPPER BACKGROUND SVG -->

@endsection
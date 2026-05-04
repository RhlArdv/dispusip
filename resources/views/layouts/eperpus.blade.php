<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'DISPUSIP | Dinas Perpustakaan dan Kearsipan')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">

    <!-- Tailwind CSS -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
                    },
                    colors: {
                        navy: {
                            50: '#f0f6fc', 100: '#e1edfa', 200: '#c8e0f4', 300: '#a1cced', 400: '#73b0e3',
                            500: '#3173b5', 600: '#225a96', 700: '#1a4576', 800: '#14355a', 900: '#0f2440', 950: '#0a1729'
                        },
                        gold: {
                            50: '#fffbf0', 100: '#fef3d3', 200: '#fce5a3', 300: '#fad16a', 400: '#fbbf24',
                            500: '#f59e0b', 600: '#d97706', 700: '#b45309', 800: '#92400e', 900: '#78350f',
                        }
                    },
                    animation: {
                        'fade-in-up': 'fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards',
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'marquee': 'marquee 25s linear infinite',
                    },
                    keyframes: {
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(30px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-15px)' },
                        },
                        marquee: {
                            '0%': { transform: 'translateX(0%)' },
                            '100%': { transform: 'translateX(-100%)' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            background-color: #f8fafc;
            color: #0f2440;
            overflow-x: hidden;
        }

        .bg-grid {
            background-image: url("data:image/svg+xml,%3Csvg width='40' height='40' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 0h40v40H0z' fill='none'/%3E%3Cpath d='M0 0h40v40H0z' fill='none' stroke='%23e2e8f0' stroke-width='1'/%3E%3C/svg%3E");
        }

        /* Hide scrollbar for smooth UI but keep functionality */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f8fafc;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
    @stack('styles')
</head>

<body class="antialiased selection:bg-gold-500 selection:text-navy-900 pb-24 md:pb-0">

    <!-- Clean Full-Width Navbar -->
    <nav
        class="fixed w-full z-50 top-0 bg-white/90 backdrop-blur-xl border-b border-navy-100 shadow-sm transition-all duration-300 opacity-0 animate-fade-in-up">
        <div class="max-w-[90rem] mx-auto px-6 h-20 flex items-center justify-between">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center gap-3 cursor-pointer group">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo DISPUSIP" class="h-10 w-auto object-contain">
                <span class="font-black text-xl tracking-tight text-navy-900 hidden sm:block">PERPUSTAKAAN UMUM
                    DAERAH</span>
            </a>

            <!-- Links -->
            <div class="hidden md:flex items-center gap-8 text-sm font-bold text-navy-800">
                <a href="{{ route('eperpus.index') }}"
                    class="{{ request()->routeIs('eperpus.index') ? 'text-gold-500' : 'hover:text-gold-500 transition-colors' }}">Beranda
                    E-Perpus</a>
                <a href="{{ route('eperpus.profil') }}"
                    class="{{ request()->routeIs('eperpus.profil') ? 'text-gold-500' : 'hover:text-gold-500 transition-colors' }}">Profil
                    E-Perpus</a>
                <a href="{{ route('public.layanan') }}"
                    class="{{ request()->routeIs('public.layanan') ? 'text-gold-500' : 'hover:text-gold-500 transition-colors' }}">Layanan</a>
                <a href="{{ route('public.aktivitas.index') }}"
                    class="{{ request()->routeIs('public.aktivitas.*') ? 'text-gold-500' : 'hover:text-gold-500 transition-colors' }}">Aktivitas</a>
                <a href="{{ route('public.rekomendasi') }}"
                    class="{{ request()->routeIs('public.rekomendasi') ? 'text-gold-500' : 'hover:text-gold-500 transition-colors' }}">Rekomendasi</a>
            </div>
        </div>
    </nav>

    <!-- GLOBAL HERO CAROUSEL INFOGRAFIS (TETAP FULL WIDTH, TAPI MURNI GAMBAR) -->
    <div class="relative w-full {{ request()->routeIs('eperpus.index') ? 'h-[60vh] md:h-[80vh]' : 'h-[35vh] md:h-[50vh]' }} bg-navy-950 overflow-hidden mt-20 group"
        x-data="{
                        activeSlide: 0,
                        slides: {{ isset($infografis) && $infografis->count() > 0 ? $infografis->count() : 1 }},
                        autoPlay() {
                            setInterval(() => {
                                this.activeSlide = this.activeSlide === this.slides - 1 ? 0 : this.activeSlide + 1
                            }, 5000)
                        }
                    }" x-init="autoPlay()">

        @if(isset($infografis) && $infografis->count() > 0)
            @foreach($infografis as $index => $info)
                <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out bg-navy-950"
                    x-show="activeSlide === {{ $index }}" x-transition:enter="transition-opacity duration-1000"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition-opacity duration-1000" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0">

                    <!-- Background fill (blur) -->
                    <img src="{{ Storage::url($info->image) }}"
                        class="absolute inset-0 w-full h-full object-cover blur-2xl opacity-40 scale-110" alt="">

                    <!-- Gambar Murni tanpa overlay teks di atasnya -->
                    <img src="{{ Storage::url($info->image) }}" alt="{{ $info->title }}"
                        class="relative w-full h-full object-contain">
                </div>
            @endforeach
        @else
            <!-- Placeholder -->
            <div class="absolute inset-0 flex items-center justify-center bg-navy-900">
                <img src="https://images.unsplash.com/photo-1507842217343-583bb7270b66?auto=format&fit=crop&q=80&w=1920"
                    class="w-full h-full object-cover opacity-40">
            </div>
        @endif

        <!-- Controls Slider -->
        @if(isset($infografis) && $infografis->count() > 1)
            <button @click="activeSlide = activeSlide === 0 ? slides - 1 : activeSlide - 1"
                class="absolute left-4 md:left-6 top-1/2 -translate-y-1/2 w-10 h-10 md:w-14 md:h-14 rounded-full bg-navy-900/50 backdrop-blur-md border border-white/20 flex items-center justify-center text-white hover:bg-gold-500 hover:text-navy-900 transition-all duration-300 z-30 shadow-lg sm:opacity-0 group-hover:opacity-100 translate-x-2 group-hover:translate-x-0">
                <svg class="w-5 h-5 md:w-6 md:h-6 ml-[-2px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            <button @click="activeSlide = activeSlide === slides - 1 ? 0 : activeSlide + 1"
                class="absolute right-4 md:right-6 top-1/2 -translate-y-1/2 w-10 h-10 md:w-14 md:h-14 rounded-full bg-navy-900/50 backdrop-blur-md border border-white/20 flex items-center justify-center text-white hover:bg-gold-500 hover:text-navy-900 transition-all duration-300 z-30 shadow-lg sm:opacity-0 group-hover:opacity-100 -translate-x-2 group-hover:translate-x-0">
                <svg class="w-5 h-5 md:w-6 md:h-6 mr-[-2px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        @endif
    </div>

    <!-- KHUSUS HALAMAN SUB-PAGES (SEPERTI PROFIL, REKOMENDASI, DLL) -->
    @if(!request()->routeIs('eperpus.index'))

        <!-- PITA TEKS BERJALAN (GEN-Z AESTHETIC MARQUEE) -->
        <div
            class="relative w-full bg-gold-400 border-y-[3px] border-navy-950 overflow-hidden flex items-center py-2.5 z-20 shadow-md">
            <div
                class="animate-marquee whitespace-nowrap flex items-center gap-6 text-navy-900 font-black text-xs md:text-sm uppercase tracking-[0.2em] px-4">
                <span>📖 E-PERPUS KOTA PADANG</span><span>&bull;</span>
                <span>LITERASI DIGITAL</span><span>&bull;</span>
                <span>📖 E-PERPUS KOTA PADANG</span><span>&bull;</span>
                <span>LITERASI DIGITAL</span><span>&bull;</span>
                <span>📖 E-PERPUS KOTA PADANG</span><span>&bull;</span>
                <span>LITERASI DIGITAL</span><span>&bull;</span>
                <span>📖 E-PERPUS KOTA PADANG</span><span>&bull;</span>
                <span>LITERASI DIGITAL</span><span>&bull;</span>
                <span>📖 E-PERPUS KOTA PADANG</span><span>&bull;</span>
                <span>LITERASI DIGITAL</span><span>&bull;</span>
                <span>📖 E-PERPUS KOTA PADANG</span><span>&bull;</span>
                <span>LITERASI DIGITAL</span><span>&bull;</span>
            </div>
        </div>

        <!-- DEDICATED TITLE SECTION (TERPISAH DARI GAMBAR) -->
        <div class="relative bg-navy-900 py-10 md:py-16 px-6 overflow-hidden border-b border-navy-800">
            <!-- Background Textures -->
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5">
            </div>
            <div
                class="absolute top-0 right-0 w-[400px] h-[400px] bg-gold-500/10 rounded-full blur-[100px] translate-x-1/3 -translate-y-1/2 pointer-events-none">
            </div>

            <div
                class="max-w-7xl mx-auto relative z-10 flex flex-col md:flex-row items-center md:items-end justify-between gap-8 text-center md:text-left">
                <div class="flex-1">
                    <span
                        class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-white/10 bg-white/5 backdrop-blur-md text-gold-400 text-[10px] sm:text-xs font-black tracking-widest uppercase mb-6 shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-gold-400 animate-pulse"></span>
                        @yield('hero_badge', 'Informasi Halaman')
                    </span>

                    <div class="max-w-4xl">
                        <!-- Teks Judul dipanggil dari masing-masing halaman -->
                        @hasSection('hero_title')
                            @yield('hero_title')
                        @else
                            <h1
                                class="text-4xl md:text-6xl lg:text-7xl font-black text-white tracking-tight uppercase leading-[1.1]">
                                Jelajahi Dunia <br>
                                <span
                                    class="text-transparent bg-clip-text bg-gradient-to-r from-gold-300 to-gold-500">E-Perpus</span>
                            </h1>
                        @endif
                    </div>
                </div>

                <!-- Ornamen Garis Scroll (Opsional untuk estetika) -->
                <div class="hidden md:flex flex-col items-center gap-3 text-navy-400">
                    <span
                        class="text-[10px] font-bold tracking-[0.2em] uppercase origin-left rotate-90 mb-8 mr-2">Eksplorasi</span>
                    <div class="w-px h-16 bg-gradient-to-b from-navy-400 to-transparent"></div>
                </div>
            </div>
        </div>
    @endif

    <!-- MAIN CONTENT YIELD -->
    @yield('content')

    <!-- Massive Footer (Hyper-Modern) -->
    <footer class="bg-navy-950 pt-24 px-6 overflow-hidden relative border-t border-navy-900">
        <div
            class="absolute top-0 right-0 w-[500px] h-[500px] bg-gold-500/10 rounded-full blur-[100px] translate-x-1/3 -translate-y-1/2">
        </div>

        <div class="max-w-7xl mx-auto relative z-10">
            <!-- Grid Links -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-24">
                <div class="col-span-1 md:col-span-4">
                    <div class="flex items-center gap-3 mb-6">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo DISPUSIP"
                            class="h-12 w-auto object-contain">
                        <span class="font-bold text-2xl text-white">DINAS PERPUSTAKAAN DAN KEARSIPAN</span>
                    </div>
                    <p class="text-navy-200/80 text-sm leading-relaxed mb-8 max-w-sm">Membangun masyarakat sadar
                        informasi dan melek literasi untuk kemajuan daerah.</p>
                </div>

                <div class="col-span-1 md:col-span-2 md:col-start-7">
                    <h4 class="font-bold text-white mb-6 uppercase text-sm tracking-widest">Layanan</h4>
                    <ul class="space-y-4 text-sm text-navy-300">
                        <li><a href="#" class="hover:text-gold-400 transition-colors">Katalog (OPAC)</a></li>
                        <li><a href="{{ route('public.arsip.index') }}"
                                class="hover:text-gold-400 transition-colors">SIKN</a></li>
                        <li><a href="#" class="hover:text-gold-400 transition-colors">Aplikasi Srikandi</a></li>
                    </ul>
                </div>

                <div class="col-span-1 md:col-span-4">
                    <h4 class="font-bold text-white mb-6 uppercase text-sm tracking-widest">Kontak</h4>
                    <ul class="space-y-4 text-sm text-navy-300">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gold-400 shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>Jl. Sudirman No. 1, Pusat Pemerintahan Kota Padang</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- MASSIVE TYPOGRAPHY -->
            <div
                class="border-t border-navy-800 pt-16 pb-8 text-center select-none overflow-hidden flex justify-center">
                <h1 class="text-[14vw] font-black text-navy-900 tracking-tighter leading-none m-0"
                    style="-webkit-text-stroke: 1px rgba(255,255,255,0.1);">
                    DISPUSIP
                </h1>
            </div>

            <div
                class="pb-8 flex flex-col md:flex-row justify-between items-center text-xs text-navy-500 font-medium border-t border-navy-900 pt-8">
                <p>&copy; {{ date('Y') }} Pemerintah Kota Padang.</p>
                <div class="flex gap-4 mt-4 md:mt-0">
                    <a href="#" class="hover:text-gold-400 transition-colors">Kebijakan Privasi</a>
                    <a href="#" class="hover:text-gold-400 transition-colors">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Mobile Bottom Navigation (Floating Pill) -->
    <div class="md:hidden fixed bottom-4 inset-x-0 mx-auto w-[95%] max-w-[420px] z-50 animate-fade-in-up delay-300">
        <div
            class="bg-white/90 backdrop-blur-xl border border-gray-200 shadow-[0_10px_40px_rgba(0,0,0,0.1)] rounded-full p-1.5 flex justify-between items-center">
            <a href="{{ route('eperpus.index') }}"
                class="flex flex-col items-center justify-center w-12 h-11 rounded-full {{ request()->routeIs('eperpus.index') ? 'text-gold-600 bg-gold-50' : 'text-gray-400 hover:text-navy-900 hover:bg-gray-50' }} transition-all active:scale-95">
                <svg class="w-5 h-5 mb-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span class="text-[8px] font-bold tracking-wide">Beranda</span>
            </a>
            <a href="{{ route('eperpus.profil') }}"
                class="flex flex-col items-center justify-center w-12 h-11 rounded-full {{ request()->routeIs('eperpus.profil') ? 'text-gold-600 bg-gold-50' : 'text-gray-400 hover:text-navy-900 hover:bg-gray-50' }} transition-all active:scale-95">
                <svg class="w-5 h-5 mb-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span class="text-[8px] font-bold tracking-wide">Profil</span>
            </a>
            <a href="{{ route('public.layanan') }}"
                class="flex flex-col items-center justify-center w-12 h-11 rounded-full {{ request()->routeIs('public.layanan') ? 'text-gold-600 bg-gold-50' : 'text-gray-400 hover:text-navy-900 hover:bg-gray-50' }} transition-all active:scale-95">
                <svg class="w-5 h-5 mb-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                <span class="text-[8px] font-bold tracking-wide">Layanan</span>
            </a>
            <a href="{{ route('public.aktivitas.index') }}"
                class="flex flex-col items-center justify-center w-12 h-11 rounded-full {{ request()->routeIs('public.aktivitas.*') ? 'text-gold-600 bg-gold-50' : 'text-gray-400 hover:text-navy-900 hover:bg-gray-50' }} transition-all active:scale-95">
                <svg class="w-5 h-5 mb-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <span class="text-[8px] font-bold tracking-wide">Aktivitas</span>
            </a>
            @auth
                <a href="{{ url('/dashboard') }}"
                    class="flex flex-col items-center justify-center w-12 h-11 rounded-full text-gray-400 hover:text-navy-900 hover:bg-gray-50 transition-all active:scale-95">
                    <svg class="w-5 h-5 mb-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="text-[8px] font-bold tracking-wide">Akun</span>
                </a>
            @else
                <a href="{{ route('login') }}"
                    class="flex flex-col items-center justify-center w-12 h-11 rounded-full text-gray-400 hover:text-navy-900 hover:bg-gray-50 transition-all active:scale-95">
                    <svg class="w-5 h-5 mb-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    <span class="text-[8px] font-bold tracking-wide">Masuk</span>
                </a>
            @endauth
        </div>
    </div>

    @stack('scripts')
</body>

</html>
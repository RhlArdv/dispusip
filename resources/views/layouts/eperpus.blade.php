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

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    @stack('styles')
</head>

<body class="antialiased selection:bg-gold-500 selection:text-navy-900 pb-24 md:pb-0">

    <!-- Navbar -->
    <nav
        class="fixed w-full z-50 top-0 bg-white/90 backdrop-blur-xl border-b border-navy-100 shadow-sm transition-all duration-300">
        <div class="max-w-[90rem] mx-auto px-6 h-20 flex items-center justify-between">
            <a href="{{ url('/e-perpus') }}" class="flex items-center gap-3 cursor-pointer group">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo DISPUSIP" class="h-10 w-auto object-contain">
                <span class="font-black text-xl tracking-tight text-navy-900 hidden sm:block uppercase">PERPUSTAKAAN
                    UMUM DAERAH</span>
            </a>

            <div class="hidden md:flex items-center gap-8 text-sm font-bold text-navy-800">
                <a href="{{ route('eperpus.index') }}"
                    class="{{ request()->routeIs('eperpus.index') ? 'text-gold-500' : 'hover:text-gold-500 transition-colors' }}">Beranda</a>
                <a href="{{ route('eperpus.profil') }}"
                    class="{{ request()->routeIs('eperpus.profil') ? 'text-gold-500' : 'hover:text-gold-500 transition-colors' }}">Profil</a>
                <a href="{{ route('public.layanan') }}"
                    class="{{ request()->routeIs('public.layanan') ? 'text-gold-500' : 'hover:text-gold-500 transition-colors' }}">Layanan</a>
                <a href="{{ route('public.aktivitas.index') }}"
                    class="{{ request()->routeIs('public.aktivitas.*') ? 'text-gold-500' : 'hover:text-gold-500 transition-colors' }}">Aktivitas</a>
                <a href="{{ route('public.rekomendasi') }}"
                    class="{{ request()->routeIs('public.rekomendasi') ? 'text-gold-500' : 'hover:text-gold-500 transition-colors' }}">Rekomendasi</a>
                <a href="{{ route('public.multimedia.index') }}"
                    class="{{ request()->routeIs('public.multimedia.*') || request()->routeIs('public.galeri.*') || request()->routeIs('public.video.*') ? 'text-gold-500' : 'hover:text-gold-500 transition-colors' }}">Multimedia</a>
            </div>
        </div>
    </nav>

    <!-- GLOBAL HERO CAROUSEL INFOGRAFIS (TETAP FULL WIDTH, TAPI MURNI GAMBAR) -->
    <div class="relative w-full h-[60vh] md:h-[80vh] bg-navy-950 overflow-hidden mt-20 group" x-data="{
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

                    {{-- Background fill (blur) --}}
                    <img src="{{ Storage::url($info->image) }}"
                        class="absolute inset-0 w-full h-full object-cover blur-2xl opacity-40 scale-110" alt="">

                    {{-- Main Image --}}
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

        {{-- Carousel Controls Slider --}}
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

    {{-- SUB-PAGE HEADER SECTION (Always below Carousel if it exists, or standalone) --}}
    @if(!request()->routeIs('eperpus.index') && (isset($__env->getSections()['hero_title']) || isset($__env->getSections()['hero_badge'])))
        <div class="relative py-20 px-6 bg-white overflow-hidden border-b border-navy-50">
            {{-- Decorative background text --}}
            <div
                class="absolute top-0 right-0 text-[12rem] font-black text-gray-50 select-none -z-10 leading-none translate-x-1/4 -translate-y-1/4">
                LIB
            </div>

            <div class="max-w-7xl mx-auto flex flex-col items-center text-center">
                {{-- Badge --}}
                @if(isset($__env->getSections()['hero_badge']))
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-navy-100 bg-navy-50 text-navy-600 text-[10px] font-bold uppercase tracking-widest mb-6">
                        <span class="w-2 h-2 rounded-full bg-gold-500 animate-ping"></span>
                        @yield('hero_badge')
                    </div>
                @else
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-navy-100 bg-navy-50 text-navy-600 text-[10px] font-bold uppercase tracking-widest mb-6">
                        <span class="w-2 h-2 rounded-full bg-gold-500 animate-ping"></span>
                        E-Perpus Information
                    </div>
                @endif

                {{-- Title --}}
                <div class="relative">
                    @yield('hero_title')
                </div>

                {{-- Breadcrumbs --}}
                <nav class="flex items-center gap-3 mt-8 text-[11px] font-bold text-gray-400 uppercase tracking-[0.2em]">
                    <a href="{{ route('eperpus.index') }}" class="hover:text-navy-900 transition-colors">Home</a>
                    <svg class="w-3 h-3 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        stroke-width="3">
                        <path d="M9 5l7 7-7 7" />
                    </svg>
                    <span class="text-navy-900">@yield('title')</span>
                </nav>
            </div>
        </div>
    @endif

    <!-- MAIN CONTENT -->
    <main class="relative z-10">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-navy-950 pt-32 pb-12 px-6 overflow-hidden relative mt-20">
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-gold-500/5 rounded-full blur-[120px] translate-x-1/4 -translate-y-1/2"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-navy-500/5 rounded-full blur-[100px] -translate-x-1/4 translate-y-1/2"></div>

        <div class="max-w-7xl mx-auto relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-16 mb-32">
                <div class="space-y-10">
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo DISPUSIP" class="h-16 w-auto">
                        <div class="flex flex-col">
                            <span class="font-black text-2xl text-white tracking-tighter leading-none uppercase">DISPUSIP</span>
                            <span class="font-bold text-[10px] text-gold-500 tracking-[0.3em] uppercase mt-1">KOTA PADANG</span>
                        </div>
                    </div>
                    <p class="text-navy-300 text-sm font-medium leading-relaxed max-w-xs">
                        Membangun peradaban melalui literasi digital dan pelestarian arsip bersejarah Kota Padang.
                    </p>
                    <div class="flex gap-4">
                        @php
                            $socials = [
                                ['icon' => 'M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z', 'link' => 'https://facebook.com/dispusippadang'],
                                ['icon' => 'M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z', 'link' => 'https://instagram.com/dispusipkotapadang'],
                                ['icon' => 'M22.54 6.42a2.78 2.78 0 00-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 00-1.94 2A29 29 0 001 11.75a29 29 0 00.46 5.33A2.78 2.78 0 003.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 001.94-2 29 29 0 00.46-5.25 29 29 0 00-.46-5.33zM9.75 15.02V8.48L15.45 11.75l-5.7 3.27z', 'link' => 'https://youtube.com/channel/UCwWcnExzCmmFYUUIhlpFFWw'],
                            ];
                        @endphp
                        @foreach($socials as $soc)
                            <a href="{{ $soc['link'] }}" target="_blank" class="w-10 h-10 rounded-xl bg-navy-900 border border-white/5 flex items-center justify-center text-navy-300 hover:text-gold-400 hover:border-gold-400/50 transition-all active:scale-90">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="{{ $soc['icon'] }}" /></svg>
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="lg:pl-12">
                    <h4 class="text-white font-black text-xs uppercase tracking-[0.3em] mb-10 flex items-center gap-3">
                        <span class="w-8 h-px bg-gold-500"></span> Layanan Digital
                    </h4>
                    <ul class="space-y-5">
                        @foreach(['OPAC' => 'https://inlislite.pdg.web.id/opac', 'One Search' => 'https://onesearch.id/', 'IPUSNAS' => '#', 'E-Arsip' => '#'] as $name => $link)
                            <li><a href="{{ $link }}" class="text-navy-300 hover:text-gold-500 transition-colors text-sm font-bold uppercase tracking-widest flex items-center gap-2 group">
                                <span class="w-1.5 h-1.5 rounded-full bg-navy-800 group-hover:bg-gold-500 transition-all"></span>
                                {{ $name }}
                            </a></li>
                        @endforeach
                    </ul>
                </div>

                <div class="lg:pl-12">
                    <h4 class="text-white font-black text-xs uppercase tracking-[0.3em] mb-10 flex items-center gap-3">
                        <span class="w-8 h-px bg-gold-500"></span> Informasi
                    </h4>
                    <ul class="space-y-5">
                        @foreach(['Tentang Kami' => '/profil/tentang-kami', 'Visi & Misi' => '/profil/visi-misi', 'Struktur' => '/profil/struktur-organisasi', 'Layanan Gedung' => route('public.layanan')] as $name => $link)
                            <li><a href="{{ $link }}" class="text-navy-300 hover:text-gold-500 transition-colors text-sm font-bold uppercase tracking-widest flex items-center gap-2 group">
                                <span class="w-1.5 h-1.5 rounded-full bg-navy-800 group-hover:bg-gold-500 transition-all"></span>
                                {{ $name }}
                            </a></li>
                        @endforeach
                    </ul>
                </div>

                <div class="lg:pl-12">
                    <h4 class="text-white font-black text-xs uppercase tracking-[0.3em] mb-10 flex items-center gap-3">
                        <span class="w-8 h-px bg-gold-500"></span> Hubungi Kami
                    </h4>
                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-navy-900 border border-white/5 flex items-center justify-center text-gold-500 shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /></svg>
                            </div>
                            <p class="text-navy-300 text-xs font-bold leading-relaxed uppercase tracking-wider">Jl. Bagindo Aziz Chan No. 2, Padang</p>
                        </div>
                        <div class="flex items-center gap-4 group">
                            <div class="w-10 h-10 rounded-xl bg-navy-900 border border-white/5 flex items-center justify-center text-green-500 group-hover:bg-green-500 group-hover:text-white transition-all shrink-0">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" /></svg>
                            </div>
                            <span class="text-navy-200 text-sm font-black group-hover:text-gold-500 transition-colors tracking-tighter">0812-6650-3399</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Massive Typography -->
            <div class="relative py-16 flex justify-center border-t border-white/5 overflow-hidden">
                <h1 class="text-[14vw] font-black text-white/5 tracking-tighter leading-none m-0 pointer-events-none select-none uppercase">
                    E-PERPUS
                </h1>
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="h-px w-full bg-gradient-to-r from-transparent via-gold-500/20 to-transparent"></div>
                </div>
            </div>

            <div class="pt-12 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-6">
                <p class="text-[10px] text-navy-500 font-bold tracking-[0.2em] uppercase">
                    &copy; {{ date('Y') }} Pemerintah Kota Padang. Built for future.
                </p>
                <div class="flex gap-8">
                    <a href="#" class="text-[10px] text-navy-500 font-bold hover:text-gold-500 transition-colors uppercase tracking-widest">Privacy Policy</a>
                    <a href="#" class="text-[10px] text-navy-500 font-bold hover:text-gold-500 transition-colors uppercase tracking-widest">Terms of Use</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Mobile Bottom Navigation (Floating Pill) -->
    <div class="md:hidden fixed bottom-6 inset-x-0 mx-auto w-[92%] max-w-[480px] z-50 animate-fade-in-up delay-300">
        <div class="bg-white/90 backdrop-blur-2xl border border-white/20 shadow-[0_20px_50px_rgba(15,36,64,0.15)] rounded-[2rem] p-1.5 flex justify-around items-center">
            <!-- Profil -->
            <a href="{{ route('eperpus.profil') }}"
                class="flex flex-col items-center justify-center w-16 h-12 rounded-2xl transition-all active:scale-90 {{ request()->routeIs('eperpus.profil') ? 'text-gold-600 bg-gold-50' : 'text-navy-400 hover:text-navy-900' }}">
                <svg class="w-5 h-5 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span class="text-[9px] font-black uppercase tracking-tighter">Profil</span>
            </a>
            <!-- Layanan -->
            <a href="{{ route('public.layanan') }}"
                class="flex flex-col items-center justify-center w-16 h-12 rounded-2xl transition-all active:scale-90 {{ request()->routeIs('public.layanan') ? 'text-gold-600 bg-gold-50' : 'text-navy-400 hover:text-navy-900' }}">
                <svg class="w-5 h-5 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                <span class="text-[9px] font-black uppercase tracking-tighter">Layanan</span>
            </a>
            <!-- Aktivitas -->
            <a href="{{ route('public.aktivitas.index') }}"
                class="flex flex-col items-center justify-center w-16 h-12 rounded-2xl transition-all active:scale-90 {{ request()->routeIs('public.aktivitas.*') ? 'text-gold-600 bg-gold-50' : 'text-navy-400 hover:text-navy-900' }}">
                <svg class="w-5 h-5 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <span class="text-[9px] font-black uppercase tracking-tighter">Event</span>
            </a>
            <!-- Rekomendasi -->
            <a href="{{ route('public.rekomendasi') }}"
                class="flex flex-col items-center justify-center w-16 h-12 rounded-2xl transition-all active:scale-90 {{ request()->routeIs('public.rekomendasi') ? 'text-gold-600 bg-gold-50' : 'text-navy-400 hover:text-navy-900' }}">
                <svg class="w-5 h-5 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                </svg>
                <span class="text-[9px] font-black uppercase tracking-tighter">Saran</span>
            </a>
            <!-- Galeri/Video -->
            <a href="{{ route('public.multimedia.index') }}"
                class="flex flex-col items-center justify-center w-16 h-12 rounded-2xl transition-all active:scale-90 {{ request()->routeIs('public.multimedia.*') || request()->routeIs('public.galeri.*') || request()->routeIs('public.video.*') ? 'text-gold-600 bg-gold-50' : 'text-navy-400 hover:text-navy-900' }}">
                <svg class="w-5 h-5 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                </svg>
                <span class="text-[9px] font-black uppercase tracking-tighter">Media</span>
            </a>
        </div>
    </div>

    @stack('scripts')
</body>

</html>
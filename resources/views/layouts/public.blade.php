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
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
                        'marquee': 'marquee 35s linear infinite',
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

        .delay-100 {
            animation-delay: 100ms;
        }

        .delay-200 {
            animation-delay: 200ms;
        }

        .delay-300 {
            animation-delay: 300ms;
        }

        .delay-400 {
            animation-delay: 400ms;
        }

        .bento-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 10px 40px rgba(15, 36, 64, 0.05);
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
                <span class="font-black text-xl tracking-tight text-navy-900">DINAS PERPUSTAKAAN DAN KEARSIPAN</span>
            </a>

            <!-- Links -->
            <div class="hidden md:flex items-center gap-8 text-sm font-bold text-navy-800">
                <a href="{{ url('/') }}" class="hover:text-gold-500 transition-colors">Beranda</a>
                <a href="{{ url('/profil/tentang-kami') }}" class="hover:text-gold-500 transition-colors">Profil</a>
                <a href="{{ route('public.arsip.index') }}" class="hover:text-gold-500 transition-colors">Arsip</a>
                <a href="{{ route('eperpus.index') }}" class="hover:text-gold-500 transition-colors">Perpustakaan</a>
            </div>

            <!-- Actions -->
            {{-- <div class="flex items-center gap-4">
                @if (Route::has('login'))
                @auth
                <a href="{{ url('/dashboard') }}"
                    class="bg-navy-900 text-white px-6 py-2.5 rounded text-sm font-bold hover:bg-navy-800 transition-all shadow-md">Dashboard</a>
                @else
                <a href="{{ route('login') }}"
                    class="text-sm font-bold text-navy-800 hover:text-gold-600 hidden sm:block">Masuk</a>
                @if (Route::has('register'))
                <a href="{{ route('register') }}"
                    class="bg-gold-400 text-navy-900 px-6 py-2.5 rounded text-sm font-bold hover:bg-gold-500 transition-all shadow-md transform hover:-translate-y-0.5">Daftar</a>
                @endif
                @endauth
                @endif
            </div> --}}
        </div>
    </nav>

    @yield('content')

    <!-- Footer -->
    <footer class="bg-navy-950 pt-24 px-6 overflow-hidden relative border-t border-navy-900 mt-20">

        <div
            class="absolute top-0 right-0 w-[500px] h-[500px] bg-gold-500/10 rounded-full blur-[100px] translate-x-1/3 -translate-y-1/2">
        </div>

        <div class="max-w-7xl mx-auto relative z-10">
            <!-- Footer Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-20">
                <!-- Brand & Hours -->
                <div class="space-y-8">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo DISPUSIP"
                            class="h-14 w-auto object-contain">
                        <div class="flex flex-col">
                            <span
                                class="font-black text-xl text-white leading-none tracking-tighter uppercase">PERPUSTAKAAN
                                UMUM</span>
                            <span class="font-bold text-xs text-gold-500 tracking-widest uppercase">DAERAH KOTA
                                PADANG</span>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <h4 class="text-xs font-black text-white uppercase tracking-[0.2em] flex items-center gap-2">
                            <span class="w-8 h-px bg-gold-500"></span> JAM OPERASIONAL
                        </h4>
                        <ul class="text-xs text-navy-200 font-bold space-y-2 uppercase tracking-wider">
                            <li class="flex justify-between border-b border-white/5 pb-1"><span>SENIN - KAMIS</span>
                                <span class="text-white">08.00 - 15.30 WIB</span>
                            </li>
                            <li class="flex justify-between border-b border-white/5 pb-1"><span>JUM'AT</span> <span
                                    class="text-white">08.00 - 16.00 WIB</span></li>
                            <li class="text-red-400/80">SABTU DAN MINGGU TUTUP</li>
                            <li class="text-red-400/80">CUTI BERSAMA & LIBUR NASIONAL TUTUP</li>
                        </ul>
                    </div>

                    <!-- Media Sosial -->
                    <div class="flex gap-2">
                        <a href="https://www.facebook.com/dispusippadang/"
                            class="w-9 h-9 rounded-lg bg-navy-900 border border-navy-800 flex items-center justify-center text-white hover:bg-blue-600 hover:border-blue-600 transition-all transform hover:-translate-y-1"><svg
                                class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg></a>
                        <a href="https://www.instagram.com/dispusipkotapadang/"
                            class="w-9 h-9 rounded-lg bg-navy-900 border border-navy-800 flex items-center justify-center text-white hover:bg-gradient-to-tr hover:from-yellow-400 hover:to-purple-600 hover:border-transparent transition-all transform hover:-translate-y-1"><svg
                                class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg></a>
                        <a href="#"
                            class="w-9 h-9 rounded-lg bg-navy-900 border border-navy-800 flex items-center justify-center text-white hover:bg-black hover:border-black transition-all transform hover:-translate-y-1"><svg
                                class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12.525.02c1.31-.02 2.61-.01 3.91-.01 1.01.08 2.02.15 3.03.3 1.49.18 2.3.88 3.05 2.11.49.81.71 1.7.73 2.65.03 3.55.02 7.1.01 10.65 0 1.05-.1 2.1-.55 3.05-.59 1.26-1.51 1.91-2.89 2.1-.73.1-1.48.13-2.22.14-3.45.03-6.91.02-10.36 0-1.05-.01-2.11-.11-3.11-.55-1.33-.6-1.99-1.55-2.18-2.98-.1-.78-.13-1.57-.14-2.35-.03-3.45-.02-6.9 0-10.35 0-1.05.1-2.1.54-3.11.59-1.33 1.55-1.99 3.01-2.18.73-.1 1.46-.13 2.19-.14 2.1-.03 4.21-.02 6.32-.02zm-1.89 12.01h1.36c.14-2.11.23-4.22.31-6.33h-1.36c-.08 2.11-.17 4.22-.31 6.33zm-.08 2.65h1.46v-1.4h-1.46v1.4z" />
                            </svg></a>
                        <a href="https://www.youtube.com/channel/UCwWcnExzCmmFYUUIhlpFFWw/about"
                            class="w-9 h-9 rounded-lg bg-navy-900 border border-navy-800 flex items-center justify-center text-white hover:bg-red-600 hover:border-red-600 transition-all transform hover:-translate-y-1"><svg
                                class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                            </svg></a>
                    </div>
                </div>

                <!-- Digital Services -->
                <div class="lg:pl-8">
                    <h4 class="font-black text-white mb-8 uppercase text-xs tracking-[0.2em] text-gold-500">LAYANAN
                        DIGITAL</h4>
                    <ul class="space-y-4 text-xs text-navy-200 font-bold uppercase tracking-wider">
                        <li><a href="#"
                                class="hover:text-gold-400 transition-colors flex items-center gap-2 group"><span
                                    class="w-1.5 h-1.5 rounded-full bg-navy-800 group-hover:bg-gold-500 transition-colors"></span>
                                ISBN DAN QRCDN</a></li>
                        <li><a href="https://inlislite.pdg.web.id/opac"
                                class="hover:text-gold-400 transition-colors flex items-center gap-2 group"><span
                                    class="w-1.5 h-1.5 rounded-full bg-navy-800 group-hover:bg-gold-500 transition-colors"></span>
                                OPAC</a></li>
                        <li><a href="https://onesearch.id/"
                                class="hover:text-gold-400 transition-colors flex items-center gap-2 group"><span
                                    class="w-1.5 h-1.5 rounded-full bg-navy-800 group-hover:bg-gold-500 transition-colors"></span>
                                ONE SEARCH ID</a></li>
                        <li><a href="#"
                                class="hover:text-gold-400 transition-colors flex items-center gap-2 group"><span
                                    class="w-1.5 h-1.5 rounded-full bg-navy-800 group-hover:bg-gold-500 transition-colors"></span>
                                IPUSNAS</a></li>
                    </ul>
                </div>

                <!-- Physical Services -->
                <div class="lg:pl-8">
                    <h4 class="font-black text-white mb-8 uppercase text-xs tracking-[0.2em] text-gold-500">LAYANAN
                        GEDUNG</h4>
                    <ul class="space-y-4 text-xs text-navy-200 font-bold uppercase tracking-wider">
                        <li><a href="#"
                                class="hover:text-gold-400 transition-colors flex items-center gap-2 group"><span
                                    class="w-1.5 h-1.5 rounded-full bg-navy-800 group-hover:bg-gold-500 transition-colors"></span>
                                VIRTUAL TOUR</a></li>
                        <li><a href="{{ route('public.aktivitas.index') }}"
                                class="hover:text-gold-400 transition-colors flex items-center gap-2 group"><span
                                    class="w-1.5 h-1.5 rounded-full bg-navy-800 group-hover:bg-gold-500 transition-colors"></span>
                                AGENDA KEGIATAN</a></li>
                        <li><a href="#"
                                class="hover:text-gold-400 transition-colors flex items-center gap-2 group"><span
                                    class="w-1.5 h-1.5 rounded-full bg-navy-800 group-hover:bg-gold-500 transition-colors"></span>
                                LAYANAN BERBASIS TIK</a></li>
                        <li><a href="{{ route('public.arsip.index') }}"
                                class="hover:text-gold-400 transition-colors flex items-center gap-2 group"><span
                                    class="w-1.5 h-1.5 rounded-full bg-navy-800 group-hover:bg-gold-500 transition-colors"></span>
                                SIKN (ARSIP)</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="space-y-8">
                    <div>
                        <h4 class="font-black text-white mb-6 uppercase text-xs tracking-[0.2em] text-gold-500">KONTAK
                            KAMI</h4>
                        <ul class="space-y-4 text-xs text-navy-200 font-bold uppercase tracking-wider">
                            <li class="flex items-center gap-3 group">
                                <div
                                    class="w-9 h-9 rounded-lg bg-navy-900 border border-navy-800 flex items-center justify-center text-green-500 group-hover:bg-green-500 group-hover:text-white transition-all">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                                    </svg>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-[9px] text-navy-400">WHATSAPP</span>
                                    <span
                                        class="text-white group-hover:text-gold-500 transition-colors">0812-6650-3399</span>
                                </div>
                            </li>
                            <li class="flex items-center gap-3">
                                <div
                                    class="w-9 h-9 rounded-lg bg-navy-900 border border-navy-800 flex items-center justify-center text-gold-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div class="flex flex-col normal-case">
                                    <span class="text-white text-[10px] break-all">info@dispusip.padang.go.id</span>
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <div
                                    class="w-9 h-9 rounded-lg bg-navy-900 border border-navy-800 flex items-center justify-center text-gold-500 shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-white leading-tight text-[10px]">Jl. Bagindo Aziz Chan No. 2,
                                        Padang</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- MASSIVE TYPOGRAPHY -->
            <div
                class="border-t border-navy-900 pt-16 pb-8 text-center select-none overflow-hidden flex justify-center">
                <h1 class="text-[14vw] font-black text-navy-900 tracking-tighter leading-none m-0"
                    style="-webkit-text-stroke: 1px rgba(255,255,255,0.05);">
                    DISPUSIP
                </h1>
            </div>

            <div class="border-t border-navy-900 py-12 flex flex-col md:flex-row justify-between items-center gap-6">
                <p class="text-xs text-navy-500 font-bold tracking-widest uppercase">
                    &copy; {{ date('Y') }} Pemerintah Kota Padang. All Rights Reserved.
                </p>
                <div class="flex gap-8 text-[10px] font-black uppercase tracking-widest text-navy-500">
                    <a href="#" class="hover:text-gold-400 transition-colors">Privacy Policy</a>
                    <a href="#" class="hover:text-gold-400 transition-colors">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Mobile Bottom Navigation (Floating Pill) -->
    <div class="md:hidden fixed bottom-4 inset-x-0 mx-auto w-[90%] max-w-[400px] z-50 animate-fade-in-up delay-300">
        <div
            class="bg-white/90 backdrop-blur-xl border border-gray-200 shadow-[0_10px_40px_rgba(0,0,0,0.1)] rounded-full p-1.5 flex justify-around items-center">
            <!-- Beranda -->
            <a href="{{ url('/') }}"
                class="flex flex-col items-center justify-center w-14 h-12 rounded-full {{ request()->is('/') ? 'text-gold-600 bg-gold-50' : 'text-gray-400 hover:text-navy-900 hover:bg-gray-50' }} transition-all active:scale-95">
                <svg class="w-5 h-5 mb-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span class="text-[9px] font-bold tracking-wide">Beranda</span>
            </a>
            <!-- Profil -->
            <a href="#"
                class="flex flex-col items-center justify-center w-14 h-12 rounded-full text-gray-400 hover:text-navy-900 hover:bg-gray-50 transition-all active:scale-95">
                <svg class="w-5 h-5 mb-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span class="text-[9px] font-bold tracking-wide">Profil</span>
            </a>
            <!-- Arsip -->
            <a href="{{ route('public.arsip.index') }}"
                class="flex flex-col items-center justify-center w-14 h-12 rounded-full {{ request()->routeIs('public.arsip.*') ? 'text-gold-600 bg-gold-50' : 'text-gray-400 hover:text-navy-900 hover:bg-gray-50' }} transition-all active:scale-95">
                <svg class="w-5 h-5 mb-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                </svg>
                <span class="text-[9px] font-bold tracking-wide">Arsip</span>
            </a>
            <!-- Perpustakaan -->
            <a href="{{ route('eperpus.index') }}"
                class="flex flex-col items-center justify-center w-14 h-12 rounded-full text-gray-400 hover:text-navy-900 hover:bg-gray-50 transition-all active:scale-95">
                <svg class="w-5 h-5 mb-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                <span class="text-[9px] font-bold tracking-wide">Perpus</span>
            </a>
        </div>
    </div>

    @stack('scripts')
</body>

</html>
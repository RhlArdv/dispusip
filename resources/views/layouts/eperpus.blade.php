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
    <!-- Alpine.js for interactive components -->
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

<body class="antialiased selection:bg-gold-500 selection:text-navy-900">

    <!-- Clean Full-Width Navbar -->
    <nav
        class="fixed w-full z-50 top-0 bg-white/90 backdrop-blur-xl border-b border-navy-100 shadow-sm transition-all duration-300 opacity-0 animate-fade-in-up">
        <div class="max-w-[90rem] mx-auto px-6 h-20 flex items-center justify-between">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center gap-3 cursor-pointer group">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo DISPUSIP" class="h-10 w-auto object-contain">
                <span class="font-black text-xl tracking-tight text-navy-900">PERPUSTAKAAN UMUM DAERAH KOTA
                    PADANG</span>
            </a>

            <!-- Links -->
            <div class="hidden md:flex items-center gap-8 text-sm font-bold text-navy-800">
                <!-- <a href="{{ url('/') }}" class="hover:text-gold-500 transition-colors">Portal Utama</a> -->
                <a href="{{ route('eperpus.index') }}" class="hover:text-gold-500 transition-colors">Beranda
                    E-Perpus</a>
                <a href="#" target="_blank" class="hover:text-gold-500 transition-colors">Profil E-Perpus</a>
                <a href="#" target="_blank" class="hover:text-gold-500 transition-colors">Layanan</a>
                <a href="{{ route('public.aktivitas.index') }}" class="hover:text-gold-500 transition-colors">Aktivitas</a>
                <a href="#" target="_blank" class="hover:text-gold-500 transition-colors">Rekomendasi</a>
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-4">
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
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- Massive Footer (Hyper-Modern) -->
    <footer class="bg-navy-950 pt-24 px-6 overflow-hidden relative">
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
                    <div class="flex gap-4">
                        <a href="#"
                            class="w-10 h-10 rounded-full border border-navy-800 flex items-center justify-center text-white hover:bg-gold-500 hover:border-gold-500 hover:text-navy-900 transition-all"><svg
                                class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                            </svg></a>
                        <a href="#"
                            class="w-10 h-10 rounded-full border border-navy-800 flex items-center justify-center text-white hover:bg-gold-500 hover:border-gold-500 hover:text-navy-900 transition-all"><svg
                                class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg></a>
                    </div>
                </div>

                <div class="col-span-1 md:col-span-2 md:col-start-7">
                    <h4 class="font-bold text-white mb-6 uppercase text-sm tracking-widest">Layanan</h4>
                    <ul class="space-y-4 text-sm text-navy-300">
                        <li><a href="#" class="hover:text-gold-400 transition-colors">Katalog (OPAC)</a></li>
                        <li><a href="{{ route('public.arsip.index') }}"
                                class="hover:text-gold-400 transition-colors">SIKN</a>
                        </li>
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

    @stack('scripts')
</body>

</html>
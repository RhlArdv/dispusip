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
                    DISPUSIP
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
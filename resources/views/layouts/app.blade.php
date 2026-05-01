<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — DISPUSIP</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- CDN Fallback (For Mobile Testing/Firewall issues) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=Poppins:wght@600;700&display=swap" rel="stylesheet">

    @stack('styles')

    <style>
        * { font-family: 'DM Sans', sans-serif; }
        ::-webkit-scrollbar { width: 4px; height: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 99px; }
        ::-webkit-scrollbar-thumb:hover { background: #cbd5e1; }

        .nav-item-active::before {
            content: '';
            position: absolute;
            left: 0; top: 6px; bottom: 6px;
            width: 3px;
            background: #4f46e5;
            border-radius: 0 3px 3px 0;
        }

        main { animation: fadeUp 0.25s ease both; }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(6px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        #sidebar { transition: transform 0.25s cubic-bezier(.4,0,.2,1); }

        .brand-font { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-[#F3F4F6] text-gray-800 antialiased" x-data="{ sidebarOpen: false }">

    {{-- Mobile overlay --}}
    <div x-show="sidebarOpen"
         style="display: none;"
         x-transition.opacity
         @click="sidebarOpen = false"
         class="fixed inset-0 z-20 bg-black/30 backdrop-blur-sm lg:hidden"></div>

    <div class="flex min-h-screen">

        {{-- ================================================
             SIDEBAR
             ================================================ --}}
        <aside id="sidebar"
               class="fixed inset-y-0 left-0 z-30 w-[260px] bg-white border-r border-gray-100
                      flex flex-col -translate-x-full lg:translate-x-0"
               :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }">

            {{-- Brand --}}
            <div class="flex items-center justify-between px-5 h-[60px] border-b border-gray-100 flex-shrink-0">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-indigo-500 to-blue-600
                                flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                  d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <span class="brand-font font-bold text-gray-900 text-[15px] tracking-tight">DISPUSIP</span>
                </div>
                <button @click="sidebarOpen = false"
                        class="lg:hidden p-1 text-gray-400 hover:text-gray-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Nav --}}
            <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-0.5">

                <p class="px-3 pt-1 pb-2 text-[10px] font-semibold text-gray-400 uppercase tracking-widest">Menu Utama</p>

                @if(auth()->user()->hasPermission('view_dashboard'))
                @php $activeDashboard = request()->routeIs('dashboard'); @endphp
                <a href="{{ route('dashboard') }}"
                   class="relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-[13px] font-medium
                          transition-all {{ $activeDashboard ? 'nav-item-active bg-indigo-50 text-indigo-700 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="w-[17px] h-[17px] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="{{ $activeDashboard ? '2.2' : '1.8' }}"
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>
                @endif

                @php
                    $isProfilActive = request()->routeIs('admin.tentang-kami', 'admin.visi-misi', 'admin.struktur-organisasi', 'admin.tupoksi', 'admin.kontak-kami', 'admin.pejabat.*');
                @endphp
                <div x-data="{ open: {{ $isProfilActive ? 'true' : 'false' }} }">
                    <button @click="open = !open" 
                            class="w-full relative flex items-center justify-between px-3 py-2.5 rounded-xl text-[13px] font-medium transition-all {{ $isProfilActive ? 'bg-indigo-50/50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <div class="flex items-center gap-3">
                            <svg class="w-[17px] h-[17px] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="{{ $isProfilActive ? '2.2' : '1.8' }}" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            <span class="{{ $isProfilActive ? 'font-semibold' : '' }}">Profil Instansi</span>
                        </div>
                        <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    
                    <div x-show="open" style="display: none;"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 -translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="pl-9 pr-3 pt-1 pb-2 space-y-1 mt-1">
                        <a href="{{ route('admin.tentang-kami') }}" class="block px-3 py-2 rounded-lg text-xs font-medium transition-colors {{ request()->routeIs('admin.tentang-kami') ? 'bg-indigo-50 text-indigo-700 font-bold' : 'text-gray-500 hover:text-gray-800 hover:bg-gray-50' }}">Tentang Kami</a>
                        <a href="{{ route('admin.visi-misi') }}" class="block px-3 py-2 rounded-lg text-xs font-medium transition-colors {{ request()->routeIs('admin.visi-misi') ? 'bg-indigo-50 text-indigo-700 font-bold' : 'text-gray-500 hover:text-gray-800 hover:bg-gray-50' }}">Visi & Misi</a>
                        <a href="{{ route('admin.struktur-organisasi') }}" class="block px-3 py-2 rounded-lg text-xs font-medium transition-colors {{ request()->routeIs('admin.struktur-organisasi') ? 'bg-indigo-50 text-indigo-700 font-bold' : 'text-gray-500 hover:text-gray-800 hover:bg-gray-50' }}">Struktur Organisasi</a>
                        <a href="{{ route('admin.tupoksi') }}" class="block px-3 py-2 rounded-lg text-xs font-medium transition-colors {{ request()->routeIs('admin.tupoksi') ? 'bg-indigo-50 text-indigo-700 font-bold' : 'text-gray-500 hover:text-gray-800 hover:bg-gray-50' }}">Tupoksi</a>
                        <a href="{{ route('admin.kontak-kami') }}" class="block px-3 py-2 rounded-lg text-xs font-medium transition-colors {{ request()->routeIs('admin.kontak-kami') ? 'bg-indigo-50 text-indigo-700 font-bold' : 'text-gray-500 hover:text-gray-800 hover:bg-gray-50' }}">Kontak Kami</a>
                        <a href="{{ route('admin.pejabat.index') }}" class="block px-3 py-2 rounded-lg text-xs font-medium transition-colors {{ request()->routeIs('admin.pejabat.*') ? 'bg-indigo-50 text-indigo-700 font-bold' : 'text-gray-500 hover:text-gray-800 hover:bg-gray-50' }}">Pejabat & Tim</a>
                    </div>
                </div>

                @if(auth()->user()->hasPermission('view_arsip') || auth()->user()->hasPermission('create_arsip') || auth()->user()->hasPermission('edit_arsip') || auth()->user()->hasPermission('delete_arsip'))
                    <p class="px-3 pt-4 pb-2 text-[10px] font-semibold text-gray-400 uppercase tracking-widest">Arsip</p>
                @endif

                @if(auth()->user()->hasPermission('view_arsip'))
                @php $activeArsip = request()->routeIs('arsip.*'); @endphp
                <a href="{{ route('arsip.index') }}"
                   class="relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-[13px] font-medium
                          transition-all {{ $activeArsip ? 'nav-item-active bg-indigo-50 text-indigo-700 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="w-[17px] h-[17px] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="{{ $activeArsip ? '2.2' : '1.8' }}"
                              d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                    </svg>
                    <span class="flex-1">Daftar Arsip</span>
                </a>
                @endif

                @if(auth()->user()->hasPermission('view_berita') || auth()->user()->hasPermission('view_koleksi') || auth()->user()->hasPermission('view_kegiatan') || auth()->user()->hasPermission('view_galeri') || auth()->user()->hasPermission('view_video'))
                    <p class="px-3 pt-4 pb-2 text-[10px] font-semibold text-gray-400 uppercase tracking-widest">Konten</p>
                @endif

                @if(auth()->user()->hasPermission('view_berita'))
                @php $activeBerita = request()->routeIs('berita.*'); @endphp
                <a href="{{ route('berita.index') }}"
                   class="relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-[13px] font-medium
                          transition-all {{ $activeBerita ? 'nav-item-active bg-indigo-50 text-indigo-700 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="w-[17px] h-[17px] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="{{ $activeBerita ? '2.2' : '1.8' }}"
                              d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                    Berita
                </a>
                @endif

                @if(auth()->user()->hasPermission('view_koleksi'))
                @php $activeKoleksi = request()->routeIs('koleksi.*'); @endphp
                <a href="{{ route('koleksi.index') }}"
                   class="relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-[13px] font-medium
                          transition-all {{ $activeKoleksi ? 'nav-item-active bg-indigo-50 text-indigo-700 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="w-[17px] h-[17px] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="{{ $activeKoleksi ? '2.2' : '1.8' }}"
                              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    Koleksi
                </a>
                @endif

                @if(auth()->user()->hasPermission('view_kategori_buku'))
                @php $activeKategoriBuku = request()->routeIs('kategori-buku.*'); @endphp
                <a href="{{ route('kategori-buku.index') }}"
                   class="relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-[13px] font-medium
                          transition-all {{ $activeKategoriBuku ? 'nav-item-active bg-indigo-50 text-indigo-700 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="w-[17px] h-[17px] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="{{ $activeKategoriBuku ? '2.2' : '1.8' }}"
                              d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    Kategori Buku
                </a>
                @endif

                @if(auth()->user()->hasPermission('view_buku'))
                @php $activeBuku = request()->routeIs('buku.*'); @endphp
                <a href="{{ route('buku.index') }}"
                   class="relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-[13px] font-medium
                          transition-all {{ $activeBuku ? 'nav-item-active bg-indigo-50 text-indigo-700 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="w-[17px] h-[17px] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="{{ $activeBuku ? '2.2' : '1.8' }}"
                              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <span class="flex-1">Buku</span>
                </a>
                @endif

                @if(auth()->user()->hasPermission('view_kegiatan'))
                @php $activeKegiatan = request()->routeIs('kegiatan.*'); @endphp
                <a href="{{ route('kegiatan.index') }}"
                   class="relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-[13px] font-medium
                          transition-all {{ $activeKegiatan ? 'nav-item-active bg-indigo-50 text-indigo-700 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="w-[17px] h-[17px] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="{{ $activeKegiatan ? '2.2' : '1.8' }}"
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Kegiatan
                </a>
                @endif

                @if(auth()->user()->hasPermission('view_galeri'))
                @php $activeGaleri = request()->routeIs('galeri.*'); @endphp
                <a href="#"
                   class="relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-[13px] font-medium
                          transition-all {{ $activeGaleri ? 'nav-item-active bg-indigo-50 text-indigo-700 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="w-[17px] h-[17px] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="{{ $activeGaleri ? '2.2' : '1.8' }}"
                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Galeri
                </a>
                @endif

                @if(auth()->user()->hasPermission('view_video'))
                @php $activeVideo = request()->routeIs('video.*'); @endphp
                <a href="#"
                   class="relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-[13px] font-medium
                          transition-all {{ $activeVideo ? 'nav-item-active bg-indigo-50 text-indigo-700 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="w-[17px] h-[17px] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="{{ $activeVideo ? '2.2' : '1.8' }}"
                              d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="{{ $activeVideo ? '2.2' : '1.8' }}"
                              d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Video
                </a>
                @endif

                @php $activeFaq = request()->routeIs('faq.*'); @endphp
                <a href="{{ route('faq.index') }}"
                   class="relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-[13px] font-medium
                          transition-all {{ $activeFaq ? 'nav-item-active bg-indigo-50 text-indigo-700 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="w-[17px] h-[17px] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="{{ $activeFaq ? '2.2' : '1.8' }}"
                              d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    FAQ
                </a>

                @php $activeLinkAccess = request()->routeIs('link-access.*'); @endphp
                <a href="{{ route('link-access.index') }}"
                   class="relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-[13px] font-medium
                          transition-all {{ $activeLinkAccess ? 'nav-item-active bg-indigo-50 text-indigo-700 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="w-[17px] h-[17px] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="{{ $activeLinkAccess ? '2.2' : '1.8' }}"
                              d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                    </svg>
                    Link Access
                </a>

                @if(auth()->user()->hasPermission('view_berita'))
                    <p class="px-3 pt-4 pb-2 text-[10px] font-semibold text-gray-400 uppercase tracking-widest">E-Perpus</p>
                    
                    @php $activeInfografis = request()->routeIs('infografis.*'); @endphp
                    <a href="{{ route('infografis.index') }}"
                       class="relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-[13px] font-medium
                              transition-all {{ $activeInfografis ? 'nav-item-active bg-indigo-50 text-indigo-700 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="w-[17px] h-[17px] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="{{ $activeInfografis ? '2.2' : '1.8' }}"
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Hero Infografis
                    </a>

                    @php $activeTestimoni = request()->routeIs('testimoni.*'); @endphp
                    <a href="{{ route('testimoni.index') }}"
                       class="relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-[13px] font-medium
                              transition-all {{ $activeTestimoni ? 'nav-item-active bg-indigo-50 text-indigo-700 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="w-[17px] h-[17px] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="{{ $activeTestimoni ? '2.2' : '1.8' }}"
                                  d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                        </svg>
                        Testimoni
                    </a>

                    @php $activeAgenda = request()->routeIs('agenda.*'); @endphp
                    <a href="{{ route('agenda.index') }}"
                       class="flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-medium
                              transition-all {{ $activeAgenda ? 'nav-item-active bg-indigo-50 text-indigo-700 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="w-5 h-5 {{ $activeAgenda ? 'text-indigo-600' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="{{ $activeAgenda ? '2.2' : '1.8' }}"
                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Agenda Kegiatan
                    </a>

                    {{-- Profil E-Perpus Sub-menu --}}
                    @php $isPProfilActive = request()->routeIs('admin.profil-perpustakaan.*'); @endphp
                    <div x-data="{ open: {{ $isPProfilActive ? 'true' : 'false' }} }">
                        <button @click="open = !open"
                                class="w-full relative flex items-center justify-between px-3 py-2.5 rounded-xl text-[13px] font-medium transition-all {{ $isPProfilActive ? 'bg-indigo-50/50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <div class="flex items-center gap-3">
                                <svg class="w-[17px] h-[17px] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="{{ $isPProfilActive ? '2.2' : '1.8' }}" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                                <span class="{{ $isPProfilActive ? 'font-semibold' : '' }}">Profil E-Perpus</span>
                            </div>
                            <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="open" style="display: none;"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 -translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             class="pl-9 pr-3 pt-1 pb-2 space-y-1 mt-1">
                            <a href="{{ route('admin.profil-perpustakaan.sejarah') }}" class="block px-3 py-2 rounded-lg text-xs font-medium transition-colors {{ request()->routeIs('admin.profil-perpustakaan.sejarah') ? 'bg-indigo-50 text-indigo-700 font-bold' : 'text-gray-500 hover:text-gray-800 hover:bg-gray-50' }}">Sejarah Perpustakaan</a>
                            <a href="{{ route('admin.profil-perpustakaan.tupoksi') }}" class="block px-3 py-2 rounded-lg text-xs font-medium transition-colors {{ request()->routeIs('admin.profil-perpustakaan.tupoksi') ? 'bg-indigo-50 text-indigo-700 font-bold' : 'text-gray-500 hover:text-gray-800 hover:bg-gray-50' }}">Tugas Pokok & Fungsi</a>
                            <a href="{{ route('admin.profil-perpustakaan.struktur') }}" class="block px-3 py-2 rounded-lg text-xs font-medium transition-colors {{ request()->routeIs('admin.profil-perpustakaan.struktur') ? 'bg-indigo-50 text-indigo-700 font-bold' : 'text-gray-500 hover:text-gray-800 hover:bg-gray-50' }}">Struktur Bidang</a>
                        </div>
                    </div>
                @endif

                @if(auth()->user()->hasPermission('view_settings'))
                    <p class="px-3 pt-4 pb-2 text-[10px] font-semibold text-gray-400 uppercase tracking-widest">Pengaturan</p>
                    
                    @php $activeSettings = request()->routeIs('settings.*'); @endphp
                    <a href="{{ route('settings.index') }}"
                       class="relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-[13px] font-medium
                              transition-all {{ $activeSettings ? 'nav-item-active bg-indigo-50 text-indigo-700 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="w-[17px] h-[17px] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="{{ $activeSettings ? '2.2' : '1.8' }}"
                                  d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="{{ $activeSettings ? '2.2' : '1.8' }}"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Pengaturan Web
                    </a>

                    @php $activeTickets = request()->routeIs('tickets.*'); @endphp
                    <a href="{{ route('tickets.index') }}"
                       class="relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-[13px] font-medium
                              transition-all {{ $activeTickets ? 'nav-item-active bg-indigo-50 text-indigo-700 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="w-[17px] h-[17px] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="{{ $activeTickets ? '2.2' : '1.8' }}"
                                  d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                        </svg>
                        Tiket & Masukan
                    </a>
                @endif

                @if(auth()->user()->hasPermission('view_users') || auth()->user()->hasPermission('view_roles'))
                    <p class="px-3 pt-4 pb-2 text-[10px] font-semibold text-gray-400 uppercase tracking-widest">Pengaturan</p>
                @endif

                @if(auth()->user()->hasPermission('view_users'))
                @php $activeUsers = request()->routeIs('users.*'); @endphp
                <a href="{{ route('users.index') }}"
                   class="relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-[13px] font-medium
                          transition-all {{ $activeUsers ? 'nav-item-active bg-indigo-50 text-indigo-700 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="w-[17px] h-[17px] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="{{ $activeUsers ? '2.2' : '1.8' }}"
                              d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    Kelola User
                </a>
                @endif

                @if(auth()->user()->hasPermission('view_roles'))
                @php $activeRoles = request()->routeIs('roles.*'); @endphp
                <a href="{{ route('roles.index') }}"
                   class="relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-[13px] font-medium
                          transition-all {{ $activeRoles ? 'nav-item-active bg-indigo-50 text-indigo-700 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="w-[17px] h-[17px] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="{{ $activeRoles ? '2.2' : '1.8' }}"
                              d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                    </svg>
                    Role & Permission
                </a>
                @endif

            </nav>

            {{-- User card bawah --}}
            <div class="flex-shrink-0 border-t border-gray-100 p-3">
                <div class="flex items-center gap-3 px-2 py-2 rounded-xl hover:bg-gray-50 transition-colors">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-500 to-blue-600
                                flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-[13px] font-semibold text-gray-800 truncate leading-tight">{{ auth()->user()->name }}</p>
                        <p class="text-[11px] text-gray-400 truncate">{{ auth()->user()->role?->display_name ?? 'Tanpa Role' }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" title="Logout"
                                class="p-1.5 text-gray-300 hover:text-red-500 hover:bg-red-50
                                       rounded-lg transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

        </aside>

        {{-- ================================================
             MAIN CONTENT
             ================================================ --}}
        <div class="flex flex-col flex-1 min-w-0 lg:pl-[260px]">

            {{-- NAVBAR --}}
            <header class="sticky top-0 z-10 h-[60px] bg-white/90 backdrop-blur-md
                           border-b border-gray-100 flex items-center px-5 gap-4">

                {{-- Hamburger mobile --}}
                <button @click="sidebarOpen = !sidebarOpen"
                        class="lg:hidden p-1.5 rounded-lg text-gray-500 hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <div class="flex-1"></div>

                {{-- Global Search --}}
                <div class="relative group" x-data="{ 
                    open: false, 
                    search: '',
                    menus: [
                        @if(auth()->user()->hasPermission('view_dashboard')){ name: 'Dashboard', url: '{{ route('dashboard') }}' },@endif
                        { name: 'Tentang Kami', url: '{{ route('admin.tentang-kami') }}' },
                        { name: 'Visi & Misi', url: '{{ route('admin.visi-misi') }}' },
                        { name: 'Struktur Organisasi', url: '{{ route('admin.struktur-organisasi') }}' },
                        { name: 'Tupoksi', url: '{{ route('admin.tupoksi') }}' },
                        { name: 'Kontak Kami', url: '{{ route('admin.kontak-kami') }}' },
                        { name: 'Pejabat & Tim', url: '{{ route('admin.pejabat.index') }}' },
                        @if(auth()->user()->hasPermission('view_arsip')){ name: 'Daftar Arsip', url: '{{ route('arsip.index') }}' },@endif
                        @if(auth()->user()->hasPermission('view_berita')){ name: 'Berita', url: '{{ route('berita.index') }}' },@endif
                        @if(auth()->user()->hasPermission('view_koleksi')){ name: 'Koleksi', url: '{{ route('koleksi.index') }}' },@endif
                        @if(auth()->user()->hasPermission('view_kegiatan')){ name: 'Kegiatan', url: '{{ route('kegiatan.index') }}' },@endif
                        @if(auth()->user()->hasPermission('view_galeri')){ name: 'Galeri', url: '#' },@endif
                        @if(auth()->user()->hasPermission('view_video')){ name: 'Video', url: '#' },@endif
                        { name: 'FAQ', url: '{{ route('faq.index') }}' },
                        { name: 'Link Access', url: '{{ route('link-access.index') }}' },
                        @if(auth()->user()->hasPermission('view_berita'))
                        { name: 'Hero Infografis', url: '{{ route('infografis.index') }}' },
                        { name: 'Testimoni', url: '{{ route('testimoni.index') }}' },
                        { name: 'Agenda Kegiatan', url: '{{ route('agenda.index') }}' },
                        @endif
                        @if(auth()->user()->hasPermission('view_settings'))
                        { name: 'Pengaturan Web', url: '{{ route('settings.index') }}' },
                        { name: 'Tiket & Masukan', url: '{{ route('tickets.index') }}' },
                        @endif
                        @if(auth()->user()->hasPermission('view_users')){ name: 'Kelola User', url: '{{ route('users.index') }}' },@endif
                        @if(auth()->user()->hasPermission('view_roles')){ name: 'Role & Permission', url: '{{ route('roles.index') }}' },@endif
                    ],
                    get filteredMenus() {
                        if (this.search === '') return [];
                        return this.menus.filter(m => m.name.toLowerCase().includes(this.search.toLowerCase())).slice(0, 6);
                    }
                }">
                    <button @click="open = true; $nextTick(() => $refs.searchInput.focus())"
                            class="relative w-9 h-9 flex items-center justify-center rounded-xl text-gray-500 hover:bg-gray-100 transition-colors">
                        <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <!-- Keyboard shortcut tooltip -->
                        <div class="hidden md:flex absolute -bottom-8 left-1/2 -translate-x-1/2 bg-gray-800 text-white text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none">
                            Ctrl+K
                        </div>
                    </button>

                    <div x-show="open"
                         @click.outside="open = false; search = ''"
                         @keydown.escape.window="open = false; search = ''"
                         @keydown.ctrl.k.prevent.window="open = true; $nextTick(() => $refs.searchInput.focus())"
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         class="absolute right-0 top-full mt-2 w-72 md:w-80 bg-white rounded-2xl border border-gray-100 shadow-xl shadow-gray-200/60 overflow-hidden z-50"
                         style="display: none;">
                        
                        <div class="p-3 border-b border-gray-100 relative">
                            <svg class="w-4 h-4 text-gray-400 absolute left-6 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <input type="text" x-ref="searchInput" x-model="search" placeholder="Cari menu... (Ctrl+K)" 
                                   class="w-full bg-gray-50 border-none rounded-xl pl-9 pr-4 py-2.5 text-[13px] text-gray-800 placeholder-gray-400 focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all">
                        </div>
                        
                        <div class="p-2 max-h-72 overflow-y-auto">
                            <!-- Empty State -->
                            <div x-show="search === ''" class="py-6 text-center">
                                <p class="text-[13px] text-gray-400">Ketik untuk mencari menu</p>
                            </div>
                            <!-- Not Found State -->
                            <div x-show="search !== '' && filteredMenus.length === 0" class="py-6 text-center">
                                <p class="text-[13px] text-gray-400">Menu tidak ditemukan</p>
                            </div>
                            <!-- Results -->
                            <template x-for="(menu, index) in filteredMenus" :key="index">
                                <a :href="menu.url" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-indigo-50 transition-colors group">
                                    <div class="w-8 h-8 rounded-lg bg-gray-50 flex items-center justify-center group-hover:bg-indigo-100 transition-colors">
                                        <svg class="w-4 h-4 text-gray-400 group-hover:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"/>
                                        </svg>
                                    </div>
                                    <span class="text-[13px] font-medium text-gray-700 group-hover:text-indigo-700" x-text="menu.name"></span>
                                </a>
                            </template>
                        </div>
                    </div>
                </div>

                {{-- Divider --}}
                <div class="w-px h-6 bg-gray-200"></div>

                {{-- Avatar + nama --}}
                <div class="flex items-center gap-2.5">
                    <div class="text-right hidden md:block">
                        <p class="text-[13px] font-semibold text-gray-800 leading-none">{{ auth()->user()->name }}</p>
                        <p class="text-[11px] text-gray-400 leading-none mt-0.5">{{ auth()->user()->role?->display_name ?? '-' }}</p>
                    </div>
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-500 to-blue-600
                                flex items-center justify-center text-white text-xs font-bold cursor-pointer
                                shadow-sm shadow-indigo-200">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                </div>

            </header>

            {{-- KONTEN --}}
            <main class="flex-1 p-5 lg:p-6">
                @hasSection('page-header')
                    <div class="mb-5">@yield('page-header')</div>
                @endif

                @include('partials.alert')

                @yield('content')
            </main>

            <footer class="px-6 py-3 text-center text-xs text-gray-300 border-t border-gray-100 bg-white">
                © {{ date('Y') }} DISPUSIP — Dinas Perpustakaan dan Kearsipan
            </footer>

        </div>
    </div>

    @stack('scripts')
</body>
</html>


@extends('layouts.public')

@section('title', 'Profil Instansi | DISPUSIP Padang')

@section('content')

@php
    // Assign mapped variables from $profiles collection
    $tentangKami = $profiles->get('tentang-kami');
    $visiMisi    = $profiles->get('visi-dan-misi');
    $struktur    = $profiles->get('struktur-organisasi');
    $tupoksi     = $profiles->get('tupoksi');
    // kontak-kami content isn't explicitly shown, we use settings for Contact instead as per design,
    // but you can inject $profiles->get('kontak-kami')->content if needed.
@endphp

{{-- 1. HERO SECTION (With Background Image) --}}
<main class="relative z-10 pt-40 pb-32 px-6 flex items-center overflow-hidden min-h-[70vh] bg-navy-900 bg-[url('https://images.unsplash.com/photo-1541963463532-d68292c34b19?auto=format&fit=crop&q=80&w=2000')] bg-cover bg-center bg-no-repeat bg-fixed">
    <!-- Dark Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-b from-navy-900/95 via-navy-900/80 to-navy-900 z-0"></div>
    
    <!-- Abstract Glows -->
    <div class="absolute inset-0 bg-grid opacity-20 z-0"></div>
    <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-gold-500/20 rounded-full mix-blend-screen filter blur-[120px] opacity-60 animate-pulse-slow translate-x-1/3 -translate-y-1/4 z-0"></div>
    <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-sky-500/20 rounded-full mix-blend-screen filter blur-[100px] opacity-60 translate-y-1/3 -translate-x-1/4 z-0"></div>

    <div class="max-w-7xl mx-auto w-full relative z-10 text-center flex flex-col items-center">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-white/20 bg-white/10 backdrop-blur-md mb-8 shadow-sm">
            <span class="w-2 h-2 rounded-full bg-gold-500 animate-ping"></span>
            <span class="text-xs font-black tracking-widest text-gold-400 uppercase">Wajah Instansi</span>
        </div>
        
        <h1 class="text-5xl md:text-7xl lg:text-[6rem] font-black text-white tracking-tighter uppercase leading-[0.9] mb-8">
            Dinas<br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-gold-400 to-gold-600 drop-shadow-sm">Perpustakaan</span><br>
            <div class="flex items-center justify-center gap-4 mt-2">
                <span class="text-sky-400 italic font-serif lowercase text-5xl md:text-7xl">dan</span>
                <span class="relative">
                    Kearsipan
                    <svg class="absolute w-[110%] h-4 -bottom-2 -left-2 text-gold-500/80 -z-10" viewBox="0 0 100 20" preserveAspectRatio="none">
                        <path d="M0,10 Q50,20 100,10" stroke="currentColor" stroke-width="8" fill="none" />
                    </svg>
                </span>
            </div>
        </h1>
        
        <p class="text-navy-100 text-lg md:text-xl font-medium max-w-3xl mx-auto leading-relaxed mt-4 text-shadow">
            Menjadi pusat literasi modern dan pelestari memori kolektif yang inklusif, inovatif, dan berdaya guna bagi seluruh masyarakat Kota Padang.
        </p>

        <!-- Scroll Indicator -->
        <a href="#tentang" class="mt-16 animate-bounce flex items-center justify-center w-14 h-14 rounded-full border-2 border-white/20 text-white/50 hover:text-gold-400 hover:border-gold-400 hover:bg-white/5 transition-all">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </a>
    </div>
</main>

{{-- 2. TENTANG KAMI & KADIS (DYNAMIC) --}}
<section id="tentang" class="py-24 lg:py-32 px-6 bg-white relative">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 lg:gap-24 items-center">
            
            <!-- Left: Text Content (Dynamic from Database) -->
            <div class="lg:col-span-7">
                <span class="text-navy-500 font-bold tracking-[0.2em] uppercase text-xs mb-4 flex items-center gap-2">
                    <span class="w-8 h-px bg-gold-500"></span> {{ $tentangKami->title ?? 'Tentang Kami' }}
                </span>
                <h2 class="text-4xl md:text-5xl lg:text-6xl font-black tracking-tight text-navy-900 leading-[1.1] mb-8">
                    Lebih Dekat Dengan <br>
                    <span class="text-gold-500">DISPUSIP Padang</span>
                </h2>
                
                <!-- DYNAMIC CONTENT AREA -->
                <div class="prose prose-lg max-w-none text-navy-600 font-medium leading-relaxed
                            prose-headings:text-navy-900 prose-headings:font-bold
                            prose-p:mb-6 prose-a:text-gold-600 hover:prose-a:text-gold-700
                            prose-strong:font-bold prose-strong:text-navy-900">
                    {!! $tentangKami->content ?? '<p class="text-navy-300 italic">Konten tentang kami belum tersedia. Silakan update di panel admin.</p>' !!}
                </div>
                
                <div class="mt-10 flex gap-4">
                    <div class="px-6 py-4 bg-navy-50 rounded-2xl border border-navy-100">
                        <h4 class="text-3xl font-black text-navy-900 mb-1">50K+</h4>
                        <p class="text-xs font-bold text-navy-500 uppercase tracking-widest">Koleksi Digital</p>
                    </div>
                    <div class="px-6 py-4 bg-gold-50 rounded-2xl border border-gold-100">
                        <h4 class="text-3xl font-black text-gold-600 mb-1">100+</h4>
                        <p class="text-xs font-bold text-gold-600/70 uppercase tracking-widest">Arsip Statis</p>
                    </div>
                </div>
            </div>

            <!-- Right: Photo Kadis (Dynamic) -->
            <div class="lg:col-span-5 relative">
                <!-- Decorative Elements -->
                <div class="absolute -right-8 -bottom-8 w-64 h-64 bg-gold-400 rounded-full mix-blend-multiply filter blur-[60px] opacity-50 z-0"></div>
                <div class="absolute -left-8 -top-8 w-64 h-64 bg-navy-400 rounded-full mix-blend-multiply filter blur-[60px] opacity-30 z-0"></div>
                
                @if($kepalaDinas)
                <div class="relative z-10 bg-white p-4 rounded-[2.5rem] shadow-[0_20px_50px_rgba(15,36,64,0.1)] border border-navy-50 group transform hover:-translate-y-2 transition-transform duration-500">
                    <div class="aspect-[3/4] rounded-[2rem] overflow-hidden relative bg-navy-900">
                        @if($kepalaDinas->image)
                            <img src="{{ asset('storage/' . $kepalaDinas->image) }}" alt="{{ $kepalaDinas->nama }}" class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-700 ease-in-out">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-navy-800">
                                <svg class="w-24 h-24 text-navy-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </div>
                        @endif
                        
                        <!-- Overlay Gradient: Subtle by default, darker on hover -->
                        <div class="absolute inset-0 bg-gradient-to-t from-navy-900/70 via-transparent to-transparent group-hover:via-navy-900/40 transition-all duration-500"></div>
                        
                        <div class="absolute bottom-0 left-0 right-0 p-8 text-white">
                            <span class="px-4 py-1.5 rounded-full bg-gold-500 text-navy-900 text-[10px] font-black uppercase tracking-widest mb-4 inline-block">Kepala Dinas</span>
                            <h3 class="text-3xl font-black leading-tight mb-1">{{ $kepalaDinas->nama }}</h3>
                            <p class="text-navy-200 font-medium">{{ $kepalaDinas->jabatan }}</p>
                            @if($kepalaDinas->nip)
                                <p class="text-navy-400 text-xs mt-1 font-mono">NIP: {{ $kepalaDinas->nip }}</p>
                            @endif
                            
                            <!-- Quote / Keterangan -->
                            <div class="mt-6 pt-6 border-t border-white/20 relative">
                                <svg class="w-8 h-8 text-gold-500/50 absolute -top-4 bg-navy-900 px-1 left-0" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                                </svg>
                                <p class="text-sm text-white/80 italic font-serif pl-8">
                                    {{ $kepalaDinas->keterangan ?? '"Perpustakaan adalah gerbang masa depan, dan arsip adalah kunci untuk memahami masa lalu."' }}
                                </p>
                            </div>

                            <!-- Social Links -->
                            @if($kepalaDinas->facebook || $kepalaDinas->instagram || $kepalaDinas->twitter)
                            <div class="mt-6 flex gap-3">
                                @if($kepalaDinas->facebook)
                                    <a href="{{ $kepalaDinas->facebook }}" target="_blank" class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center hover:bg-white hover:text-navy-900 transition-all">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                    </a>
                                @endif
                                @if($kepalaDinas->instagram)
                                    <a href="{{ $kepalaDinas->instagram }}" target="_blank" class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center hover:bg-white hover:text-navy-900 transition-all">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                                    </a>
                                @endif
                                @if($kepalaDinas->twitter)
                                    <a href="{{ $kepalaDinas->twitter }}" target="_blank" class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center hover:bg-white hover:text-navy-900 transition-all">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                    </a>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @else
                <div class="aspect-[3/4] bg-navy-50 rounded-[2.5rem] flex items-center justify-center border border-navy-100 italic text-navy-400">
                    Data Kepala Dinas belum diatur.
                </div>
                @endif
            </div>


        </div>
    </div>
</section>

{{-- 3. VISI & MISI (DYNAMIC PARSED) --}}
{{-- 3. VISI & MISI (DYNAMIC PARSED) --}}
@php
    // Extract list items for Misi from content
    $misiContent = $visiMisi->content ?? '';
    preg_match_all('/<li>(.*?)<\/li>/is', $misiContent, $misiMatches);
    $misiItems = $misiMatches[1] ?? [];

    // Get Visi text, fallback to extracting before list if meta is empty
    $visiText = $visiMisi->meta['visi'] ?? '';
    if (empty(trim(strip_tags($visiText)))) {
        $visiText = preg_replace('/<(ul|ol)>.*$/is', '', $misiContent);
        if (empty($misiItems)) {
            $visiText = $misiContent;
        }
    }
@endphp

<section class="bg-[#F8FAFC] py-24 lg:py-32 relative border-y border-navy-50">
    <!-- Huge Background Text -->
    <div class="absolute top-0 left-0 w-full overflow-hidden flex whitespace-nowrap opacity-[0.02] pointer-events-none select-none z-0">
        <h2 class="text-[15rem] font-black text-navy-900 uppercase tracking-tighter">DISPUSIP KOTA PADANG</h2>
    </div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        
        <div class="grid lg:grid-cols-12 gap-16 lg:gap-24 items-start">
            
            <!-- Left Column: VISI (Sticky) -->
            <div class="lg:col-span-5 lg:sticky lg:top-32 relative">
                <div class="absolute -left-6 -top-6 w-24 h-24 bg-gold-500/10 rounded-full blur-2xl"></div>
                
                <span class="text-gold-600 font-bold tracking-[0.2em] uppercase text-sm mb-4 block">
                    Visi Instansi
                </span>
                <h2 class="text-4xl md:text-5xl font-black text-navy-900 leading-tight mb-8">
                    Menuju Kota<br>Maju & Sejahtera
                </h2>
                
                <!-- Visi Statement Box -->
                <div class="bg-white p-8 rounded-3xl shadow-[0_20px_40px_rgba(15,36,64,0.06)] border border-navy-50 relative">
                    <div class="absolute -left-px top-10 bottom-10 w-1 bg-gradient-to-b from-gold-400 to-gold-600 rounded-r-full"></div>
                    <div class="prose prose-lg max-w-none prose-p:text-navy-800 prose-p:leading-relaxed text-navy-800 font-medium text-lg leading-relaxed">
                        {!! $visiText !!}
                    </div>
                </div>

                <!-- Decorative Element -->
                <div class="mt-12 hidden lg:block opacity-50">
                    <svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="50" cy="50" r="49.5" stroke="#0F2440" stroke-opacity="0.1" stroke-dasharray="4 4"/>
                        <circle cx="50" cy="50" r="30" fill="#EAB308" fill-opacity="0.1"/>
                        <path d="M50 30L55.8779 44.1221L70 50L55.8779 55.8779L50 70L44.1221 55.8779L30 50L44.1221 44.1221L50 30Z" fill="#EAB308"/>
                    </svg>
                </div>
            </div>

            <!-- Right Column: MISI (List) -->
            <div class="lg:col-span-7">
                <div class="flex items-center gap-6 mb-12">
                    <h3 class="text-3xl font-black text-navy-900 uppercase tracking-tight">Misi Instansi</h3>
                    <div class="flex-1 h-px bg-gradient-to-r from-navy-100 to-transparent"></div>
                </div>
                
                @if(count($misiItems) > 0)
                    <div class="space-y-0 relative before:absolute before:inset-y-0 before:left-[35px] before:w-px before:bg-gradient-to-b before:from-navy-100 before:via-navy-100 before:to-transparent">
                        @foreach($misiItems as $index => $item)
                            <div class="group relative flex gap-8 items-start py-8 first:pt-0 last:pb-0">
                                <!-- Minimalist Number -->
                                <div class="relative z-10 w-[70px] h-[70px] rounded-full bg-[#F8FAFC] border-8 border-[#F8FAFC] flex items-center justify-center shrink-0">
                                    <div class="absolute inset-0 rounded-full border border-navy-100 group-hover:border-gold-500 group-hover:bg-gold-50 transition-colors duration-500"></div>
                                    <span class="relative text-2xl font-black text-navy-900/30 group-hover:text-gold-600 transition-colors duration-500">
                                        {{ sprintf('%02d', $index + 1) }}
                                    </span>
                                </div>
                                
                                <!-- Content -->
                                <div class="flex-1 pt-3">
                                    <div class="text-lg text-navy-700 leading-relaxed group-hover:text-navy-900 transition-colors duration-300">
                                        {!! strip_tags($item, '<strong><em><b><i><br>') !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</section>

{{-- 4. TUPOKSI (PREMIUM EDITORIAL LAYOUT) --}}
@php
    $tugasContent = $tupoksi->content ?? '';
    preg_match_all('/<li[^>]*>(.*?)<\/li>/is', $tugasContent, $tugasMatches);
    $tugasItems = $tugasMatches[1] ?? [];
    
    $fungsiContent = $tupoksi->meta['fungsi'] ?? '';
    preg_match_all('/<li[^>]*>(.*?)<\/li>/is', $fungsiContent, $fungsiMatches);
    $fungsiItems = $fungsiMatches[1] ?? [];
    
    $gdriveLink = $tupoksi->meta['link_gdrive'] ?? '';
@endphp

<section class="py-24 lg:py-32 bg-navy-900 relative overflow-hidden">
    <!-- Abstract Tech Background -->
    <div class="absolute inset-0 opacity-20">
        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                    <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="0.5" stroke-opacity="0.2"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#grid)" />
        </svg>
    </div>
    <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-sky-500/10 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-gold-500/5 rounded-full blur-[100px] pointer-events-none"></div>
    
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        
        <div class="text-center mb-20">
            <span class="inline-flex items-center gap-3 px-4 py-2 rounded-full bg-white/5 border border-white/10 text-gold-400 font-bold tracking-[0.2em] uppercase text-xs mb-6">
                <span class="w-2 h-2 rounded-full bg-gold-500 animate-pulse"></span> Kewenangan Instansi
            </span>
            <h2 class="text-5xl md:text-7xl font-black text-white uppercase tracking-tight">{{ $tupoksi->title ?? 'Tugas Pokok & Fungsi' }}</h2>
        </div>

        <div class="grid lg:grid-cols-2 gap-16 lg:gap-24">
            
            <!-- Left: Tugas Pokok (Floating Glass Card) -->
            <div class="relative">
                <div class="lg:sticky lg:top-32">
                    <h3 class="text-3xl font-bold text-white mb-8 flex items-center gap-4">
                        <span class="w-12 h-12 rounded-2xl bg-sky-500/20 text-sky-400 flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </span>
                        Tugas Pokok
                    </h3>
                    
                    <div class="relative group">
                        <!-- Glow effect behind card -->
                        <div class="absolute -inset-1 bg-gradient-to-r from-sky-500/30 to-gold-500/30 rounded-[2.5rem] blur-xl opacity-50 group-hover:opacity-70 transition duration-1000"></div>
                        
                        <!-- Actual Card -->
                        <div class="relative bg-navy-800/80 backdrop-blur-xl border border-white/10 p-8 md:p-12 rounded-[2rem]">
                            @if(count($tugasItems) > 0)
                                <div class="space-y-6">
                                    @foreach($tugasItems as $item)
                                        <div class="flex gap-5 items-start">
                                            <div class="w-6 h-6 rounded-full bg-white/10 text-white flex items-center justify-center shrink-0 mt-1">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            </div>
                                            <div class="text-white/90 text-lg font-medium leading-relaxed">
                                                {!! strip_tags($item, '<strong><em><b><i><br>') !!}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="prose prose-lg prose-invert prose-p:text-white/90 prose-li:text-white/90 prose-strong:text-white max-w-none font-medium">
                                    {!! $tugasContent !!}
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- GDrive Card -->
                    @if(!empty($gdriveLink))
                        <a href="{{ $gdriveLink }}" target="_blank" class="mt-8 flex items-center justify-between gap-6 bg-white/5 border border-white/10 hover:bg-white/10 hover:border-gold-500/50 rounded-[2rem] p-4 pr-8 transition-all duration-300 group">
                            <div class="flex items-center gap-5">
                                <div class="w-16 h-16 bg-gradient-to-br from-gold-400 to-gold-600 rounded-2xl flex items-center justify-center text-navy-900 shrink-0 shadow-[0_0_20px_rgba(234,179,8,0.3)] group-hover:scale-105 transition-transform">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                </div>
                                <div>
                                    <h4 class="text-white font-bold text-lg">SK Walikota Tupoksi</h4>
                                    <p class="text-white/50 text-sm">Unduh Dokumen PDF</p>
                                </div>
                            </div>
                            <div class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center text-white/50 group-hover:bg-gold-500 group-hover:text-navy-900 group-hover:border-gold-500 transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </div>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Right: Penyelenggaraan Fungsi (Clean List) -->
            <div>
                <h3 class="text-3xl font-bold text-white mb-8 flex items-center gap-4">
                    <span class="w-12 h-12 rounded-2xl bg-gold-500/20 text-gold-400 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </span>
                    Penyelenggaraan Fungsi
                </h3>
                
                @if(count($fungsiItems) > 0)
                    <div class="space-y-4">
                        @foreach($fungsiItems as $index => $item)
                            <div class="group bg-white/[0.02] border border-white/5 hover:border-white/20 hover:bg-white/[0.04] rounded-2xl p-6 transition-all duration-300 flex items-start gap-6">
                                <div class="text-4xl font-black text-white/10 group-hover:text-gold-400 transition-colors duration-500 mt-1">
                                    {{ sprintf('%02d', $index + 1) }}
                                </div>
                                <div class="text-white/80 leading-relaxed text-base group-hover:text-white transition-colors duration-300">
                                    {!! strip_tags($item, '<strong><em><b><i><br>') !!}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white/5 border border-white/10 rounded-2xl p-8 prose prose-lg prose-invert prose-p:text-white/80 prose-li:text-white/80 prose-strong:text-white max-w-none">
                        {!! $fungsiContent !!}
                    </div>
                @endif
            </div>
            
        </div>
    </div>
</section>

{{-- 5. STRUKTUR ORGANISASI (DYNAMIC) --}}
<section class="py-24 px-6 bg-white border-b border-navy-50">
    <div class="max-w-7xl mx-auto text-center">
        <span class="text-navy-500 font-bold tracking-[0.2em] uppercase text-xs mb-4 flex items-center justify-center gap-2">
            <span class="w-8 h-px bg-gold-500"></span> {{ $struktur->title ?? 'Struktur Instansi' }} <span class="w-8 h-px bg-gold-500"></span>
        </span>
        <h2 class="text-4xl md:text-5xl font-black text-navy-900 uppercase tracking-tight mb-12">Bagan Organisasi</h2>
        
        <div class="bg-[#F8FAFC] rounded-[3rem] p-4 md:p-8 border border-navy-50 shadow-sm relative group overflow-hidden">
            <!-- Decorative Glow -->
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-gold-500/10 rounded-full blur-[100px] z-0"></div>
            
            <div class="relative z-10 w-full min-h-[400px] bg-white rounded-[2rem] border border-navy-100 flex flex-col items-center justify-center shadow-inner overflow-hidden p-8">
                @if(isset($struktur) && $struktur->image)
                    <img src="{{ asset('storage/' . $struktur->image) }}" alt="Struktur Organisasi" class="w-full rounded-2xl shadow-sm">
                @elseif(isset($struktur) && !empty(trim(strip_tags($struktur->content, '<img>'))))
                    <div class="prose max-w-none w-full prose-img:w-full prose-img:rounded-2xl prose-img:shadow-sm">
                        {!! $struktur->content !!}
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center text-center">
                        <svg class="w-24 h-24 text-navy-200 mb-6 group-hover:scale-110 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        <h3 class="text-2xl font-black text-navy-300">Struktur Belum Diunggah</h3>
                        <p class="text-navy-300 font-medium mt-2">Bagan organisasi dapat diunggah berbentuk gambar melalui panel admin.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- 6. MEET OUR TEAM (DYNAMIC) --}}
@if($pejabats->count() > 0)
<section class="py-24 px-6 bg-[#F8FAFC] overflow-hidden">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-8">
            <div>
                <span class="text-gold-500 font-bold tracking-[0.2em] uppercase text-xs mb-4 flex items-center gap-2">
                    <span class="w-8 h-px bg-gold-500"></span> Susunan Pejabat
                </span>
                <h2 class="text-4xl md:text-5xl font-black text-navy-900 uppercase tracking-tight">Meet Our <br>Leadership Team</h2>
            </div>
            <p class="text-navy-500 font-medium max-w-sm text-base border-l-2 border-gold-500 pl-4 py-1">
                Pimpinan dan pejabat yang berdedikasi mengelola layanan perpustakaan dan kearsipan.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($pejabats as $index => $pejabat)
                @php $isFirst = $index === 0; @endphp
                <div class="group">
                    <div class="bg-white rounded-[2rem] p-4 border border-navy-50 shadow-[0_10px_30px_rgba(15,36,64,0.03)] hover:shadow-[0_20px_40px_rgba(15,36,64,0.10)] transition-all duration-500 hover:-translate-y-2 relative overflow-hidden h-full flex flex-col">
                        @if($isFirst)
                            <div class="absolute top-6 right-6 z-10">
                                <span class="px-3 py-1 rounded-full bg-gold-500 text-navy-900 text-[10px] font-black uppercase tracking-widest shadow-lg">Kepala Dinas</span>
                            </div>
                        @endif
                        <div class="aspect-[4/5] rounded-[1.5rem] overflow-hidden mb-5 bg-gradient-to-br from-navy-50 to-navy-100 relative flex-shrink-0">
                            @if($pejabat->image)
                                <img src="{{ asset('storage/' . $pejabat->image) }}" alt="{{ $pejabat->nama }}" class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-700 ease-out">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <div class="w-24 h-24 rounded-full bg-navy-200 flex items-center justify-center text-navy-400">
                                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    </div>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-navy-900/70 via-navy-900/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-5">
                                @if($pejabat->facebook || $pejabat->instagram || $pejabat->twitter)
                                    <div class="flex gap-2">
                                        @if($pejabat->facebook)<a href="{{ $pejabat->facebook }}" target="_blank" class="w-8 h-8 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center text-white hover:bg-white hover:text-navy-900 transition-all"><svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></a>@endif
                                        @if($pejabat->instagram)<a href="{{ $pejabat->instagram }}" target="_blank" class="w-8 h-8 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center text-white hover:bg-white hover:text-navy-900 transition-all"><svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg></a>@endif
                                        @if($pejabat->twitter)<a href="{{ $pejabat->twitter }}" target="_blank" class="w-8 h-8 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center text-white hover:bg-white hover:text-navy-900 transition-all"><svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg></a>@endif
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="px-2 pb-2 flex-1 flex flex-col">
                            <h4 class="text-base font-black text-navy-900 mb-1 leading-tight">{{ $pejabat->nama }}</h4>
                            <p class="text-[11px] font-bold text-gold-600 uppercase tracking-widest">{{ $pejabat->jabatan }}</p>
                            @if($pejabat->nip)<p class="text-xs text-navy-400 font-mono mt-auto pt-3">NIP: {{ $pejabat->nip }}</p>@endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif


{{-- 7. KONTAK & LOKASI --}}
<section id="kontak-kami" class="py-24 px-6 bg-white border-t border-navy-50">
    <div class="max-w-7xl mx-auto">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-4xl md:text-5xl font-black tracking-tight text-navy-900 leading-[1.1] mb-4 uppercase">
                Lokasi & <span class="text-transparent bg-clip-text bg-gradient-to-r from-gold-400 to-gold-600">Kontak</span>
            </h2>
            <p class="text-navy-600 font-medium text-lg">
                Kunjungi kami di alamat berikut atau hubungi melalui kanal resmi yang tersedia.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
            <!-- Maps -->
            <div class="w-full">
                @php 
                    $maps = \App\Models\Setting::where('key', 'maps_embed_link')->first(); 
                @endphp
                @if($maps && $maps->value)
                    <div class="rounded-[2.5rem] overflow-hidden border border-navy-100 shadow-[0_20px_50px_rgba(15,36,64,0.05)] h-[400px] lg:h-[500px] bg-white relative">
                        <iframe src="{{ $maps->value }}" width="100%" height="100%" style="border:0;"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                            class="absolute inset-0"></iframe>
                    </div>
                @else
                    <div class="rounded-[2.5rem] overflow-hidden border border-navy-100 shadow-sm h-[400px] bg-navy-50 flex items-center justify-center">
                        <p class="text-navy-300 font-bold">Peta Lokasi Belum Diatur</p>
                    </div>
                @endif
            </div>

            <!-- Contact Info Blocks -->
            <div class="space-y-6">
                @php 
                    $email = \App\Models\Setting::where('key', 'contact_email')->first();
                    $phone = \App\Models\Setting::where('key', 'contact_phone')->first();
                    $address = \App\Models\Setting::where('key', 'contact_address')->first();
                @endphp

                <!-- Address Box -->
                <div class="bg-[#F8FAFC] p-8 rounded-[2rem] border border-navy-50 shadow-sm flex gap-6 hover:shadow-md transition-shadow">
                    <div class="w-16 h-16 rounded-2xl bg-navy-100 text-navy-600 flex items-center justify-center flex-shrink-0">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-black text-navy-900 uppercase tracking-widest mb-2">Alamat Utama</h4>
                        <p class="text-navy-600 font-medium leading-relaxed text-lg">{{ $address ? $address->value : 'Alamat belum diatur' }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Email -->
                    <div class="bg-[#F8FAFC] p-8 rounded-[2rem] border border-navy-50 shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-16 h-16 rounded-2xl bg-sky-100 text-sky-500 flex items-center justify-center mb-6">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h4 class="text-sm font-black text-navy-900 uppercase tracking-widest mb-2">Email</h4>
                        <p class="text-navy-600 font-medium text-lg">{{ $email ? $email->value : 'email@dispusip.go.id' }}</p>
                    </div>

                    <!-- Telepon -->
                    <div class="bg-[#F8FAFC] p-8 rounded-[2rem] border border-navy-50 shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-16 h-16 rounded-2xl bg-gold-100 text-gold-600 flex items-center justify-center mb-6">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <h4 class="text-sm font-black text-navy-900 uppercase tracking-widest mb-2">Telepon</h4>
                        <p class="text-navy-600 font-medium text-lg">{{ $phone ? $phone->value : '(0751) 123456' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    // Alpine.js logic for Team Slider
    document.addEventListener('alpine:init', () => {
        Alpine.data('teamSlider', () => ({
            currentIndex: 0,
            visibleCards: 4,
            
            // Dummy Data for static presentation
            team: [
                { id: 1, name: 'Budi Santoso', position: 'Sekretaris Dinas', image: 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&q=80&w=500' },
                { id: 2, name: 'Siti Aminah', position: 'Kabid Perpustakaan', image: 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&q=80&w=500' },
                { id: 3, name: 'Ahmad Ridwan', position: 'Kabid Kearsipan', image: 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&q=80&w=500' },
                { id: 4, name: 'Dian Permata', position: 'Kasubag Umum', image: 'https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&q=80&w=500' },
                { id: 5, name: 'Rizki Firmansyah', position: 'Pustakawan Ahli', image: 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&q=80&w=500' },
                { id: 6, name: 'Maya Sari', position: 'Arsiparis Utama', image: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&q=80&w=500' },
            ],

            init() {
                // Responsive visible cards logic
                this.updateVisibleCards();
                window.addEventListener('resize', () => this.updateVisibleCards());
            },

            updateVisibleCards() {
                if (window.innerWidth < 640) this.visibleCards = 1;
                else if (window.innerWidth < 768) this.visibleCards = 2;
                else if (window.innerWidth < 1024) this.visibleCards = 3;
                else this.visibleCards = 4;
            },

            next() {
                if (this.currentIndex < this.team.length - this.visibleCards) {
                    this.currentIndex++;
                } else {
                    this.currentIndex = 0; // Loop back
                }
            },

            prev() {
                if (this.currentIndex > 0) {
                    this.currentIndex--;
                } else {
                    this.currentIndex = this.team.length - this.visibleCards; // Loop to end
                }
            }
        }))
    })
</script>
@endpush
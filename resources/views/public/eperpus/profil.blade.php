@extends('layouts.eperpus')

@section('title', 'Profil Perpustakaan | E-Perpus DISPUSIP')

@section('hero_title')
    <h1 class="text-4xl md:text-6xl lg:text-7xl font-black text-white tracking-tight uppercase leading-[1.1]">
        Profil <br>
        <span class="text-transparent bg-clip-text bg-gradient-to-r from-gold-400 to-gold-600">Perpustakaan</span>
    </h1>
@endsection

@section('content')
    <div class="min-h-screen bg-slate-50 relative pb-20">

        {{-- 2. SEJARAH & PIMPINAN PERPUSTAKAAN --}}
        @if((isset($profiles['sejarah']) && $profiles['sejarah']->is_active) || $kabidPerpustakaan)
            <section id="sejarah" class="py-24 lg:py-32 px-6 bg-white relative">
                <div class="max-w-7xl mx-auto">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 lg:gap-24 items-start">

                        <!-- Left: Sejarah Content -->
                        <div class="lg:col-span-7">
                            @if(isset($profiles['sejarah']) && $profiles['sejarah']->is_active)
                                @php $sejarah = $profiles['sejarah']; @endphp
                                <span class="text-navy-500 font-bold tracking-[0.2em] uppercase text-xs mb-4 flex items-center gap-2">
                                    <span class="w-8 h-px bg-gold-500"></span> Latar Belakang
                                </span>
                                <h2 class="text-4xl md:text-5xl lg:text-6xl font-black tracking-tight text-navy-900 leading-[1.1] mb-8">
                                    {{ $sejarah->title }} <br>
                                    <span class="text-gold-500">Perpustakaan</span>
                                </h2>

                                @if($sejarah->image)
                                    <img src="{{ asset('storage/' . $sejarah->image) }}" alt="Sejarah Perpustakaan" class="w-full max-h-80 object-cover rounded-[2rem] mb-8 shadow-md">
                                @endif

                                <div class="prose prose-lg max-w-none text-navy-600 font-medium leading-relaxed
                                            prose-headings:text-navy-900 prose-headings:font-bold
                                            prose-p:mb-6 prose-a:text-gold-600 hover:prose-a:text-gold-700
                                            prose-strong:font-bold prose-strong:text-navy-900">
                                    {!! $sejarah->content !!}
                                </div>
                            @endif
                        </div>

                        <!-- Right: Photo Pimpinan (Kabid) -->
                        <div class="lg:col-span-5 relative lg:sticky lg:top-32">
                            <!-- Decorative Elements -->
                            <div class="absolute -right-8 -bottom-8 w-64 h-64 bg-gold-400 rounded-full mix-blend-multiply filter blur-[60px] opacity-50 z-0"></div>
                            <div class="absolute -left-8 -top-8 w-64 h-64 bg-navy-400 rounded-full mix-blend-multiply filter blur-[60px] opacity-30 z-0"></div>

                            @if($kabidPerpustakaan)
                                <div class="relative z-10 bg-white p-4 rounded-[2.5rem] shadow-[0_20px_50px_rgba(15,36,64,0.1)] border border-navy-50 group transform hover:-translate-y-2 transition-transform duration-500">
                                    <div class="aspect-[4/5] md:aspect-[3/4] rounded-[2rem] overflow-hidden relative bg-navy-900">
                                        @if($kabidPerpustakaan->image)
                                            <img src="{{ asset('storage/' . $kabidPerpustakaan->image) }}" alt="{{ $kabidPerpustakaan->nama }}" class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-700 ease-in-out">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center bg-navy-800">
                                                <svg class="w-24 h-24 text-navy-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                            </div>
                                        @endif

                                        <!-- Overlay Gradient -->
                                        <div class="absolute inset-0 bg-gradient-to-t from-navy-900/90 via-navy-900/40 md:via-transparent to-transparent group-hover:via-navy-900/50 transition-all duration-500"></div>

                                        <div class="absolute bottom-0 left-0 right-0 p-5 md:p-8 text-white">
                                            <span class="px-4 py-1.5 rounded-full bg-gold-500 text-navy-900 text-[10px] font-black uppercase tracking-widest mb-4 inline-block">Pimpinan Bidang</span>
                                            <h3 class="text-3xl font-black leading-tight mb-1">{{ $kabidPerpustakaan->nama }}</h3>
                                            <p class="text-navy-200 font-medium">{{ $kabidPerpustakaan->jabatan }}</p>
                                            @if($kabidPerpustakaan->nip)
                                                <p class="text-navy-400 text-xs mt-1 font-mono">NIP: {{ $kabidPerpustakaan->nip }}</p>
                                            @endif

                                            <!-- Keterangan -->
                                            @if($kabidPerpustakaan->keterangan)
                                                <div class="mt-6 pt-6 border-t border-white/20 relative">
                                                    <svg class="w-8 h-8 text-gold-500/50 absolute -top-4 bg-navy-900 px-1 left-0" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                                                    </svg>
                                                    <p class="text-sm text-white/80 italic font-serif pl-8">
                                                        "{{ $kabidPerpustakaan->keterangan }}"
                                                    </p>
                                                </div>
                                            @endif

                                            <!-- Social Links -->
                                            @if($kabidPerpustakaan->facebook || $kabidPerpustakaan->instagram || $kabidPerpustakaan->twitter)
                                                <div class="mt-6 flex gap-3">
                                                    @if($kabidPerpustakaan->facebook)
                                                        <a href="{{ $kabidPerpustakaan->facebook }}" target="_blank" class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center hover:bg-white hover:text-navy-900 transition-all">
                                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                                        </a>
                                                    @endif
                                                    @if($kabidPerpustakaan->instagram)
                                                        <a href="{{ $kabidPerpustakaan->instagram }}" target="_blank" class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center hover:bg-white hover:text-navy-900 transition-all">
                                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                                                        </a>
                                                    @endif
                                                    @if($kabidPerpustakaan->twitter)
                                                        <a href="{{ $kabidPerpustakaan->twitter }}" target="_blank" class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center hover:bg-white hover:text-navy-900 transition-all">
                                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                                        </a>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </section>
        @endif

        {{-- 3. TUPOKSI (PREMIUM EDITORIAL LAYOUT) --}}
        @if(isset($profiles['tupoksi']) && $profiles['tupoksi']->is_active)
            @php 
                    $tupoksi = $profiles['tupoksi'];

                // Parse list items for Tugas
                $tugasContent = $tupoksi->content ?? '';
                preg_match_all('/<li[^>]*>(.*?)<\/li>/is', $tugasContent, $tugasMatches);
                $tugasItems = $tugasMatches[1] ?? [];

                // Parse list items for Fungsi
                $fungsiContent = $tupoksi->meta['fungsi'] ?? '';
                preg_match_all('/<li[^>]*>(.*?)<\/li>/is', $fungsiContent, $fungsiMatches);
                $fungsiItems = $fungsiMatches[1] ?? [];
            @endphp
            <section id="tupoksi" class="py-24 lg:py-32 bg-navy-900 relative overflow-hidden border-y border-navy-50">
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
                            <span class="w-2 h-2 rounded-full bg-gold-500 animate-pulse"></span> Kewenangan Bidang
                        </span>
                        <h2 class="text-5xl md:text-7xl font-black text-white uppercase tracking-tight">{{ $tupoksi->title }}</h2>
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
                            </div>
                        </div>

                        <!-- Right: Penyelenggaraan Fungsi (Clean List) -->
                        <div>
                            @if(!empty(trim(strip_tags($fungsiContent))))
                                <h3 class="text-3xl font-bold text-white mb-8 flex items-center gap-4">
                                    <span class="w-12 h-12 rounded-2xl bg-gold-500/20 text-gold-400 flex items-center justify-center shrink-0">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                    </span>
                                    Rincian Fungsi
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
                            @endif
                        </div>

                    </div>
                </div>
            </section>
        @endif

        {{-- 4. STRUKTUR BIDANG --}}
        @if(isset($profiles['struktur']) && $profiles['struktur']->is_active)
            @php $struktur = $profiles['struktur']; @endphp
            <section id="struktur" class="py-24 px-6 bg-[#F8FAFC]">
                <div class="max-w-7xl mx-auto text-center">
                    <span class="text-navy-500 font-bold tracking-[0.2em] uppercase text-xs mb-4 flex items-center justify-center gap-2">
                        <span class="w-8 h-px bg-gold-500"></span> {{ $struktur->title }} <span class="w-8 h-px bg-gold-500"></span>
                    </span>
                    <h2 class="text-4xl md:text-5xl font-black text-navy-900 uppercase tracking-tight mb-12">Bagan Organisasi</h2>

                    <div class="bg-white rounded-[3rem] p-4 md:p-8 border border-navy-50 shadow-sm relative group overflow-hidden">
                        <!-- Decorative Glow -->
                        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-gold-500/10 rounded-full blur-[100px] z-0"></div>

                        <div class="relative z-10 w-full min-h-[400px] bg-[#F8FAFC] rounded-[2rem] border border-navy-100 flex flex-col items-center justify-center shadow-inner overflow-hidden p-8">
                            @if($struktur->image)
                                <img src="{{ asset('storage/' . $struktur->image) }}" alt="Struktur Bidang Perpustakaan" class="w-full rounded-2xl shadow-sm">
                            @elseif(!empty(trim(strip_tags($struktur->content, '<img>'))))
                                <div class="prose max-w-none w-full prose-img:w-full prose-img:rounded-2xl prose-img:shadow-sm">
                                    {!! $struktur->content !!}
                                </div>
                            @else
                                <div class="flex flex-col items-center justify-center text-center">
                                    <svg class="w-24 h-24 text-navy-200 mb-6 group-hover:scale-110 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                    <h3 class="text-2xl font-black text-navy-300">Struktur Belum Diunggah</h3>
                                    <p class="text-navy-300 font-medium mt-2">Bagan organisasi bidang perpustakaan sedang dalam penyusunan.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        @endif

        {{-- Fallback: No Data --}}
        @if($profiles->isEmpty())
            <div class="text-center py-32 bg-white rounded-[2rem] border border-navy-50 max-w-4xl mx-auto mt-20 shadow-sm">
                <div class="w-24 h-24 bg-navy-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-navy-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <p class="text-navy-400 text-xl font-bold uppercase tracking-widest">Konten profil sedang dalam penyusunan.</p>
            </div>
        @endif

    </div>
@endsection
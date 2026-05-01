@extends('layouts.eperpus')

@section('title', 'Profil Perpustakaan | E-Perpus DISPUSIP')

@section('content')
<div class="min-h-screen bg-slate-50 relative overflow-hidden pb-20">

    {{-- Decorative Background --}}
    <div class="fixed top-0 inset-x-0 h-screen pointer-events-none overflow-hidden z-0">
        <div class="absolute -top-[20%] -left-[10%] w-[50%] h-[50%] rounded-full bg-emerald-400/20 blur-[120px] mix-blend-multiply"></div>
        <div class="absolute top-[20%] -right-[10%] w-[40%] h-[60%] rounded-full bg-indigo-400/20 blur-[120px] mix-blend-multiply"></div>
        <div class="absolute -bottom-[20%] left-[20%] w-[60%] h-[50%] rounded-full bg-teal-400/20 blur-[120px] mix-blend-multiply"></div>
    </div>

    {{-- Hero --}}
    <div class="relative z-10 pt-28 pb-16 lg:pt-36 lg:pb-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto text-center">
        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50/80 border border-emerald-100 text-emerald-700 text-sm font-semibold tracking-wide backdrop-blur-md mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            E-Perpus DISPUSIP Kota Padang
        </span>
        <h1 class="text-4xl md:text-6xl font-extrabold text-slate-900 tracking-tight mb-6">
            Profil <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-500 to-teal-500">Perpustakaan</span> Kami
        </h1>
        <p class="text-lg md:text-xl text-slate-500 max-w-2xl mx-auto leading-relaxed">
            Mengenal lebih dalam tentang sejarah, tugas pokok, dan struktur Bidang Perpustakaan DISPUSIP Kota Padang.
        </p>

        {{-- Page Anchor Links --}}
        <div class="flex flex-wrap justify-center gap-3 mt-10">
            <a href="#sejarah" class="px-5 py-2.5 text-sm font-semibold bg-white border border-slate-200 text-slate-700 rounded-full shadow-sm hover:border-emerald-300 hover:text-emerald-700 transition-all">Sejarah</a>
            <a href="#tupoksi" class="px-5 py-2.5 text-sm font-semibold bg-white border border-slate-200 text-slate-700 rounded-full shadow-sm hover:border-emerald-300 hover:text-emerald-700 transition-all">Tugas Pokok</a>
            <a href="#struktur" class="px-5 py-2.5 text-sm font-semibold bg-white border border-slate-200 text-slate-700 rounded-full shadow-sm hover:border-emerald-300 hover:text-emerald-700 transition-all">Struktur Bidang</a>
            @if($kabidPerpustakaan)
            <a href="#kabid" class="px-5 py-2.5 text-sm font-semibold bg-white border border-slate-200 text-slate-700 rounded-full shadow-sm hover:border-emerald-300 hover:text-emerald-700 transition-all">Pimpinan</a>
            @endif
        </div>
    </div>

    <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12 pb-16">

        {{-- ==============================
             SECTION: SEJARAH
             ============================== --}}
        @if(isset($profiles['sejarah']) && $profiles['sejarah']->is_active)
        @php $sejarah = $profiles['sejarah']; @endphp
        <section id="sejarah" class="animate-fade-in-up" style="animation-fill-mode:both; animation-delay:100ms;">
            <div class="bg-white/80 backdrop-blur-xl rounded-3xl border border-white/60 shadow-xl shadow-slate-100/80 overflow-hidden">
                {{-- Section Header --}}
                <div class="bg-gradient-to-r from-emerald-500 to-teal-500 px-8 py-6 flex items-center gap-4">
                    <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-white">{{ $sejarah->title }}</h2>
                        <p class="text-emerald-100 text-sm">Latar belakang dan perjalanan perpustakaan</p>
                    </div>
                </div>
                {{-- Content --}}
                <div class="p-8">
                    @if($sejarah->image)
                        <img src="{{ asset('storage/' . $sejarah->image) }}" alt="Sejarah Perpustakaan"
                             class="w-full max-h-72 object-cover rounded-2xl mb-6 border border-slate-100">
                    @endif
                    <div class="prose prose-slate prose-lg max-w-none
                                prose-headings:font-bold prose-headings:text-slate-800
                                prose-p:text-slate-600 prose-p:leading-relaxed
                                prose-li:text-slate-600 prose-a:text-emerald-600">
                        {!! $sejarah->content !!}
                    </div>
                </div>
            </div>
        </section>
        @endif

        {{-- ==============================
             SECTION: TUPOKSI
             ============================== --}}
        @if(isset($profiles['tupoksi']) && $profiles['tupoksi']->is_active)
        @php $tupoksi = $profiles['tupoksi']; @endphp
        <section id="tupoksi" class="animate-fade-in-up" style="animation-fill-mode:both; animation-delay:200ms;">
            <div class="bg-white/80 backdrop-blur-xl rounded-3xl border border-white/60 shadow-xl shadow-slate-100/80 overflow-hidden">
                {{-- Section Header --}}
                <div class="bg-gradient-to-r from-indigo-500 to-blue-600 px-8 py-6 flex items-center gap-4">
                    <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-white">{{ $tupoksi->title }}</h2>
                        <p class="text-indigo-200 text-sm">Tugas pokok dan fungsi Bidang Perpustakaan</p>
                    </div>
                </div>
                {{-- Content --}}
                <div class="p-8">
                    <div class="prose prose-slate prose-lg max-w-none
                                prose-headings:font-bold prose-headings:text-slate-800
                                prose-h3:text-base prose-h3:uppercase prose-h3:tracking-wider prose-h3:text-indigo-600
                                prose-p:text-slate-600 prose-p:leading-relaxed
                                prose-li:text-slate-600 prose-a:text-indigo-600">
                        {!! $tupoksi->content !!}
                    </div>

                    {{-- Fungsi Cards (if meta.fungsi exists) --}}
                    @if(!empty($tupoksi->meta['fungsi']))
                    <div class="mt-8 pt-6 border-t border-slate-100">
                        <h3 class="text-sm font-bold text-slate-500 uppercase tracking-widest mb-4">Rincian Fungsi</h3>
                        <div class="prose prose-slate max-w-none prose-li:text-slate-600">
                            {!! $tupoksi->meta['fungsi'] !!}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </section>
        @endif

        {{-- ==============================
             SECTION: STRUKTUR
             ============================== --}}
        @if(isset($profiles['struktur']) && $profiles['struktur']->is_active)
        @php $struktur = $profiles['struktur']; @endphp
        <section id="struktur" class="animate-fade-in-up" style="animation-fill-mode:both; animation-delay:300ms;">
            <div class="bg-white/80 backdrop-blur-xl rounded-3xl border border-white/60 shadow-xl shadow-slate-100/80 overflow-hidden">
                {{-- Section Header --}}
                <div class="bg-gradient-to-r from-amber-500 to-orange-500 px-8 py-6 flex items-center gap-4">
                    <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-white">{{ $struktur->title }}</h2>
                        <p class="text-amber-100 text-sm">Organisasi Bidang Perpustakaan DISPUSIP</p>
                    </div>
                </div>
                {{-- Content --}}
                <div class="p-8">
                    <div class="prose prose-slate prose-lg max-w-none
                                prose-headings:font-bold prose-headings:text-slate-800
                                prose-p:text-slate-600 prose-p:leading-relaxed
                                prose-li:text-slate-600">
                        {!! $struktur->content !!}
                    </div>
                    @if($struktur->image)
                        <div class="mt-8">
                            <p class="text-xs text-slate-400 font-semibold uppercase tracking-widest mb-3">Bagan Struktur</p>
                            <img src="{{ asset('storage/' . $struktur->image) }}" alt="Struktur Bidang Perpustakaan"
                                 class="w-full object-contain rounded-2xl border border-slate-100 shadow-sm cursor-zoom-in hover:scale-[1.02] transition-transform duration-300"
                                 loading="lazy">
                        </div>
                    @endif
                </div>
            </div>
        </section>
        @endif

        {{-- ==============================
             SECTION: KABID PERPUSTAKAAN
             ============================== --}}
        @if($kabidPerpustakaan)
        <section id="kabid" class="animate-fade-in-up" style="animation-fill-mode:both; animation-delay:400ms;">
            <div class="bg-white/80 backdrop-blur-xl rounded-3xl border border-white/60 shadow-xl shadow-slate-100/80 overflow-hidden">
                <div class="bg-gradient-to-r from-rose-500 to-pink-600 px-8 py-6 flex items-center gap-4">
                    <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-white">Pimpinan Bidang Perpustakaan</h2>
                        <p class="text-rose-100 text-sm">Kepala Bidang yang memimpin pelayanan perpustakaan</p>
                    </div>
                </div>
                <div class="p-8">
                    <div class="flex flex-col sm:flex-row items-center sm:items-start gap-8">
                        {{-- Photo --}}
                        <div class="flex-shrink-0">
                            @if($kabidPerpustakaan->image)
                                <img src="{{ asset('storage/' . $kabidPerpustakaan->image) }}"
                                     alt="{{ $kabidPerpustakaan->nama }}"
                                     class="w-36 h-36 object-cover rounded-3xl border-4 border-rose-100 shadow-lg shadow-rose-100/50">
                            @else
                                <div class="w-36 h-36 rounded-3xl bg-gradient-to-br from-rose-100 to-pink-100 flex items-center justify-center border-4 border-rose-100">
                                    <svg class="w-16 h-16 text-rose-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        {{-- Info --}}
                        <div class="text-center sm:text-left">
                            <p class="text-xs font-bold text-rose-500 uppercase tracking-widest mb-2">{{ $kabidPerpustakaan->jabatan }}</p>
                            <h3 class="text-2xl font-extrabold text-slate-900 mb-1">{{ $kabidPerpustakaan->nama }}</h3>
                            @if($kabidPerpustakaan->nip)
                                <p class="text-sm text-slate-500 mb-4">NIP: {{ $kabidPerpustakaan->nip }}</p>
                            @endif
                            @if($kabidPerpustakaan->keterangan)
                                <p class="text-slate-600 leading-relaxed text-sm max-w-lg">{{ $kabidPerpustakaan->keterangan }}</p>
                            @endif
                            {{-- Social Links --}}
                            @if($kabidPerpustakaan->instagram || $kabidPerpustakaan->facebook || $kabidPerpustakaan->twitter)
                            <div class="flex gap-3 mt-4 justify-center sm:justify-start">
                                @if($kabidPerpustakaan->instagram)
                                    <a href="{{ $kabidPerpustakaan->instagram }}" target="_blank"
                                       class="w-9 h-9 rounded-xl bg-rose-50 flex items-center justify-center text-rose-500 hover:bg-rose-500 hover:text-white transition-all">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                    </a>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif

        {{-- Fallback: No Data --}}
        @if($profiles->isEmpty())
        <div class="text-center py-20">
            <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <p class="text-slate-400 text-lg font-medium">Konten profil sedang dalam penyusunan.</p>
        </div>
        @endif

    </div>
</div>
@endsection

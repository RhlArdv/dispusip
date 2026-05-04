@extends('layouts.eperpus')

@section('title', 'Layanan Kami | E-Perpus DISPUSIP')

@section('hero_title')
    <h1 class="text-4xl md:text-6xl lg:text-7xl font-black text-navy-900 tracking-tight uppercase leading-[1.1]">
        Layanan <br>
        <span class="text-transparent" style="-webkit-text-stroke: 1.5px #0f2440;">Kami</span>
    </h1>
@endsection

@section('content')
    <div class="min-h-screen bg-slate-50 relative pb-20">

        <!-- SERVICES (LAYANAN BENTO GRID) - DENGAN BACKGROUND SVG -->
        <section class="py-24 px-6 bg-white relative bg-fixed bg-bottom bg-no-repeat border-b border-navy-50"
            style="background-image: url('{{ asset('assets/img/backgroudndisp.svg') }}'); background-size: 100% auto;">
            <!-- Overlay putih tipis agar card bento grid tetap terbaca jelas -->
            <div class="absolute inset-0 bg-white/40 z-0"></div>

            <div class="max-w-7xl mx-auto relative z-10">
                <div class="text-center mb-16">
                    <span
                        class="text-gold-600 font-bold tracking-[0.2em] uppercase text-xs mb-4 flex items-center justify-center gap-2">
                        <span class="w-8 h-px bg-gold-500"></span> Untuk Masyarakat <span
                            class="w-8 h-px bg-gold-500"></span>
                    </span>
                    <h2 class="text-4xl md:text-6xl font-black text-navy-900 tracking-tighter uppercase leading-none">
                        Layanan Pemustaka &<br>
                        <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-gold-400 to-gold-600">Pengunjung.</span>
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-12 gap-6 auto-rows-[250px] md:auto-rows-[300px]">

                    {{-- Card 1: Onesearch (col-span-4) --}}
                    <a href="{{ ($layananUtama[0]->link_type ?? 'external') === 'internal' ? url($layananUtama[0]->url ?? '/') : ($layananUtama[0]->url ?? 'https://onesearch.id/') }}"
                        {{ ($layananUtama[0]->link_type ?? 'external') === 'external' ? 'target="_blank"' : '' }}
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
                                <h3 class="text-2xl font-black text-navy-900 mb-2">
                                    {{ $layananUtama[0]->title ?? 'Onesearch.id' }}</h3>
                                <p class="text-navy-600 font-medium text-sm">
                                    {{ $layananUtama[0]->description ?? 'Pintu pencarian tunggal untuk semua koleksi publik dari perpustakaan di Indonesia.' }}
                                </p>
                            </div>
                        </div>
                    </a>

                    {{-- Card 2: OPAC (col-span-8) --}}
                    <a href="{{ ($layananUtama[1]->link_type ?? 'external') === 'internal' ? url($layananUtama[1]->url ?? '/') : ($layananUtama[1]->url ?? '#') }}"
                        {{ ($layananUtama[1]->link_type ?? 'external') === 'external' ? 'target="_blank"' : '' }}
                        class="block col-span-1 md:col-span-8 rounded-[2.5rem] overflow-hidden relative group cursor-pointer shadow-[0_20px_50px_rgba(15,36,64,0.1)]">
                        <img src="{{ $layananUtama[1]->bg_image ?? 'https://images.unsplash.com/photo-1507842217343-583bb7270b66?auto=format&fit=crop&q=80&w=1200' }}"
                            class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        <div
                            class="absolute inset-0 bg-navy-900/60 group-hover:bg-navy-900/40 transition-colors duration-500">
                        </div>
                        <div class="absolute inset-0 flex flex-col justify-between p-8 lg:p-10">
                            <div class="flex justify-between items-start">
                                <span
                                    class="px-4 py-2 rounded-full bg-white/20 backdrop-blur-md text-white text-xs font-bold uppercase tracking-widest border border-white/30">
                                    {{ $layananUtama[1]->badge_label ?? 'Katalog' }}
                                </span>
                                <div
                                    class="w-12 h-12 rounded-full bg-gold-500 flex items-center justify-center text-navy-900 transform -rotate-45 group-hover:rotate-0 transition-transform duration-500 shadow-lg">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-4xl font-black text-white mb-2">
                                    {{ $layananUtama[1]->title ?? 'OPAC & E-Library' }}</h3>
                                <p class="text-navy-100 font-medium max-w-md">
                                    {{ $layananUtama[1]->description ?? 'Eksplorasi dan pinjam ribuan koleksi literatur digital secara instan dari mana saja.' }}
                                </p>
                            </div>
                        </div>
                    </a>

                    {{-- Card 3: Keanggotaan (col-span-5) --}}
                    <a href="{{ ($layananUtama[2]->link_type ?? 'external') === 'internal' ? url($layananUtama[2]->url ?? '/') : ($layananUtama[2]->url ?? '#') }}"
                        {{ ($layananUtama[2]->link_type ?? 'external') === 'external' ? 'target="_blank"' : '' }}
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
                                class="px-4 py-2 rounded-full bg-navy-900/10 text-navy-900 border border-navy-900/20 text-xs font-bold uppercase tracking-widest w-fit">
                                {{ $layananUtama[2]->badge_label ?? 'Registrasi' }}
                            </span>
                            <div>
                                <h3 class="text-4xl font-black text-navy-900 mb-2">
                                    {{ $layananUtama[2]->title ?? 'Daftar Anggota' }}</h3>
                                <p class="text-navy-900/80 font-medium mb-6">
                                    {{ $layananUtama[2]->description ?? 'Gabung sekarang dan nikmati seluruh akses layanan eksklusif kami.' }}
                                </p>
                            </div>
                        </div>
                    </a>

                    {{-- Card 4: iPusnas (col-span-3) --}}
                    <a href="{{ ($layananUtama[3]->link_type ?? 'external') === 'internal' ? url($layananUtama[3]->url ?? '/') : ($layananUtama[3]->url ?? '#') }}"
                        {{ ($layananUtama[3]->link_type ?? 'external') === 'external' ? 'target="_blank"' : '' }}
                        class="block col-span-1 md:col-span-3 bg-navy-900 rounded-[2.5rem] p-8 relative overflow-hidden group cursor-pointer shadow-lg">
                        <div
                            class="absolute top-0 right-0 w-32 h-32 bg-gold-500 rounded-full blur-[50px] opacity-20 group-hover:opacity-40 transition-opacity">
                        </div>
                        <div class="relative z-10 flex flex-col justify-between h-full">
                            <div
                                class="w-12 h-12 rounded-full bg-navy-800 flex items-center justify-center text-gold-400 group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-black text-white mb-2">{{ $layananUtama[3]->title ?? 'iPusnas' }}
                                </h3>
                                <p class="text-navy-200 font-medium text-sm">
                                    {{ $layananUtama[3]->description ?? 'Aplikasi perpustakaan digital nasional berbasis media sosial.' }}
                                </p>
                            </div>
                        </div>
                    </a>

                    {{-- Card 5: Agenda Kegiatan (col-span-4) --}}
                    <a href="{{ isset($layananUtama[4]) ? (($layananUtama[4]->link_type === 'internal') ? url($layananUtama[4]->url) : $layananUtama[4]->url) : route('public.kegiatan.index') }}"
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
                                <h3 class="text-2xl font-black text-navy-900 mb-2">
                                    {{ $layananUtama[4]->title ?? 'Agenda Kegiatan' }}</h3>
                                <p class="text-navy-600 font-medium text-sm">
                                    {{ $layananUtama[4]->description ?? 'Informasi lengkap terkait jadwal acara dan aktivitas dinas perpustakaan.' }}
                                </p>
                            </div>
                        </div>
                    </a>

                </div>
            </div>
        </section>

        <!-- LAYANAN PERPUSTAKAAN SECTION -->
        <section class="py-24 px-6 bg-[#F8FAFC]">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <span
                        class="text-navy-500 font-bold tracking-[0.2em] uppercase text-xs mb-4 flex items-center justify-center gap-2">
                        <span class="w-8 h-px bg-gold-500"></span> Birokrasi & Administrasi <span
                            class="w-8 h-px bg-gold-500"></span>
                    </span>
                    <h2 class="text-4xl md:text-5xl font-black text-navy-900 tracking-tight uppercase">
                        Layanan Perpustakaan
                    </h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    @forelse($layananSekunder as $layanan)
        <a href="{{ $layanan->link_type === 'internal' ? url($layanan->url) : $layanan->url }}"
            {{ $layanan->link_type === 'external' && !str_starts_with($layanan->url, '#') ? 'target="_blank"' : '' }}
            class="group bg-white p-8 rounded-3xl shadow-sm border border-navy-100 hover:shadow-[0_20px_40px_rgba(15,36,64,0.08)] transition-all duration-300 flex flex-col items-center text-center hover:-translate-y-2">
            <div class="w-20 h-20 rounded-full bg-navy-50 text-navy-900 flex items-center justify-center mb-6 group-hover:bg-gold-500 group-hover:text-white transition-colors">
                {!! $layanan->icon_svg !!}
            </div>
            <h3 class="text-xl font-bold text-navy-900 group-hover:text-gold-600 transition-colors">{{ $layanan->title }}</h3>
            <p class="text-sm text-navy-500 mt-3 leading-relaxed">{{ $layanan->description }}</p>
        </a>
    @empty
        <div class="col-span-4 text-center py-8 text-navy-400">
            Belum ada layanan perpustakaan.
        </div>
    @endforelse
</div>
            </div>
        </section>

    </div>
@endsection
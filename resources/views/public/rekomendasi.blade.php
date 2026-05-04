@extends('layouts.eperpus')

@section('title', 'Rekomendasi Pilihan | E-Perpus DISPUSIP')

@section('hero_title')
    <h1 class="text-4xl md:text-6xl lg:text-7xl font-black text-navy-900 tracking-tight uppercase leading-[1.1]">
        Rekomendasi <br>
        <span class="text-transparent" style="-webkit-text-stroke: 1.5px #0f2440;">Pilihan</span>
    </h1>
@endsection

@section('content')
    <div class="min-h-screen bg-slate-50 relative pb-20">

        {{-- SECTION: REKOMENDASI BUKU --}}
        <section id="rekomendasi-buku" class="py-24 px-6 bg-white relative">
            <div class="max-w-7xl mx-auto">

                <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-12 gap-4">
                    <div>
                        <span
                            class="text-navy-500 font-bold tracking-[0.2em] uppercase text-xs mb-4 flex items-center gap-2">
                            <span class="w-8 h-px bg-gold-500"></span> Literatur Terpilih
                        </span>
                        <h2 class="text-4xl md:text-5xl font-black text-navy-900 tracking-tight leading-tight">
                            Buku Pilihan
                        </h2>
                    </div>
                    <p
                        class="text-navy-500 font-medium text-sm sm:text-right max-w-xs border-l-2 sm:border-l-0 sm:border-r-2 border-gold-500 pl-4 sm:pl-0 sm:pr-4 py-1">
                        Buku-buku terpopuler dan paling direkomendasikan minggu ini.
                    </p>
                </div>

                {{-- Books Grid --}}
                @if($buku->count() > 0)
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-5 md:gap-6 lg:gap-8 mb-16">
                        @foreach($buku as $book)
                            <a href="{{ route('public.buku.show', $book->slug) }}"
                                class="group flex flex-col h-full bg-white rounded-[2rem] p-4 shadow-[0_10px_30px_rgba(15,36,64,0.03)] border border-navy-50 hover:border-gold-300 hover:shadow-[0_20px_40px_rgba(15,36,64,0.10)] transition-all duration-500 hover:-translate-y-2 relative overflow-hidden"
                                style="animation: fadeInUp 0.8s ease-out forwards; animation-delay: {{ $loop->index * 100 }}ms; opacity: 0;">

                                {{-- Cover Image Container --}}
                                <div
                                    class="relative aspect-[3/4] w-full rounded-[1.5rem] overflow-hidden bg-navy-50 mb-5 flex-shrink-0">
                                    @if($book->sampul_url)
                                        <img src="{{ $book->sampul_url }}" alt="{{ $book->judul }}" loading="lazy"
                                            class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105">
                                    @else
                                        <div
                                            class="absolute inset-0 flex flex-col items-center justify-center text-navy-300 bg-navy-100/50">
                                            <svg class="w-12 h-12 mb-2 opacity-50" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                        </div>
                                    @endif

                                    {{-- Overlays --}}
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-navy-900/80 via-navy-900/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                    </div>

                                    <div
                                        class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500 translate-y-4 group-hover:translate-y-0">
                                        <div
                                            class="w-12 h-12 bg-gold-400 rounded-full flex items-center justify-center shadow-lg transform scale-90 group-hover:scale-100 transition-transform">
                                            <svg class="w-6 h-6 text-navy-900" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>

                                    {{-- PDF Badge --}}
                                    @if($book->file_pdf)
                                        <div class="absolute top-3 right-3 z-10">
                                            <span
                                                class="flex items-center gap-1 px-2.5 py-1 bg-white/20 backdrop-blur-md text-white text-[10px] font-bold rounded-full shadow-sm border border-white/30 uppercase tracking-wider">
                                                PDF
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                {{-- Info --}}
                                <div class="px-2 pb-2 flex-1 flex flex-col">
                                    @if($book->kategoriBuku)
                                        <span
                                            class="text-[10px] font-bold text-gold-600 uppercase tracking-widest mb-1.5 truncate">{{ $book->kategoriBuku->nama }}</span>
                                    @endif
                                    <h3
                                        class="font-black text-navy-900 text-sm md:text-base leading-snug line-clamp-2 mb-2 group-hover:text-gold-600 transition-colors">
                                        {{ $book->judul }}</h3>

                                    <div class="mt-auto pt-3 flex flex-col gap-1 border-t border-navy-50 border-dashed">
                                        @if($book->penulis)
                                            <p class="text-xs text-navy-500 line-clamp-1"><span class="opacity-70">Oleh</span> <span
                                                    class="font-bold text-navy-700">{{ $book->penulis }}</span></p>
                                        @endif
                                        @if($book->tahun_terbit)
                                            <p class="text-[10px] text-navy-400 font-mono mt-1">{{ $book->tahun_terbit }}</p>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    {{-- Tombol Lihat Semua Buku --}}
                    <div class="flex justify-center">
                        <a href="{{ route('public.buku.index') }}"
                            class="group relative inline-flex items-center justify-center gap-3 px-8 py-4 bg-navy-900 text-white font-bold rounded-full overflow-hidden transition-all hover:shadow-[0_10px_20px_rgba(15,36,64,0.2)]">
                            <span
                                class="absolute inset-0 w-full h-full -mt-1 rounded-lg opacity-30 bg-gradient-to-b from-transparent via-transparent to-black"></span>
                            <span class="relative">Lihat Semua Buku</span>
                            <svg class="w-5 h-5 relative transform group-hover:translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                @else
                    <div
                        class="flex flex-col items-center justify-center py-24 px-4 bg-[#F8FAFC] rounded-[3rem] border border-navy-50 text-center">
                        <div
                            class="w-20 h-20 bg-white rounded-2xl flex items-center justify-center mb-6 shadow-sm border border-navy-50">
                            <svg class="w-10 h-10 text-navy-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-navy-900 mb-2">Belum Ada Rekomendasi</h3>
                        <p class="text-navy-500 font-medium max-w-md">Koleksi buku rekomendasi saat ini belum tersedia. Silakan
                            kembali lagi nanti.</p>
                    </div>
                @endif
            </div>
        </section>

        {{-- KOLEKSI PER KATEGORI --}}
        @if(isset($koleksi) && $koleksi->isNotEmpty() || isset($selectedCategory))
            <section class="py-24 bg-[#F8FAFC] border-t border-navy-50 relative" id="koleksi-kategori">
                <div class="max-w-7xl mx-auto px-6">

                    {{-- Header --}}
                    <div class="flex flex-col md:flex-row items-end justify-between mb-12 gap-6">
                        <div>
                            <span
                                class="text-gold-600 font-bold tracking-[0.2em] uppercase text-xs mb-4 flex items-center gap-2">
                                <span class="w-8 h-px bg-gold-500"></span> Eksplorasi
                            </span>
                            <h2 class="text-4xl md:text-5xl font-black tracking-tight text-navy-900 leading-none">
                                Koleksi<br><span
                                    class="text-transparent bg-clip-text bg-gradient-to-r from-gold-400 to-gold-600">Per
                                    Kategori</span>
                            </h2>
                        </div>
                        <p class="text-navy-500 font-medium max-w-sm text-sm border-l-2 border-gold-500 pl-4 py-1">
                            Temukan koleksi pilihan yang dikelompokkan berdasarkan kategori untuk memudahkan pencarian Anda.
                        </p>
                    </div>

                    {{-- Tab Pills (Links instead of Alpine buttons) --}}
                    <div class="flex flex-nowrap md:flex-wrap gap-3 mb-12 overflow-x-auto pb-4 scrollbar-hide">
                        {{-- Tab "Semua" --}}
                        <a href="{{ route('public.rekomendasi') }}#koleksi-kategori"
                            class="{{ !$selectedCategory ? 'bg-navy-900 text-white shadow-[0_8px_16px_rgba(15,36,64,0.2)] border-navy-900' : 'bg-white text-navy-600 border-navy-100 hover:border-gold-400 hover:text-gold-600 hover:bg-gold-50' }} px-6 py-3 border rounded-full font-bold text-sm transition-all duration-300 flex items-center gap-3 whitespace-nowrap">
                            <span>Semua</span>
                        </a>

                        @foreach($categories as $cat)
                            <a href="{{ route('public.rekomendasi', ['category' => $cat['key']]) }}#koleksi-kategori"
                                class="{{ $selectedCategory == $cat['key'] ? 'bg-navy-900 text-white shadow-[0_8px_16px_rgba(15,36,64,0.2)] border-navy-900' : 'bg-white text-navy-600 border-navy-100 hover:border-gold-400 hover:text-gold-600 hover:bg-gold-50' }} px-6 py-3 border rounded-full font-bold text-sm transition-all duration-300 flex items-center gap-3 whitespace-nowrap">
                                <span>{{ $cat['name'] }}</span>
                            </a>
                        @endforeach
                    </div>

                    {{-- Content Grid --}}
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-5 lg:gap-6 mb-12">
                        @forelse($koleksi as $item)
                            <a href="{{ $item->slug ? route('public.koleksi.show', $item->slug) : '#' }}"
                                class="group bg-white rounded-[2rem] overflow-hidden border border-navy-50 hover:border-gold-300 hover:shadow-[0_20px_40px_rgba(15,36,64,0.08)] transition-all duration-500 flex flex-col hover:-translate-y-1"
                                style="animation: fadeInUp 0.8s ease-out forwards; animation-delay: {{ $loop->index * 50 }}ms; opacity: 0;">

                                {{-- Cover --}}
                                <div class="relative w-full bg-navy-50 overflow-hidden flex-shrink-0"
                                    style="padding-bottom: 133.33%;">
                                    @if($item->cover_image)
                                        <img src="{{ $item->cover_image }}" alt="{{ $item->judul_koleksi }}" loading="lazy"
                                            class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                                    @else
                                        <div
                                            class="absolute inset-0 flex flex-col items-center justify-center gap-3 bg-gradient-to-br from-navy-50 to-navy-100">
                                            <div
                                                class="w-12 h-12 rounded-full bg-white flex items-center justify-center text-navy-300 shadow-sm">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        </div>
                                    @endif

                                    {{-- Category Badge Overlay --}}
                                    <div class="absolute top-4 left-4">
                                        <span
                                            class="bg-gold-500/90 backdrop-blur-md text-navy-900 text-[10px] font-black uppercase tracking-widest px-3 py-1.5 rounded-full shadow-sm">
                                            {{ $item->kategori_nama }}
                                        </span>
                                    </div>

                                    {{-- Hover overlay --}}
                                    <div
                                        class="absolute inset-0 bg-navy-900/0 group-hover:bg-navy-900/30 transition-colors duration-500 flex items-center justify-center">
                                        @if($item->link)
                                            <div
                                                class="opacity-0 group-hover:opacity-100 transition-all duration-300 w-14 h-14 bg-white rounded-full flex items-center justify-center shadow-xl transform scale-50 group-hover:scale-100">
                                                <svg class="w-6 h-6 text-gold-500 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                {{-- Info --}}
                                <div class="p-5 flex-1 flex flex-col justify-between bg-white">
                                    <h3
                                        class="text-sm md:text-base font-black text-navy-900 line-clamp-2 leading-snug group-hover:text-gold-600 transition-colors mb-2">
                                        {{ $item->judul_koleksi }}
                                    </h3>
                                    @if($item->isi_koleksi)
                                        <p class="text-xs text-navy-500 line-clamp-2 leading-relaxed">
                                            {{ Str::limit(strip_tags($item->isi_koleksi), 60) }}
                                        </p>
                                    @endif
                                </div>
                            </a>
                        @empty
                            <div class="col-span-full text-center py-20 bg-white rounded-[3rem] border border-navy-50">
                                <div class="w-16 h-16 bg-navy-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-navy-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                </div>
                                <p class="font-bold text-navy-900">Belum Ada Koleksi</p>
                                <p class="text-sm text-navy-500 mt-1">Koleksi untuk kategori ini belum tersedia.</p>
                            </div>
                        @endforelse
                    </div>

                    {{-- Pagination Links --}}
                    @if($koleksi->hasPages())
                        <div class="flex justify-center mt-12">
                            {{ $koleksi->fragment('koleksi-kategori')->links('partials.pagination') }}
                        </div>
                    @endif

                </div>
            </section>
        @endif

    </div>

    <style>
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

        /* Hide scrollbar for horizontal scrolling tabs */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
@endsection
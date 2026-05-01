@extends('layouts.public')

@section('title', 'Katalog Buku Digital')

@section('content')
<div class="min-h-screen bg-slate-50 relative overflow-hidden pb-20">

    {{-- Decorative Background Elements --}}
    <div class="fixed top-0 inset-x-0 h-screen pointer-events-none overflow-hidden z-0">
        <div class="absolute -top-[20%] -left-[10%] w-[50%] h-[50%] rounded-full bg-indigo-400/20 blur-[120px] mix-blend-multiply"></div>
        <div class="absolute top-[20%] -right-[10%] w-[40%] h-[60%] rounded-full bg-emerald-400/20 blur-[120px] mix-blend-multiply"></div>
        <div class="absolute -bottom-[20%] left-[20%] w-[60%] h-[50%] rounded-full bg-sky-400/20 blur-[120px] mix-blend-multiply"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI4IiBoZWlnaHQ9IjgiPgo8cmVjdCB3aWR0aD0iOCIgaGVpZ2h0PSI4IiBmaWxsPSIjZmZmIiBmaWxsLW9wYWNpdHk9IjAuMSI+PC9yZWN0Pgo8cGF0aCBkPSJNMCAwaDh2OEgweiIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjMDAwIiBzdHJva2Utb3BhY2l0eT0iMC4wNCIgc3Ryb2tlLXdpZHRoPSIxIj48L3BhdGg+Cjwvc3ZnPg==')] opacity-50"></div>
    </div>

    {{-- Hero Section --}}
    <div class="relative z-10 pt-24 pb-12 lg:pt-32 lg:pb-16 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="text-center max-w-3xl mx-auto">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-50/80 border border-indigo-100 text-indigo-600 text-sm font-semibold tracking-wide backdrop-blur-md mb-6">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                E-Perpus DISPUSIP
            </span>
            <h1 class="text-4xl md:text-6xl font-extrabold text-slate-900 tracking-tight mb-6">
                Eksplorasi <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-emerald-500">Koleksi Buku</span> Kami.
            </h1>
            <p class="text-lg md:text-xl text-slate-600 leading-relaxed">
                Temukan ribuan literatur digital, jurnal, dan buku referensi yang dapat diakses di mana saja dan kapan saja.
            </p>
        </div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Glassmorphic Search & Filters --}}
        <div class="bg-white/70 backdrop-blur-xl border border-white/40 shadow-2xl shadow-indigo-100/50 rounded-3xl p-6 md:p-8 mb-12">
            <form method="GET" action="{{ route('public.buku.index') }}" class="flex flex-col gap-5">
                {{-- Primary Search --}}
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-6 w-6 text-indigo-500 group-focus-within:text-indigo-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}" 
                           placeholder="Cari judul buku, nama penulis, penerbit, atau ISBN..." 
                           class="block w-full pl-12 pr-4 py-4 md:py-5 bg-white/60 border-2 border-transparent focus:bg-white focus:border-indigo-500/30 rounded-2xl text-slate-900 placeholder-slate-400 text-lg transition-all shadow-inner outline-none">
                    <button type="submit" class="absolute inset-y-2 right-2 px-6 bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-500 hover:to-indigo-600 text-white font-semibold rounded-xl transition-all shadow-md hover:shadow-lg active:scale-95 flex items-center gap-2">
                        <span class="hidden sm:inline">Cari</span>
                        <svg class="w-5 h-5 sm:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </button>
                </div>

                {{-- Secondary Filters Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="relative">
                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5 ml-1">Kategori</label>
                        <select name="kategori" class="w-full bg-white/50 border border-slate-200/60 rounded-xl px-4 py-3 text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 appearance-none transition-colors cursor-pointer">
                            <option value="">Semua Kategori</option>
                            @foreach($kategoriBuku as $kategori)
                                <option value="{{ $kategori->id }}" {{ request('kategori') == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute right-4 top-[38px] pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>

                    <div class="relative">
                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5 ml-1">Penerbit</label>
                        <select name="penerbit" class="w-full bg-white/50 border border-slate-200/60 rounded-xl px-4 py-3 text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 appearance-none transition-colors cursor-pointer">
                            <option value="">Semua Penerbit</option>
                            @foreach($listPenerbit as $penerbit)
                                <option value="{{ $penerbit }}" {{ request('penerbit') == $penerbit ? 'selected' : '' }}>
                                    {{ $penerbit }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute right-4 top-[38px] pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>

                    <div class="relative">
                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5 ml-1">Tahun Terbit</label>
                        <select name="tahun" class="w-full bg-white/50 border border-slate-200/60 rounded-xl px-4 py-3 text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 appearance-none transition-colors cursor-pointer">
                            <option value="">Semua Tahun</option>
                            @foreach($listTahun as $tahun)
                                <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>
                                    {{ $tahun }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute right-4 top-[38px] pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        {{-- Results Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8 px-2">
            <h2 class="text-2xl font-bold text-slate-800">
                @if(request('search') || request('kategori') || request('penerbit') || request('tahun'))
                    Hasil Pencarian
                @else
                    Koleksi Terbaru
                @endif
            </h2>
            <div class="flex items-center gap-3">
                <span class="px-4 py-2 bg-slate-100 text-slate-600 rounded-full text-sm font-medium border border-slate-200">
                    Menampilkan {{ $buku->firstItem() ?? 0 }}-{{ $buku->lastItem() ?? 0 }} dari {{ $buku->total() }} Buku
                </span>
                @if(request('search') || request('kategori') || request('penerbit') || request('tahun'))
                    <a href="{{ route('public.buku.index') }}" class="p-2 text-rose-500 hover:bg-rose-50 rounded-full transition-colors group" title="Reset Filter">
                        <svg class="w-5 h-5 group-hover:rotate-180 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </a>
                @endif
            </div>
        </div>

        {{-- Books Grid --}}
        @if($buku->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 md:gap-6 lg:gap-8 mb-12">
                @foreach($buku as $book)
                    <a href="{{ route('public.buku.show', $book->slug) }}" 
                       class="book-card animate-fade-in-up group flex flex-col h-full bg-white rounded-3xl p-3 md:p-4 shadow-sm border border-slate-100 hover:shadow-2xl hover:shadow-indigo-500/10 hover:-translate-y-2 focus:outline-none focus:ring-4 focus:ring-indigo-500/20 transition-all duration-500"
                       style="animation-fill-mode: both; animation-delay: {{ $loop->index * 75 }}ms;">
                        
                        {{-- Cover Image Container --}}
                        <div class="relative aspect-[3/4] w-full rounded-2xl overflow-hidden bg-slate-100 mb-4 shadow-[inset_0_0_0_1px_rgba(0,0,0,0.05)] isolate">
                            @if($book->sampul_url)
                                <img src="{{ $book->sampul_url }}" 
                                     alt="{{ $book->judul }}" 
                                     loading="lazy"
                                     class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            @else
                                <div class="absolute inset-0 flex flex-col items-center justify-center text-slate-300 bg-slate-50">
                                    <svg class="w-12 h-12 mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                </div>
                            @endif

                            {{-- Overlays --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            
                            {{-- View Button (Visible on hover) --}}
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 translate-y-4 group-hover:translate-y-0">
                                <span class="px-4 py-2 bg-white/90 backdrop-blur-sm text-indigo-700 text-sm font-bold rounded-full shadow-lg transform scale-90 group-hover:scale-100 transition-transform">
                                    Lihat Detail
                                </span>
                            </div>

                            {{-- PDF Badge --}}
                            @if($book->file_pdf)
                                <div class="absolute top-2 right-2 z-10">
                                    <span class="flex items-center gap-1 px-2.5 py-1 bg-rose-500/90 backdrop-blur-md text-white text-[10px] font-bold rounded-full shadow-sm border border-white/20">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                                        </svg>
                                        PDF
                                    </span>
                                </div>
                            @endif
                        </div>

                        {{-- Info --}}
                        <div class="flex flex-col flex-grow">
                            @if($book->kategoriBuku)
                                <span class="text-[10px] md:text-xs font-bold text-emerald-600 uppercase tracking-wider mb-1.5 truncate">
                                    {{ $book->kategoriBuku->nama }}
                                </span>
                            @endif

                            <h3 class="font-bold text-slate-900 text-sm md:text-base leading-snug line-clamp-2 mb-2 group-hover:text-indigo-600 transition-colors">
                                {{ $book->judul }}
                            </h3>

                            <div class="mt-auto pt-2 flex flex-col gap-1">
                                @if($book->penulis)
                                    <p class="text-xs text-slate-500 line-clamp-1">
                                        <span class="opacity-75">Oleh</span> <span class="font-medium text-slate-700">{{ $book->penulis }}</span>
                                    </p>
                                @endif
                                
                                @if($book->tahun_terbit)
                                    <p class="text-[10px] text-slate-400 font-medium bg-slate-50 inline-block px-2 py-0.5 rounded-md w-fit border border-slate-100 mt-1">
                                        {{ $book->tahun_terbit }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="flex justify-center mt-12">
                <div class="bg-white px-4 py-3 rounded-2xl shadow-sm border border-slate-100">
                    {{ $buku->appends(request()->query())->links() }}
                </div>
            </div>
        @else
            {{-- Empty State --}}
            <div class="flex flex-col items-center justify-center py-20 px-4 bg-white/50 backdrop-blur-sm rounded-3xl border border-slate-100 shadow-sm text-center">
                <div class="w-24 h-24 bg-slate-100 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-12 h-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-slate-800 mb-2">Buku Tidak Ditemukan</h3>
                <p class="text-slate-500 max-w-md mb-8">Maaf, kami tidak dapat menemukan buku yang cocok dengan kriteria pencarian Anda. Coba kata kunci atau filter lain.</p>
                <a href="{{ route('public.buku.index') }}" class="px-8 py-3.5 bg-slate-900 hover:bg-slate-800 text-white font-semibold rounded-xl transition-colors shadow-lg hover:shadow-xl active:scale-95">
                    Tampilkan Semua Buku
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', $buku->judul)

@section('content')
<div class="p-6 lg:p-8">
    {{-- Header --}}
    <div class="mb-6">
        <div class="flex items-center gap-3 text-sm text-gray-500 mb-4">
            <a href="{{ route('buku.index') }}" class="hover:text-indigo-600">Buku</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span>Detail</span>
        </div>
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-bold text-gray-900">{{ $buku->judul }}</h1>
            <div class="flex items-center gap-2">
                <a href="{{ route('buku.edit', $buku) }}"
                   class="inline-flex items-center gap-2 px-4 py-2 bg-amber-50 hover:bg-amber-100 text-amber-700
                          text-sm font-medium rounded-xl transition-colors border border-amber-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit Buku
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Cover & Actions --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-6">
                {{-- Sampul --}}
                <div class="aspect-[3/4] bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl overflow-hidden mb-6 flex items-center justify-center">
                    @if($buku->sampul_url)
                        <img src="{{ $buku->sampul_url }}" alt="{{ $buku->judul }}" class="w-full h-full object-cover">
                    @else
                        <svg class="w-24 h-24 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                  d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    @endif
                </div>

                {{-- Actions --}}
                <div class="space-y-3">
                    @if($buku->file_pdf)
                        <a href="{{ $buku->pdf_url }}" target="_blank"
                           class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-red-600 hover:bg-red-700
                                  text-white text-sm font-medium rounded-xl transition-colors shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Baca PDF
                        </a>
                    @endif

                    @if($buku->sumber)
                        <a href="{{ $buku->sumber }}" target="_blank" rel="noopener noreferrer"
                           class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-sky-50 hover:bg-sky-100
                                  text-sky-700 text-sm font-medium rounded-xl transition-colors border border-sky-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                            Lihat Sumber
                        </a>
                    @endif

                    @if($buku->file_pdf)
                        <a href="{{ $buku->pdf_url }}" download
                           class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-gray-50 hover:bg-gray-100
                                  text-gray-700 text-sm font-medium rounded-xl transition-colors border border-gray-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                            Download PDF
                        </a>
                    @endif
                </div>

                {{-- Status --}}
                <div class="mt-6 pt-6 border-t border-gray-100">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Status</span>
                        @if($buku->is_published)
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-semibold
                                         text-emerald-700 bg-emerald-50 border border-emerald-100 rounded-full">
                                Published
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-semibold
                                         text-gray-700 bg-gray-50 border border-gray-100 rounded-full">
                                Draft
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Book Info --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Metadata --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Informasi Buku</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @if($buku->kategoriBuku)
                    <div>
                        <span class="text-xs text-gray-500 uppercase tracking-wider">Kategori</span>
                        <p class="mt-1 font-medium text-gray-900">{{ $buku->kategoriBuku->nama }}</p>
                    </div>
                    @endif

                    @if($buku->penulis)
                    <div>
                        <span class="text-xs text-gray-500 uppercase tracking-wider">Penulis</span>
                        <p class="mt-1 text-gray-900">{{ $buku->penulis }}</p>
                    </div>
                    @endif

                    @if($buku->penerbit)
                    <div>
                        <span class="text-xs text-gray-500 uppercase tracking-wider">Penerbit</span>
                        <p class="mt-1 text-gray-900">{{ $buku->penerbit }}</p>
                    </div>
                    @endif

                    @if($buku->tahun_terbit)
                    <div>
                        <span class="text-xs text-gray-500 uppercase tracking-wider">Tahun Terbit</span>
                        <p class="mt-1 text-gray-900">{{ $buku->tahun_terbit }}</p>
                    </div>
                    @endif

                    @if($buku->isbn)
                    <div>
                        <span class="text-xs text-gray-500 uppercase tracking-wider">ISBN / ISSN</span>
                        <p class="mt-1 text-gray-900 font-mono">{{ $buku->isbn }}</p>
                    </div>
                    @endif

                    <div>
                        <span class="text-xs text-gray-500 uppercase tracking-wider">Ditambahkan</span>
                        <p class="mt-1 text-gray-900">{{ $buku->created_at->format('d M Y') }}</p>
                    </div>
                </div>
            </div>

            {{-- Abstrak --}}
            @if($buku->abstrak)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-3">Abstrak</h2>
                <p class="text-gray-700 leading-relaxed">{{ $buku->abstrak }}</p>
            </div>
            @endif

            {{-- Uraian --}}
            @if($buku->uraian)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-3">Uraian</h2>
                <div class="prose prose-sm max-w-none text-gray-700">
                    {!! $buku->uraian !!}
                </div>
            </div>
            @endif

            {{-- Empty State --}}
            @if(!$buku->abstrak && !$buku->uraian)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
                <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <p class="text-gray-500">Belum ada deskripsi untuk buku ini</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

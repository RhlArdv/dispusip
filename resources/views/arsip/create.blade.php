@extends('layouts.app')

@section('title', 'Tambah Arsip')

@section('page-header')
<div class="flex items-center justify-between flex-wrap gap-3">
    <div>
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-1">
            <a href="{{ route('arsip.index') }}" class="hover:text-sky-600 transition-colors">Arsip</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span>Tambah Arsip</span>
        </div>
        <h1 class="text-xl font-bold text-gray-900">Tambah Arsip Baru</h1>
    </div>
</div>
@endsection

@section('content')
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm">
    <form method="POST" action="{{ route('arsip.store') }}" class="p-6">
        @csrf

        <div class="space-y-5">

            {{-- Tingkat Perkembangan --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Tingkat Perkembangan</label>
                <select name="tingkat_perkembangan"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm
                               focus:outline-none focus:border-sky-400 focus:ring-2 focus:ring-sky-100 transition-colors">
                    <option value="">-- Pilih Tingkat Perkembangan --</option>
                    @foreach($tingkatPerkembanganOptions as $option)
                        <option value="{{ $option }}" {{ old('tingkat_perkembangan') == $option ? 'selected' : '' }}>{{ $option }}</option>
                    @endforeach
                </select>
                @error('tingkat_perkembangan')
                    <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Bentuk --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Bentuk</label>
                <select name="bentuk"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm
                               focus:outline-none focus:border-sky-400 focus:ring-2 focus:ring-sky-100 transition-colors">
                    <option value="">-- Pilih Bentuk --</option>
                    @foreach($bentukOptions as $option)
                        <option value="{{ $option }}" {{ old('bentuk') == $option ? 'selected' : '' }}>{{ $option }}</option>
                    @endforeach
                </select>
                @error('bentuk')
                    <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Keterangan --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Keterangan</label>
                <select name="keterangan"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm
                               focus:outline-none focus:border-sky-400 focus:ring-2 focus:ring-sky-100 transition-colors">
                    <option value="">-- Pilih Keterangan --</option>
                    @foreach($keteranganOptions as $option)
                        <option value="{{ $option }}" {{ old('keterangan') == $option ? 'selected' : '' }}>{{ $option }}</option>
                    @endforeach
                </select>
                @error('keterangan')
                    <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="border-t border-gray-100 pt-5">
                <p class="text-sm font-semibold text-gray-700 mb-4">Informasi Arsip</p>

                {{-- Indeks --}}
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Indeks <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="indeks" value="{{ old('indeks') }}" placeholder="Contoh: A-001"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm
                                  focus:outline-none focus:border-sky-400 focus:ring-2 focus:ring-sky-100 transition-colors
                                  @error('indeks') border-red-300 @enderror">
                    @error('indeks')
                        <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Deskripsi <span class="text-red-500">*</span>
                    </label>
                    <textarea name="deskripsi" rows="3" placeholder="Deskripsi arsip..."
                              class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm
                                     focus:outline-none focus:border-sky-400 focus:ring-2 focus:ring-sky-100 transition-colors
                                     resize-none @error('deskripsi') border-red-300 @enderror">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tahun & Jumlah --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Tahun <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="tahun" value="{{ old('tahun') }}" placeholder="2024" min="1900" max="2100"
                               class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm
                                      focus:outline-none focus:border-sky-400 focus:ring-2 focus:ring-sky-100 transition-colors
                                      @error('tahun') border-red-300 @enderror">
                        @error('tahun')
                            <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Jumlah <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="jumlah" value="{{ old('jumlah') }}" placeholder="1"
                               class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm
                                      focus:outline-none focus:border-sky-400 focus:ring-2 focus:ring-sky-100 transition-colors
                                      @error('jumlah') border-red-300 @enderror">
                        @error('jumlah')
                            <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Lokasi Penyimpanan --}}
            <div class="bg-gray-50 rounded-xl p-5">
                <p class="text-sm font-semibold text-gray-700 mb-4">Lokasi Penyimpanan <span class="text-gray-400 font-normal">(Opsional)</span></p>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1.5">Rak</label>
                        <input type="text" name="rak" value="{{ old('rak') }}" placeholder="A1"
                               class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm
                                      focus:outline-none focus:border-sky-400 focus:ring-1 focus:ring-sky-100 transition-colors">
                        @error('rak')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1.5">Roll/Pack</label>
                        <input type="text" name="roll_o_pack" value="{{ old('roll_o_pack') }}" placeholder="1"
                               class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm
                                      focus:outline-none focus:border-sky-400 focus:ring-1 focus:ring-sky-100 transition-colors">
                        @error('roll_o_pack')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1.5">Boks</label>
                        <input type="text" name="boks" value="{{ old('boks') }}" placeholder="12"
                               class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm
                                      focus:outline-none focus:border-sky-400 focus:ring-1 focus:ring-sky-100 transition-colors">
                        @error('boks')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1.5">Bungkus</label>
                        <input type="text" name="bungkus" value="{{ old('bungkus') }}" placeholder="Map"
                               class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm
                                      focus:outline-none focus:border-sky-400 focus:ring-1 focus:ring-sky-100 transition-colors">
                        @error('bungkus')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1.5">Buku</label>
                        <input type="text" name="buku" value="{{ old('buku') }}" placeholder="Buku 1"
                               class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm
                                      focus:outline-none focus:border-sky-400 focus:ring-1 focus:ring-sky-100 transition-colors">
                        @error('buku')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1.5">Sampul</label>
                        <input type="text" name="sampul" value="{{ old('sampul') }}" placeholder="Biru"
                               class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm
                                      focus:outline-none focus:border-sky-400 focus:ring-1 focus:ring-sky-100 transition-colors">
                        @error('sampul')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

        </div>

        <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100">
            <a href="{{ route('arsip.index') }}"
               class="px-6 py-3 text-sm font-medium text-gray-700 bg-gray-100
                      hover:bg-gray-200 rounded-xl transition-colors">
                Batal
            </a>
            <button type="submit"
                    class="px-6 py-3 text-sm font-semibold text-white bg-sky-500
                           hover:bg-sky-600 rounded-xl transition-colors shadow-sm">
                Simpan Arsip
            </button>
        </div>

    </form>
</div>
@endsection

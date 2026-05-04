@extends('layouts.app')

@section('title', 'Edit Galeri')

@section('page-header')
<div class="flex items-center gap-4">
    <a href="{{ route('galeri.index') }}"
       class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-xl transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
    </a>
    <div>
        <h1 class="text-xl font-bold text-gray-900">Edit Galeri</h1>
        <p class="text-[13px] text-gray-500 mt-0.5">Perbarui data galeri dan foto</p>
    </div>
</div>
@endsection

@section('content')
<div class="max-w-2xl bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <form action="{{ route('galeri.update', $galeri) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="p-6 md:p-8 space-y-6">

            {{-- Judul Galeri --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Judul Galeri <span class="text-red-500">*</span>
                </label>
                <input type="text" name="judul_galeri" value="{{ old('judul_galeri', $galeri->judul_galeri) }}"
                       class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white transition-all outline-none"
                       placeholder="Contoh: Kunjungan Kerja ke Perpustakaan Pusat">
                @error('judul_galeri') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            {{-- Current Image Preview --}}
            @if($galeri->foto_galeri)
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Foto Saat Ini</label>
                <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl border border-gray-200">
                    <img src="{{ asset($galeri->foto_galeri) }}" alt="{{ $galeri->judul_galeri }}"
                         class="h-24 w-auto rounded-lg object-cover shadow-sm">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900">{{ $galeri->judul_galeri }}</p>
                        <p class="text-xs text-gray-500 mt-1">File: {{ basename($galeri->foto_galeri) }}</p>
                    </div>
                </div>
            </div>
            @endif

            {{-- Foto Galeri --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Ganti Foto (Opsional)
                </label>
                <input type="file" name="foto_galeri" accept="image/*"
                       class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white transition-all outline-none">
                <p class="text-xs text-gray-500 mt-1.5">Kosongkan jika tidak ingin mengubah foto. Format: JPG, PNG, GIF, WEBP. Maksimal 2MB.</p>
                @error('foto_galeri') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Deskripsi</label>
                <textarea name="deskripsi" rows="4"
                          class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white transition-all outline-none resize-none"
                          placeholder="Jelaskan tentang dokumentasi atau kegiatan dalam foto ini...">{{ old('deskripsi', $galeri->deskripsi) }}</textarea>
                @error('deskripsi') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            {{-- Status --}}
            <div class="pt-2 border-t border-gray-100">
                <label class="inline-flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', $galeri->is_active) ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-500 relative transition-colors"></div>
                    <span class="text-sm text-gray-700 font-medium">Aktif</span>
                </label>
                <p class="text-xs text-gray-500 mt-1 ml-14">Centang untuk menampilkan galeri ini di halaman publik</p>
            </div>

        </div>

        <div class="px-6 md:px-8 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-end gap-3">
            <a href="{{ route('galeri.index') }}"
               class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-200 hover:bg-gray-50 rounded-xl transition-colors">
                Batal
            </a>
            <button type="submit"
                    class="px-5 py-2.5 text-sm font-semibold text-white bg-indigo-500 hover:bg-indigo-600 rounded-xl transition-colors shadow-sm shadow-indigo-200 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Perbarui
            </button>
        </div>
    </form>
</div>
@endsection

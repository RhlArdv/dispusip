@extends('layouts.app')

@section('title', isset($link) ? 'Edit Link Access' : 'Tambah Link Access')

@section('page-header')
<div class="flex items-center justify-between flex-wrap gap-3">
    <div>
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-1">
            <a href="{{ route('link-access.index') }}" class="hover:text-sky-600 transition-colors">Link Access</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span>{{ isset($link) ? 'Edit Link' : 'Tambah Link Baru' }}</span>
        </div>
        <h1 class="text-xl font-bold text-gray-900">{{ isset($link) ? 'Edit Link Access' : 'Tambah Link Access Baru' }}</h1>
    </div>
</div>
@endsection

@section('content')
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm">
    <form method="POST" action="{{ isset($link) ? route('link-access.update', $link->id) : route('link-access.store') }}" class="p-6">
        @csrf
        @method(isset($link) ? 'PUT' : 'POST')

        <div class="space-y-5">

            {{-- Judul Link --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Judul Link <span class="text-red-500">*</span>
                </label>
                <input type="text" name="judul" value="{{ old('judul', isset($link) ? $link->judul : '') }}"
                       placeholder="Contoh: OPAC / Katalog"
                       class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm
                              focus:outline-none focus:border-sky-400 focus:ring-2 focus:ring-sky-100 transition-colors
                              @error('judul') border-red-300 @enderror">
                @error('judul')
                    <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- URL Link --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    URL Link <span class="text-red-500">*</span>
                </label>
                <input type="url" name="url" value="{{ old('url', isset($link) ? $link->url : '') }}"
                       placeholder="https://example.com"
                       class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm
                              focus:outline-none focus:border-sky-400 focus:ring-2 focus:ring-sky-100 transition-colors
                              @error('url') border-red-300 @enderror">
                <p class="mt-1.5 text-xs text-gray-500">Pastikan URL diawali dengan http:// atau https://</p>
                @error('url')
                    <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Icon SVG Info --}}
            <div class="p-4 bg-sky-50 border border-sky-200 rounded-xl">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-sky-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <p class="text-sm font-semibold text-sky-900">Icon Otomatis</p>
                        <p class="text-sm text-sky-700 mt-1">
                            Icon akan ditugaskan secara otomatis berdasarkan judul dan URL link.
                            Sistem akan memilih icon yang paling sesuai secara otomatis.
                        </p>
                    </div>
                </div>
                {{-- Preview existing icon (when editing) --}}
                @if(isset($link) && $link->icon_svg)
                <div class="mt-4 p-3 bg-white rounded-lg border border-sky-100 flex items-center justify-center">
                    <div class="text-center">
                        <p class="text-xs text-sky-600 mb-2">Icon yang akan digunakan:</p>
                        <div class="flex items-center justify-center">{!! $link->icon_svg !!}</div>
                    </div>
                </div>
                @endif
            </div>

            {{-- Urutan --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Urutan Tampilan <span class="text-red-500">*</span>
                </label>
                <input type="number" name="urutan" value="{{ old('urutan', isset($link) ? $link->urutan : 0) }}" min="0"
                       placeholder="0"
                       class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm
                              focus:outline-none focus:border-sky-400 focus:ring-2 focus:ring-sky-100 transition-colors
                              @error('urutan') border-red-300 @enderror">
                <p class="mt-1.5 text-xs text-gray-500">Angka lebih kecil akan ditampilkan lebih dulu (0, 1, 2, ...)</p>
                @error('urutan')
                    <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Status Aktif --}}
            <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-xl border border-gray-200">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" id="is_active" value="1"
                       {{ old('is_active', isset($link) ? $link->is_active : true) ? 'checked' : '' }}
                       class="w-5 h-5 text-sky-500 border-gray-300 rounded focus:ring-sky-500">
                <label for="is_active" class="text-sm font-medium text-gray-700 cursor-pointer">
                    Tampilkan di halaman publik (Aktif)
                </label>
            </div>

        </div>

        {{-- Action Buttons --}}
        <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100">
            <a href="{{ route('link-access.index') }}"
               class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-gray-100
                      hover:bg-gray-200 rounded-xl transition-colors">
                Batal
            </a>
            <button type="submit"
                    class="px-5 py-2.5 text-sm font-semibold text-white bg-sky-500
                           hover:bg-sky-600 rounded-xl transition-colors shadow-sm shadow-sky-200">
                {{ isset($link) ? 'Simpan Perubahan' : 'Tambah Link' }}
            </button>
        </div>

    </form>
</div>
@endsection


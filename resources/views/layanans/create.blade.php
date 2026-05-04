@extends('layouts.app')

@section('title', 'Tambah Layanan')

@section('page-header')
<div class="flex items-center gap-3">
    <a href="{{ route('layanans.index') }}" class="p-2 rounded-xl hover:bg-gray-100 text-gray-500 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
    </a>
    <div>
        <h1 class="text-xl font-bold text-gray-900">Tambah Layanan Perpustakaan</h1>
        <p class="text-[13px] text-gray-500 mt-0.5">Layanan baru akan tampil di section grid 4 kolom E-Perpus</p>
    </div>
</div>
@endsection

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-6">
            <form action="{{ route('layanans.store') }}" method="POST">
                @csrf

                {{-- Judul --}}
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Judul Layanan <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                           placeholder="cth: Layanan ISBN & QRCBN"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-sky-500/30 focus:border-sky-400 @error('title') border-red-400 @enderror">
                    @error('title') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Deskripsi</label>
                    <textarea name="description" rows="3" placeholder="Deskripsi singkat layanan..."
                              class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-sky-500/30 focus:border-sky-400 resize-none @error('description') border-red-400 @enderror">{{ old('description') }}</textarea>
                    @error('description') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Tipe Link --}}
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tipe Link <span class="text-red-500">*</span></label>
                    <div class="flex gap-4">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="link_type" value="external" {{ old('link_type', 'external') === 'external' ? 'checked' : '' }}
                                   class="text-sky-500 focus:ring-sky-400">
                            <span class="text-sm text-gray-700">Eksternal (buka di tab baru)</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="link_type" value="internal" {{ old('link_type') === 'internal' ? 'checked' : '' }}
                                   class="text-sky-500 focus:ring-sky-400">
                            <span class="text-sm text-gray-700">Internal (halaman sendiri)</span>
                        </label>
                    </div>
                    <p class="text-[12px] text-gray-400 mt-1">Eksternal: masukkan URL penuh (https://...). Internal: masukkan path relatif (/kegiatan, /jdih).</p>
                </div>

                {{-- URL --}}
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">URL / Link <span class="text-red-500">*</span></label>
                    <input type="text" name="url" value="{{ old('url') }}" required
                           placeholder="https://contoh.com atau /halaman"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-sky-500/30 focus:border-sky-400 @error('url') border-red-400 @enderror">
                    @error('url') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Icon SVG --}}
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Icon SVG</label>
                    <textarea name="icon_svg" rows="4" placeholder='<svg class="w-8 h-8" ...>...</svg>'
                              class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-xs font-mono focus:outline-none focus:ring-2 focus:ring-sky-500/30 focus:border-sky-400 resize-none">{{ old('icon_svg') }}</textarea>
                    <p class="text-[12px] text-gray-400 mt-1">Paste kode SVG dari heroicons.com. Gunakan class="w-8 h-8".</p>
                </div>

                {{-- Urutan & Status --}}
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nomor Urutan</label>
                        <input type="number" name="order_number" value="{{ old('order_number', 0) }}" min="0"
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-sky-500/30 focus:border-sky-400">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Status</label>
                        <div class="flex items-center h-[42px]">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                                       class="w-4 h-4 rounded text-sky-500 focus:ring-sky-400">
                                <span class="text-sm text-gray-700">Aktif (tampil di halaman)</span>
                            </label>
                        </div>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex gap-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('layanans.index') }}"
                       class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                            class="px-5 py-2.5 text-sm font-semibold text-white bg-sky-500 hover:bg-sky-600 rounded-xl transition-colors shadow-sm shadow-sky-200">
                        Simpan Layanan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

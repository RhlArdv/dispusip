@extends('layouts.app')

@section('title', 'Tambah Pengumuman')

@section('content')
<div class="p-4 sm:p-6 lg:p-8">
    <div class="sm:flex sm:items-center mb-8">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-bold text-gray-900 uppercase tracking-tight">Tambah Pengumuman</h1>
            <p class="mt-2 text-sm text-gray-700">Buat pengumuman atau himbauan baru.</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <form action="{{ route('pengumuman.store') }}" method="POST" class="p-6 md:p-8">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-900 mb-2">Tipe <span class="text-red-500">*</span></label>
                    <select name="tipe" required
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 transition-colors">
                        <option value="INFORMASI" {{ old('tipe') == 'INFORMASI' ? 'selected' : '' }}>INFORMASI</option>
                        <option value="HIMBAUAN" {{ old('tipe') == 'HIMBAUAN' ? 'selected' : '' }}>HIMBAUAN</option>
                        <option value="PENGUMUMAN" {{ old('tipe') == 'PENGUMUMAN' ? 'selected' : '' }}>PENGUMUMAN</option>
                    </select>
                    @error('tipe') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-900 mb-2">Judul <span class="text-red-500">*</span></label>
                    <input type="text" name="judul" value="{{ old('judul') }}" required
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 transition-colors"
                        placeholder="Masukkan judul pengumuman">
                    @error('judul') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-gray-900 mb-2">Isi Pengumuman <span class="text-red-500">*</span></label>
                    <textarea name="isi" rows="5" required
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 transition-colors"
                        placeholder="Tuliskan isi detail pengumuman...">{{ old('isi') }}</textarea>
                    @error('isi') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-gray-900 mb-2">Tautan (Opsional)</label>
                    <input type="url" name="tautan" value="{{ old('tautan') }}"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 transition-colors"
                        placeholder="https://example.com">
                    <p class="mt-1 text-xs text-gray-500">Gunakan format URL lengkap dengan http:// atau https://</p>
                    @error('tautan') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="pt-4 flex flex-col gap-4">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" class="sr-only peer" checked value="1">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-sky-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-sky-500"></div>
                        <span class="ml-3 text-sm font-medium text-gray-900">Aktifkan Pengumuman</span>
                    </label>

                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_pinned" class="sr-only peer" value="1">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-gold-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-gold-500"></div>
                        <span class="ml-3 text-sm font-medium text-gray-900">Sematkan di Atas (Pin)</span>
                    </label>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-100 flex items-center justify-end gap-3">
                <a href="{{ route('pengumuman.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 transition-colors">Batal</a>
                <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-sky-500 rounded-xl hover:bg-sky-600 transition-colors shadow-sm shadow-sky-100">Simpan Pengumuman</button>
            </div>
        </form>
    </div>
</div>
@endsection

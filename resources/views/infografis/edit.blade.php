@extends('layouts.app')

@section('title', 'Edit Infografis')

@section('page-header')
<div class="flex items-center gap-4 mb-6">
    <a href="{{ route('infografis.index') }}" 
       class="p-2 text-gray-400 hover:text-gray-900 hover:bg-gray-100 rounded-xl transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
    </a>
    <div>
        <h1 class="text-xl font-bold text-gray-900">Edit Infografis</h1>
        <p class="text-[13px] text-gray-500 mt-0.5">Ubah data infografis banner hero E-Perpus</p>
    </div>
</div>
@endsection

@section('content')
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <form action="{{ route('infografis.update', $infografi->id) }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-8">
        @csrf
        @method('PUT')

        <div class="max-w-2xl space-y-6">
            <!-- Judul -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Infografis</label>
                <input type="text" name="title" id="title" value="{{ old('title', $infografi->title) }}"
                       class="w-full rounded-xl border-gray-200 shadow-sm focus:border-sky-500 focus:ring-sky-500 sm:text-sm"
                       placeholder="Masukkan judul infografis..." required>
                @error('title')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Gambar -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Gambar Infografis Baru (Kosongkan jika tidak ingin mengubah)</label>
                
                @if($infografi->image)
                    <div class="mb-3">
                        <p class="text-xs text-gray-500 mb-2">Gambar saat ini:</p>
                        <img src="{{ Storage::url($infografi->image) }}" class="h-32 rounded-lg object-cover border border-gray-200">
                    </div>
                @endif
                
                <input type="file" name="image" id="image" accept="image/*"
                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100">
                @error('image')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-6">
                <!-- Urutan -->
                <div>
                    <label for="order" class="block text-sm font-medium text-gray-700 mb-1">Urutan Tampil</label>
                    <input type="number" name="order" id="order" value="{{ old('order', $infografi->order) }}" min="1"
                           class="w-full rounded-xl border-gray-200 shadow-sm focus:border-sky-500 focus:ring-sky-500 sm:text-sm" required>
                    @error('order')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status Publikasi</label>
                    <label class="inline-flex items-center cursor-pointer mt-2">
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', $infografi->is_active) ? 'checked' : '' }}>
                        <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-sky-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-sky-600"></div>
                        <span class="ms-3 text-sm font-medium text-gray-700">Tampilkan ke Publik</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-gray-100 flex gap-3">
            <button type="submit"
                    class="px-5 py-2.5 bg-sky-500 hover:bg-sky-600 text-white text-sm font-semibold rounded-xl transition-colors shadow-sm shadow-sky-200">
                Simpan Perubahan
            </button>
            <a href="{{ route('infografis.index') }}"
               class="px-5 py-2.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 text-sm font-semibold rounded-xl transition-colors">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection

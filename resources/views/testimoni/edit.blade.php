@extends('layouts.app')

@section('title', 'Edit Testimoni')

@section('page-header')
<div class="flex items-center gap-4">
    <a href="{{ route('testimoni.index') }}"
       class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-xl transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
    </a>
    <div>
        <h1 class="text-xl font-bold text-gray-900">Edit Testimoni</h1>
        <p class="text-[13px] text-gray-500 mt-0.5">Perbarui ulasan atau testimoni pemustaka</p>
    </div>
</div>
@endsection

@section('content')
<div class="max-w-3xl bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <form action="{{ route('testimoni.update', $testimoni->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="p-6 md:p-8 space-y-6">

            {{-- Judul Testimoni --}}
            <div>
                <label for="title" class="block text-sm font-semibold text-gray-700 mb-1.5">Judul Testimoni Video <span class="text-red-500">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title', $testimoni->title) }}" required
                       class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white transition-all outline-none @error('title') border-red-300 bg-red-50 @enderror"
                       placeholder="Masukkan judul testimoni (contoh: Review Fasilitas E-Perpus)">
                @error('title') <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p> @enderror
            </div>

            {{-- Link YouTube --}}
            <div>
                <label for="youtube_url" class="block text-sm font-semibold text-gray-700 mb-1.5">Link YouTube <span class="text-red-500">*</span></label>
                <input type="url" name="youtube_url" id="youtube_url" value="{{ old('youtube_url', $testimoni->youtube_url) }}" required
                       class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white transition-all outline-none @error('youtube_url') border-red-300 bg-red-50 @enderror"
                       placeholder="Contoh: https://www.youtube.com/watch?v=xxxx">
                <p class="text-xs text-gray-500 mt-1.5">Masukkan link video YouTube yang valid.</p>
                @error('youtube_url') <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p> @enderror
            </div>

            {{-- Is Active --}}
            <div class="pt-2">
                <label class="flex items-center gap-3 cursor-pointer group">
                    <div class="relative">
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', $testimoni->is_active) ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-500 transition-colors"></div>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-800">Tampilkan Testimoni</p>
                        <p class="text-xs text-gray-500">Testimoni akan terlihat di halaman landing E-Perpus</p>
                    </div>
                </label>
            </div>

        </div>

        <div class="px-6 md:px-8 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-end gap-3">
            <a href="{{ route('testimoni.index') }}"
               class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-200 hover:bg-gray-50 rounded-xl transition-colors">
                Batal
            </a>
            <button type="submit"
                    class="px-5 py-2.5 text-sm font-semibold text-white bg-indigo-500 hover:bg-indigo-600 rounded-xl transition-colors shadow-sm shadow-indigo-200">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>


@endsection

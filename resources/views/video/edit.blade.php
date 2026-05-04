@extends('layouts.app')

@section('title', 'Edit Video')

@section('page-header')
<div class="flex items-center gap-4">
    <a href="{{ route('video.index') }}"
       class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-xl transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
    </a>
    <div>
        <h1 class="text-xl font-bold text-gray-900">Edit Video</h1>
        <p class="text-[13px] text-gray-500 mt-0.5">Perbarui data video dan link YouTube</p>
    </div>
</div>
@endsection

@section('content')
<div class="max-w-2xl bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <form action="{{ route('video.update', $video) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="p-6 md:p-8 space-y-6">

            {{-- Judul Video --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Judul Video <span class="text-red-500">*</span>
                </label>
                <input type="text" name="judul_video" value="{{ old('judul_video', $video->judul_video) }}"
                       class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white transition-all outline-none"
                       placeholder="Contoh: Dokumentasi Kegiatan Literasi Sekolah">
                @error('judul_video') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            {{-- Current Video Preview --}}
            @if($video->youtube_id)
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Video Saat Ini</label>
                <div class="flex gap-4 p-4 bg-gray-50 rounded-xl border border-gray-200">
                    <div class="w-48 aspect-video rounded-lg overflow-hidden bg-black relative flex-shrink-0">
                        <img src="https://img.youtube.com/vi/{{ $video->youtube_id }}/mqdefault.jpg"
                             alt="{{ $video->judul_video }}"
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 flex items-center justify-center bg-black/20">
                            <svg class="w-12 h-12 text-white" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900 mb-2">{{ $video->judul_video }}</p>
                        <a href="{{ $video->youtube_url }}" target="_blank"
                           class="inline-flex items-center gap-1 text-xs text-indigo-600 hover:text-indigo-800 font-medium">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                            Buka di YouTube
                        </a>
                    </div>
                </div>
            </div>
            @endif

            {{-- YouTube URL --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Link YouTube <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-red-500" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                    </div>
                    <input type="url" name="youtube_url" value="{{ old('youtube_url', $video->youtube_url) }}"
                           class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white transition-all outline-none"
                           placeholder="https://www.youtube.com/watch?v=...">
                </div>
                <p class="text-xs text-gray-500 mt-1.5">Paste link YouTube lengkap. Contoh: https://www.youtube.com/watch?v=xxxxx atau https://youtu.be/xxxxx</p>
                @error('youtube_url') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Deskripsi</label>
                <textarea name="deskripsi" rows="4"
                          class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white transition-all outline-none resize-none"
                          placeholder="Jelaskan tentang video dokumentasi ini...">{{ old('deskripsi', $video->deskripsi) }}</textarea>
                @error('deskripsi') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            {{-- Status --}}
            <div class="pt-2 border-t border-gray-100">
                <label class="inline-flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', $video->is_active) ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-500 relative transition-colors"></div>
                    <span class="text-sm text-gray-700 font-medium">Aktif</span>
                </label>
                <p class="text-xs text-gray-500 mt-1 ml-14">Centang untuk menampilkan video ini di halaman publik</p>
            </div>

        </div>

        <div class="px-6 md:px-8 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-end gap-3">
            <a href="{{ route('video.index') }}"
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

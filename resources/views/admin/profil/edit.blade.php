@extends('layouts.app')

@section('title', 'Edit Profil Instansi')

@section('page-header')
<div class="flex items-center gap-4">
    <a href="{{ route('dashboard') }}"
       class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-xl transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
    </a>
    <div>
        <h1 class="text-xl font-bold text-gray-900">Edit Profil: {{ $data->title }}</h1>
        <p class="text-[13px] text-gray-500 mt-0.5">Edit konten untuk bagian {{ $data->title }}</p>
    </div>
</div>
@endsection

@section('content')
<div class="max-w-4xl bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <form action="{{ route('admin.profil.update', $data->id) }}" method="POST" id="form-profil" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="p-6 md:p-8 space-y-6">

            {{-- Info Halaman --}}
            <div class="flex items-center gap-3 p-4 bg-indigo-50 rounded-xl border border-indigo-100">
                <div class="w-9 h-9 rounded-lg bg-indigo-100 flex items-center justify-center text-indigo-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-indigo-800">{{ $data->title }}</p>
                    <p class="text-xs text-indigo-500">Preview Publik di: <a href="{{ route('profil.show', $data->slug) }}" target="_blank" class="underline hover:text-indigo-700">/profil/{{ $data->slug }}</a></p>
                </div>
            </div>

            {{-- Toggle Aktif --}}
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-100">
                <div>
                    <p class="text-sm font-semibold text-gray-700">Tampilkan di halaman publik</p>
                    <p class="text-xs text-gray-400">Jika dimatikan, bagian ini tidak akan dirender di landing page profil</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer group">
                    <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ $data->is_active ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-500 transition-colors"></div>
                </label>
            </div>

            {{-- Image Upload (Opsional, khusus halaman yang butuh gambar utama spt Struktur) --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Gambar Pendukung (Opsional)
                </label>
                @if($data->image)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $data->image) }}" class="h-32 object-contain rounded-lg border border-gray-200">
                    </div>
                @endif
                <input type="file" name="image" accept="image/*"
                       class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white transition-all outline-none">
                <p class="text-xs text-gray-500 mt-1.5">Bisa digunakan untuk gambar Struktur Organisasi. Format: JPG, PNG. Maks: 2MB.</p>
                @error('image')
                    <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Dynamic Fields Based on Slug --}}
            @if($data->slug === 'visi-dan-misi')
                {{-- Visi Field --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Visi <span class="text-red-500">*</span>
                    </label>
                    <div class="border border-gray-200 rounded-xl overflow-hidden @error('meta.visi') border-red-300 @enderror">
                        <textarea name="meta[visi]" id="content_visi" rows="5"
                                  class="w-full text-sm">{{ old('meta.visi', $data->meta['visi'] ?? '') }}</textarea>
                    </div>
                </div>
                {{-- Misi Field --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Misi (Gunakan List Berpoin/Bernomor) <span class="text-red-500">*</span>
                    </label>
                    <div class="border border-gray-200 rounded-xl overflow-hidden @error('content') border-red-300 @enderror">
                        <textarea name="content" id="content" rows="10"
                                  class="w-full text-sm">{{ old('content', $data->content) }}</textarea>
                    </div>
                </div>

            @elseif($data->slug === 'tupoksi')
                {{-- Tugas --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Tugas Pokok (Gunakan List Berpoin) <span class="text-red-500">*</span>
                    </label>
                    <div class="border border-gray-200 rounded-xl overflow-hidden @error('content') border-red-300 @enderror">
                        <textarea name="content" id="content" rows="10"
                                  class="w-full text-sm">{{ old('content', $data->content) }}</textarea>
                    </div>
                </div>

                {{-- Fungsi --}}
                <div class="mt-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Fungsi (Gunakan List Berpoin) <span class="text-red-500">*</span>
                    </label>
                    <div class="border border-gray-200 rounded-xl overflow-hidden @error('meta.fungsi') border-red-300 @enderror">
                        <textarea name="meta[fungsi]" id="content_fungsi" rows="10"
                                  class="w-full text-sm">{{ old('meta.fungsi', $data->meta['fungsi'] ?? '') }}</textarea>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Daftar fungsi ini akan otomatis disulap menjadi grid kartu di halaman publik.</p>
                </div>

                {{-- Link GDrive --}}
                <div class="mt-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Link Dokumen Pendukung (Google Drive) (Opsional)
                    </label>
                    <input type="url" name="meta[link_gdrive]" value="{{ old('meta.link_gdrive', $data->meta['link_gdrive'] ?? '') }}"
                           class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white transition-all outline-none"
                           placeholder="Contoh: https://drive.google.com/file/d/.../view">
                </div>

            @else
                {{-- Default Konten --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Konten <span class="text-red-500">*</span>
                    </label>
                    <div class="border border-gray-200 rounded-xl overflow-hidden @error('content') border-red-300 @enderror">
                        <textarea name="content" id="content" rows="15"
                                  class="w-full text-sm">{{ old('content', $data->content) }}</textarea>
                    </div>
                    @error('content')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            @endif

        </div>

        <div class="px-6 md:px-8 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-end gap-3">
            <a href="#" onclick="window.history.back()"
               class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-200 hover:bg-gray-50 rounded-xl transition-colors">
                Kembali
            </a>
            <button type="submit"
                    class="px-5 py-2.5 text-sm font-semibold text-white bg-indigo-500 hover:bg-indigo-600 rounded-xl transition-colors shadow-sm shadow-indigo-200 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
<script>
    const editorConfig = {
        toolbar: {
            items: [
                'heading', '|',
                'bold', 'italic', 'underline', 'link', '|',
                'bulletedList', 'numberedList', '|',
                'outdent', 'indent', '|',
                'blockQuote', 'insertTable', '|',
                'imageUpload', 'mediaEmbed', '|',
                'undo', 'redo'
            ]
        },
        language: 'id',
        placeholder: 'Tulis konten profil di sini. Gunakan format yang rapi.'
    };

    // Main Content Editor
    if (document.querySelector('#content')) {
        ClassicEditor
            .create(document.querySelector('#content'), editorConfig)
            .then(editor => {
                document.getElementById('form-profil').addEventListener('submit', function () {
                    document.querySelector('#content').value = editor.getData();
                });
            })
            .catch(error => console.error('CKEditor error:', error));
    }

    // Visi Editor
    if (document.querySelector('#content_visi')) {
        ClassicEditor
            .create(document.querySelector('#content_visi'), editorConfig)
            .then(editor => {
                document.getElementById('form-profil').addEventListener('submit', function () {
                    document.querySelector('#content_visi').value = editor.getData();
                });
            })
            .catch(error => console.error(error));
    }

    // Fungsi Editor
    if (document.querySelector('#content_fungsi')) {
        ClassicEditor
            .create(document.querySelector('#content_fungsi'), editorConfig)
            .then(editor => {
                document.getElementById('form-profil').addEventListener('submit', function () {
                    document.querySelector('#content_fungsi').value = editor.getData();
                });
            })
            .catch(error => console.error(error));
    }
</script>
@endpush

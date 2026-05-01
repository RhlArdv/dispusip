@extends('layouts.app')

@section('title', 'Edit Profil E-Perpus: ' . $data->title)

@section('page-header')
<div class="flex items-center gap-4">
    <a href="{{ route('dashboard') }}"
       class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-xl transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
    </a>
    <div>
        <h1 class="text-xl font-bold text-gray-900">Profil E-Perpus: {{ $data->title }}</h1>
        <p class="text-[13px] text-gray-500 mt-0.5">Edit konten untuk bagian {{ $data->title }}</p>
    </div>
</div>
@endsection

@section('content')
<div class="max-w-4xl bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <form action="{{ route('admin.profil-perpustakaan.update', $data->id) }}" method="POST" id="form-profil-perpus" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="p-6 md:p-8 space-y-6">

            {{-- Info Halaman --}}
            <div class="flex items-center gap-3 p-4 bg-emerald-50 rounded-xl border border-emerald-100">
                <div class="w-9 h-9 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-emerald-800">{{ $data->title }}</p>
                    <p class="text-xs text-emerald-500">Preview Publik di: <a href="{{ route('eperpus.profil') }}" target="_blank" class="underline hover:text-emerald-700">/e-perpus/profil</a></p>
                </div>
            </div>

            {{-- Toggle Aktif --}}
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-100">
                <div>
                    <p class="text-sm font-semibold text-gray-700">Tampilkan di halaman publik</p>
                    <p class="text-xs text-gray-400">Jika dimatikan, bagian ini tidak akan dirender di halaman Profil E-Perpus</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer group">
                    <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ $data->is_active ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500 transition-colors"></div>
                </label>
            </div>

            {{-- Image Upload --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Gambar Pendukung (Opsional)
                    <span class="font-normal text-gray-400 ml-1">— Digunakan untuk foto Struktur Organisasi, dsb.</span>
                </label>
                @if($data->image)
                    <div class="mb-4 relative w-fit group">
                        <img src="{{ asset('storage/' . $data->image) }}" class="h-40 object-contain rounded-xl border border-gray-200">
                        <span class="absolute top-2 right-2 px-2 py-0.5 bg-emerald-500 text-white text-[10px] font-bold rounded-full">Aktif</span>
                    </div>
                @endif
                <input type="file" name="image" accept="image/*"
                       class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 focus:bg-white transition-all outline-none">
                <p class="text-xs text-gray-500 mt-1.5">Format: JPG, PNG, WebP. Maks: 4MB.</p>
                @error('image')
                    <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Main Content --}}
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

        </div>

        <div class="px-6 md:px-8 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-end gap-3">
            <a href="{{ route('eperpus.profil') }}" target="_blank"
               class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-200 hover:bg-gray-50 rounded-xl transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                Preview Halaman
            </a>
            <button type="submit"
                    class="px-5 py-2.5 text-sm font-semibold text-white bg-emerald-500 hover:bg-emerald-600 rounded-xl transition-colors shadow-sm shadow-emerald-200 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
<script>
    if (document.querySelector('#content')) {
        ClassicEditor
            .create(document.querySelector('#content'), {
                toolbar: {
                    items: [
                        'heading', '|',
                        'bold', 'italic', 'underline', 'link', '|',
                        'bulletedList', 'numberedList', '|',
                        'outdent', 'indent', '|',
                        'blockQuote', 'insertTable', '|',
                        'undo', 'redo'
                    ]
                },
                language: 'id',
                placeholder: 'Tulis konten di sini...'
            })
            .then(editor => {
                document.getElementById('form-profil-perpus').addEventListener('submit', function () {
                    document.querySelector('#content').value = editor.getData();
                });
            })
            .catch(error => console.error('CKEditor error:', error));
    }
</script>
@endpush

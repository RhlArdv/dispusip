@extends('layouts.app')

@section('title', 'Tambah Berita')

@section('page-header')
<div class="flex items-center justify-between flex-wrap gap-3">
    <div>
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-1">
            <a href="{{ route('berita.index') }}" class="hover:text-sky-600 transition-colors">Berita</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span>Tambah Berita</span>
        </div>
        <h1 class="text-xl font-bold text-gray-900">Tambah Berita Baru</h1>
    </div>
</div>
@endsection

@section('content')
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm">
    <form method="POST" action="{{ route('berita.store') }}" id="form-berita" enctype="multipart/form-data" class="p-6">
        @csrf

        <div class="space-y-5">

            {{-- Judul Berita --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Judul Berita <span class="text-red-500">*</span>
                </label>
                <input type="text" name="judul_berita" value="{{ old('judul_berita') }}"
                       placeholder="Masukkan judul berita..."
                       class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm
                              focus:outline-none focus:border-sky-400 focus:ring-2 focus:ring-sky-100 transition-colors
                              @error('judul_berita') border-red-300 @enderror">
                @error('judul_berita')
                    <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Thumbnail --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Thumbnail Gambar
                </label>
                <div class="border-2 border-dashed border-gray-200 rounded-xl p-6 hover:border-sky-300 transition-colors">
                    <div class="text-center">
                        <input type="file" name="thumbnail" id="thumbnail" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                               class="hidden" @error('thumbnail') border-red-300 @enderror
                               onchange="previewThumbnail(this)">

                        <label for="thumbnail"
                               class="cursor-pointer inline-flex flex-col items-center gap-2">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-sm text-gray-600 font-medium">Klik untuk upload thumbnail</span>
                            <span class="text-xs text-gray-400">JPEG, PNG, JPG, GIF, Webp (Max 2MB)</span>
                        </label>

                        {{-- Preview Image --}}
                        <div id="thumbnail-preview" class="hidden mt-4">
                            <img src="" alt="Preview" class="max-h-48 mx-auto rounded-lg shadow-sm">
                            <button type="button" onclick="removeThumbnail()"
                                    class="mt-3 text-xs text-red-500 hover:text-red-700 font-medium">
                                Hapus Gambar
                            </button>
                        </div>
                    </div>
                </div>
                @error('thumbnail')
                    <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Isi Berita --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Isi Berita <span class="text-red-500">*</span>
                </label>
                <textarea name="isi_berita" id="isi_berita" rows="15"
                          placeholder="Tulis isi berita di sini..."
                          class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm
                                 focus:outline-none focus:border-sky-400 focus:ring-2 focus:ring-sky-100 transition-colors
                                 @error('isi_berita') border-red-300 @enderror">{{ old('isi_berita') }}</textarea>
                @error('isi_berita')
                    <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

        </div>

        <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100">
            <a href="{{ route('berita.index') }}"
               class="px-6 py-3 text-sm font-medium text-gray-700 bg-gray-100
                      hover:bg-gray-200 rounded-xl transition-colors">
                Batal
            </a>
            <button type="submit"
                    class="px-6 py-3 text-sm font-semibold text-white bg-sky-500
                           hover:bg-sky-600 rounded-xl transition-colors shadow-sm">
                Simpan Berita
            </button>
        </div>

    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
<script>
    let myEditor;

    ClassicEditor
        .create(document.querySelector('#isi_berita'), {
            toolbar: {
                items: [
                    'heading', '|',
                    'bold', 'italic', 'link', '|',
                    'bulletedList', 'numberedList', '|',
                    'outdent', 'indent', '|',
                    'blockQuote', 'insertTable', '|',
                    'undo', 'redo'
                ]
            },
            language: 'id',
            placeholder: 'Tulis isi berita di sini...'
        })
        .then(editor => {
            myEditor = editor;

            // Sync editor content ke textarea sebelum submit
            document.getElementById('form-berita').addEventListener('submit', function(e) {
                const textarea = document.querySelector('#isi_berita');
                textarea.value = myEditor.getData();
            });
        })
        .catch(error => {
            console.error('CKEditor initialization error:', error);
        });

    // Thumbnail preview functions
    function previewThumbnail(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('thumbnail-preview').classList.remove('hidden');
                document.querySelector('#thumbnail-preview img').src = e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function removeThumbnail() {
        const input = document.getElementById('thumbnail');
        input.value = '';
        document.getElementById('thumbnail-preview').classList.add('hidden');
        document.querySelector('#thumbnail-preview img').src = '';
    }
</script>
@endpush

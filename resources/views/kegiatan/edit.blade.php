@extends('layouts.app')

@section('title', 'Edit Kegiatan')

@section('page-header')
<div class="flex items-center justify-between flex-wrap gap-3">
    <div>
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-1">
            <a href="{{ route('kegiatan.index') }}" class="hover:text-sky-600 transition-colors">Kegiatan</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span>Edit Kegiatan</span>
        </div>
        <h1 class="text-xl font-bold text-gray-900">Edit Kegiatan</h1>
    </div>
</div>
@endsection

@section('content')
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm">
    <form method="POST" action="{{ route('kegiatan.update', $kegiatan->id) }}" id="form-kegiatan" enctype="multipart/form-data" class="p-6">
        @csrf
        @method('PUT')

        <div class="space-y-5">

            {{-- Judul Kegiatan --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Judul Kegiatan <span class="text-red-500">*</span>
                </label>
                <input type="text" name="title" value="{{ old('title', $kegiatan->title) }}"
                       placeholder="Masukkan judul kegiatan..."
                       class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm
                              focus:outline-none focus:border-sky-400 focus:ring-2 focus:ring-sky-100 transition-colors
                              @error('title') border-red-300 @enderror">
                @error('title')
                    <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Foto Kegiatan --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Foto Kegiatan <span class="text-gray-400 text-xs">(Opsional)</span>
                </label>
                <div class="border-2 border-dashed border-gray-200 rounded-xl p-6 hover:border-sky-300 transition-colors">
                    <div class="text-center">
                        <input type="file" name="foto" id="foto"
                               accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                               class="hidden" onchange="previewFoto(this)">

                        <label for="foto" class="cursor-pointer inline-flex flex-col items-center gap-2">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-sm text-gray-600 font-medium">Klik untuk ganti foto</span>
                            <span class="text-xs text-gray-400">JPEG, PNG, JPG, GIF, Webp (Max 2MB)</span>
                        </label>

                        {{-- Preview Image --}}
                        <div id="foto-preview" class="mt-4 @if($kegiatan->foto) @else hidden @endif">
                            <img src="{{ $kegiatan->foto ? asset($kegiatan->foto) : '' }}"
                                 alt="Preview"
                                 class="max-h-48 mx-auto rounded-lg shadow-sm">
                            <button type="button" onclick="removeFoto()"
                                    class="mt-3 text-xs text-red-500 hover:text-red-700 font-medium">
                                Hapus Gambar
                            </button>
                        </div>
                    </div>
                </div>
                @error('foto')
                    <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Isi Kegiatan --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Isi Kegiatan <span class="text-red-500">*</span>
                </label>
                <textarea name="content" id="content" rows="15"
                          placeholder="Tulis isi kegiatan di sini..."
                          class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm
                                 focus:outline-none focus:border-sky-400 focus:ring-2 focus:ring-sky-100 transition-colors
                                 @error('content') border-red-300 @enderror">{{ old('content', $kegiatan->content) }}</textarea>
                @error('content')
                    <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

        </div>

        <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100">
            <a href="{{ route('kegiatan.index') }}"
               class="px-6 py-3 text-sm font-medium text-gray-700 bg-gray-100
                      hover:bg-gray-200 rounded-xl transition-colors">
                Batal
            </a>
            <button type="submit"
                    class="px-6 py-3 text-sm font-semibold text-white bg-sky-500
                           hover:bg-sky-600 rounded-xl transition-colors shadow-sm">
                Simpan Perubahan
            </button>
        </div>

    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
<script>
    let myEditor;
    const initialData = @json($kegiatan->content);

    ClassicEditor
        .create(document.querySelector('#content'), {
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
            placeholder: 'Tulis isi kegiatan di sini...',
            initialData: initialData
        })
        .then(editor => {
            myEditor = editor;

            // Sync editor content ke textarea sebelum submit
            document.getElementById('form-kegiatan').addEventListener('submit', function(e) {
                const textarea = document.querySelector('#content');
                textarea.value = myEditor.getData();
            });
        })
        .catch(error => {
            console.error('CKEditor initialization error:', error);
        });

    // Preview foto functions
    function previewFoto(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('foto-preview').classList.remove('hidden');
                document.querySelector('#foto-preview img').src = e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function removeFoto() {
        const input = document.getElementById('foto');
        input.value = '';
        document.getElementById('foto-preview').classList.add('hidden');
        document.querySelector('#foto-preview img').src = '';
    }
</script>
@endpush

@extends('layouts.app')

@section('title', 'Tambah Buku')

@push('styles')
<style>
    .ck-editor__editable {
        min-height: 200px;
    }
    .ck.ck-editor {
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
    }
    .ck.ck-editor__main .ck-editor__editable {
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
</style>
@endpush

@section('content')
<div class="p-6 lg:p-8">
    {{-- Header --}}
    <div class="mb-6">
        <div class="flex items-center gap-3 text-sm text-gray-500 mb-4">
            <a href="{{ route('buku.index') }}" class="hover:text-indigo-600">Buku</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span>Tambah</span>
        </div>
        <h1 class="text-xl font-bold text-gray-900">Tambah Buku Baru</h1>
    </div>

    {{-- Form --}}
    <div class="max-w-4xl">
        <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-sm border border-gray-100">
            @csrf

            <div class="p-6 lg:p-8 space-y-6">
                {{-- Judul --}}
                <div>
                    <label for="judul" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Judul Buku <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           id="judul"
                           name="judul"
                           value="{{ old('judul') }}"
                           required
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                           placeholder="Masukkan judul buku lengkap">
                    @error('judul')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Penulis --}}
                    <div>
                        <label for="penulis" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Penulis
                        </label>
                        <input type="text"
                               id="penulis"
                               name="penulis"
                               value="{{ old('penulis') }}"
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                               placeholder="Nama penulis, pisahkan dengan koma">
                        @error('penulis')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Penerbit --}}
                    <div>
                        <label for="penerbit" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Penerbit
                        </label>
                        <input type="text"
                               id="penerbit"
                               name="penerbit"
                               value="{{ old('penerbit') }}"
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                               placeholder="Nama penerbit">
                        @error('penerbit')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    {{-- Tahun Terbit --}}
                    <div>
                        <label for="tahun_terbit" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Tahun Terbit
                        </label>
                        <input type="number"
                               id="tahun_terbit"
                               name="tahun_terbit"
                               value="{{ old('tahun_terbit') }}"
                               min="1000"
                               max="9999"
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                               placeholder="Contoh: 2019">
                        @error('tahun_terbit')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- ISBN --}}
                    <div>
                        <label for="isbn" class="block text-sm font-medium text-gray-700 mb-1.5">
                            ISBN / ISSN
                        </label>
                        <input type="text"
                               id="isbn"
                               name="isbn"
                               value="{{ old('isbn') }}"
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                               placeholder="ISBN atau ISSN">
                        @error('isbn')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Kategori --}}
                    <div>
                        <label for="kategori_buku_id" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Kategori Buku
                        </label>
                        <select id="kategori_buku_id"
                                name="kategori_buku_id"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                            <option value="">Pilih Kategori</option>
                            @foreach($kategoriBuku as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                            @endforeach
                        </select>
                        @error('kategori_buku_id')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Sumber --}}
                <div>
                    <label for="sumber" class="block text-sm font-medium text-gray-700 mb-1.5">
                        URL Sumber <span class="text-gray-400 font-normal">(OPAC Perpusnas, dll)</span>
                    </label>
                    <input type="url"
                           id="sumber"
                           name="sumber"
                           value="{{ old('sumber') }}"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                           placeholder="https://opac.perpusnas.go.id/...">
                    @error('sumber')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Abstrak --}}
                <div>
                    <label for="abstrak" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Abstrak
                    </label>
                    <textarea id="abstrak"
                              name="abstrak"
                              rows="3"
                              class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                              placeholder="Ringkasan singkat buku">{{ old('abstrak') }}</textarea>
                    @error('abstrak')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Uraian --}}
                <div>
                    <label for="uraian" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Uraian / Deskripsi Lengkap
                    </label>
                    <textarea id="uraian"
                              name="uraian"
                              rows="6"
                              class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">{{ old('uraian') }}</textarea>
                    @error('uraian')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Upload Sampul & PDF --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Sampul --}}
                    <div>
                        <label for="sampul" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Sampul Buku <span class="text-gray-400 font-normal">(Maks 2MB)</span>
                        </label>
                        <div class="relative">
                            <input type="file"
                                   id="sampul"
                                   name="sampul"
                                   accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            @error('sampul')
                                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div id="sampulPreview" class="mt-3 hidden">
                            <img src="" alt="Preview" class="w-32 h-40 object-cover rounded-lg shadow-md">
                        </div>
                    </div>

                    {{-- File PDF --}}
                    <div>
                        <label for="file_pdf" class="block text-sm font-medium text-gray-700 mb-1.5">
                            File PDF <span class="text-gray-400 font-normal">(Opsional, Maks 10MB)</span>
                        </label>
                        <div class="relative">
                            <input type="file"
                                   id="file_pdf"
                                   name="file_pdf"
                                   accept=".pdf"
                                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
                            @error('file_pdf')
                                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <p class="mt-2 text-xs text-gray-500">
                            <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            PDF akan bisa dibaca di halaman detail buku
                        </p>
                    </div>
                </div>

                {{-- Status Publish --}}
                <div>
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="is_published" value="1" checked
                               class="w-5 h-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <span class="text-sm font-medium text-gray-700">Terbitkan segera (Published)</span>
                    </label>
                </div>
            </div>

            {{-- Footer Actions --}}
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 rounded-b-2xl flex items-center justify-end gap-3">
                <a href="{{ route('buku.index') }}"
                   class="px-5 py-2.5 text-sm font-medium text-gray-700 hover:text-gray-900 transition-colors">
                    Batal
                </a>
                <button type="submit"
                        class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-xl transition-colors shadow-sm">
                    Simpan Buku
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize CKEditor
    ClassicEditor
        .create(document.querySelector('#uraian'), {
            toolbar: [
                'heading', '|',
                'bold', 'italic', 'underline', 'link', '|',
                'bulletedList', 'numberedList', '|',
                'insertTable', 'blockQuote', 'imageUpload', '|',
                'undo', 'redo'
            ],
            language: 'id',
            placeholder: 'Tulis uraian atau deskripsi lengkap buku di sini...'
        })
        .catch(error => {
            console.error(error);
        });

    // Preview sampul
    document.getElementById('sampul').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('sampulPreview');
                preview.classList.remove('hidden');
                preview.querySelector('img').src = e.target.result;
            }
            reader.readAsDataURL(file);
        } else {
            document.getElementById('sampulPreview').classList.add('hidden');
        }
    });
});
</script>
@endpush
@endsection

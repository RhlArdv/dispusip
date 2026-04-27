@extends('layouts.app')

@section('title', 'Edit Koleksi')

@section('page-header')
<div class="flex items-center justify-between flex-wrap gap-3">
    <div>
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-1">
            <a href="{{ route('koleksi.index') }}" class="hover:text-sky-600 transition-colors">Koleksi</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span>Edit Koleksi</span>
        </div>
        <h1 class="text-xl font-bold text-gray-900">Edit Koleksi</h1>
    </div>
</div>
@endsection

@section('content')
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm">
    <form method="POST" action="{{ route('koleksi.update', $koleksi->id) }}" id="form-koleksi" enctype="multipart/form-data" class="p-6">
        @csrf
        @method('PUT')

        <div class="space-y-5">

            {{-- Judul Koleksi --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Judul Koleksi <span class="text-red-500">*</span>
                </label>
                <input type="text" name="judul_koleksi2" value="{{ old('judul_koleksi2', $koleksi->judul_koleksi2) }}"
                       placeholder="Masukkan judul koleksi..."
                       class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm
                              focus:outline-none focus:border-sky-400 focus:ring-2 focus:ring-sky-100 transition-colors
                              @error('judul_koleksi2') border-red-300 @enderror">
                @error('judul_koleksi2')
                    <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Kategori --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Kategori <span class="text-red-500">*</span>
                </label>
                <select name="kategori"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm
                               focus:outline-none focus:border-sky-400 focus:ring-2 focus:ring-sky-100 transition-colors
                               @error('kategori') border-red-300 @enderror">
                    <option value="">-- Pilih Kategori --</option>
                    <option value="1" {{ old('kategori', $koleksi->kategori) == '1' ? 'selected' : '' }}>Koleksi Terbaru</option>
                    <option value="2" {{ old('kategori', $koleksi->kategori) == '2' ? 'selected' : '' }}>Koleksi Populer</option>
                    <option value="3" {{ old('kategori', $koleksi->kategori) == '3' ? 'selected' : '' }}>Koleksi Referensi</option>
                    <option value="4" {{ old('kategori', $koleksi->kategori) == '4' ? 'selected' : '' }}>Informasi Terkini</option>
                </select>
                @error('kategori')
                    <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Foto Koleksi --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Foto Koleksi <span class="text-red-500">*</span>
                </label>
                <div class="border-2 border-dashed border-gray-200 rounded-xl p-6 text-center hover:border-sky-300 transition-colors">
                    <input type="file" name="foto_koleksi2" id="foto_koleksi2"
                           accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                           class="hidden" onchange="previewImage(this)">
                    <label for="foto_koleksi2" class="cursor-pointer">
                        <div id="preview-container">
                            @if($koleksi->foto_koleksi2)
                                <img id="image-preview" src="{{ asset($koleksi->foto_koleksi2) }}" alt="Current" class="max-h-64 mx-auto rounded-lg shadow-sm mb-3">
                            @else
                                <div id="upload-placeholder" class="hidden">
                                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <p class="text-sm text-gray-600 font-medium">Klik untuk upload foto</p>
                                    <p class="text-xs text-gray-400 mt-1">JPEG, PNG, JPG, GIF, atau Webp (Maks 2MB)</p>
                                </div>
                            @endif
                            @if($koleksi->foto_koleksi2)
                                <button type="button" onclick="removeImage()"
                                        class="text-sm text-red-600 hover:text-red-700 font-medium">
                                    Ganti Gambar
                                </button>
                            @endif
                        </div>
                        @if(!$koleksi->foto_koleksi2)
                        <div id="upload-placeholder">
                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="text-sm text-gray-600 font-medium">Klik untuk upload foto</p>
                            <p class="text-xs text-gray-400 mt-1">JPEG, PNG, JPG, GIF, atau Webp (Maks 2MB)</p>
                        </div>
                        @endif
                    </label>
                </div>
                @error('foto_koleksi2')
                    <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Link (Optional) --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Link <span class="text-gray-400 text-xs">(Opsional)</span>
                </label>
                <input type="url" name="link" value="{{ old('link', $koleksi->link) }}"
                       placeholder="https://example.com"
                       class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm
                              focus:outline-none focus:border-sky-400 focus:ring-2 focus:ring-sky-100 transition-colors
                              @error('link') border-red-300 @enderror">
                @error('link')
                    <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Isi Koleksi (Optional) --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Isi Koleksi <span class="text-gray-400 text-xs">(Opsional)</span>
                </label>
                <textarea name="isi_koleksi" rows="6"
                          placeholder="Tulis deskripsi atau isi koleksi di sini..."
                          class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm
                                 focus:outline-none focus:border-sky-400 focus:ring-2 focus:ring-sky-100 transition-colors
                                 @error('isi_koleksi') border-red-300 @enderror">{{ old('isi_koleksi', $koleksi->isi_koleksi) }}</textarea>
                @error('isi_koleksi')
                    <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

        </div>

        <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100">
            <a href="{{ route('koleksi.index') }}"
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
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('image-preview').src = e.target.result;
                document.getElementById('preview-container').classList.remove('hidden');
                document.getElementById('upload-placeholder')?.classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function removeImage() {
        document.getElementById('foto_koleksi2').value = '';
        document.getElementById('image-preview').src = '';
        document.getElementById('preview-container').classList.add('hidden');
        const placeholder = document.getElementById('upload-placeholder');
        if (placeholder) placeholder.classList.remove('hidden');
    }
</script>
@endpush

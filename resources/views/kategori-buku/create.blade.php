@extends('layouts.app')

@section('title', 'Tambah Kategori Buku')

@section('content')
<div class="p-6 lg:p-8">
    {{-- Header --}}
    <div class="mb-6">
        <div class="flex items-center gap-3 text-sm text-gray-500 mb-4">
            <a href="{{ route('kategori-buku.index') }}" class="hover:text-indigo-600">Kategori Buku</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span>Tambah</span>
        </div>
        <h1 class="text-xl font-bold text-gray-900">Tambah Kategori Buku</h1>
    </div>

    {{-- Form --}}
    <div class="max-w-2xl">
        <form action="{{ route('kategori-buku.store') }}" method="POST" class="bg-white rounded-2xl shadow-sm border border-gray-100">
            @csrf

            <div class="p-6 lg:p-8 space-y-6">
                {{-- Nama --}}
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Nama Kategori <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           id="nama"
                           name="nama"
                           value="{{ old('nama') }}"
                           required
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                           placeholder="Contoh: Fiksi, Non-Fiksi, Anak">
                    @error('nama')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Slug --}}
                <div>
                    <label for="slug" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Slug <span class="text-gray-400 font-normal">(opsional, auto-generate dari nama)</span>
                    </label>
                    <input type="text"
                           id="slug"
                           name="slug"
                           value="{{ old('slug') }}"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                           placeholder="Contoh: fiksi, non-fiksi, anak">
                    @error('slug')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Deskripsi
                    </label>
                    <textarea id="deskripsi"
                              name="deskripsi"
                              rows="3"
                              class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                              placeholder="Deskripsi singkat tentang kategori ini">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Urutan & Status --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="urutan" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Urutan
                        </label>
                        <input type="number"
                               id="urutan"
                               name="urutan"
                               value="{{ old('urutan', 0) }}"
                               min="0"
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                        @error('urutan')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="is_active" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Status
                        </label>
                        <select id="is_active"
                                name="is_active"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Footer Actions --}}
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 rounded-b-2xl flex items-center justify-end gap-3">
                <a href="{{ route('kategori-buku.index') }}"
                   class="px-5 py-2.5 text-sm font-medium text-gray-700 hover:text-gray-900 transition-colors">
                    Batal
                </a>
                <button type="submit"
                        class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-xl transition-colors shadow-sm">
                    Simpan Kategori
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

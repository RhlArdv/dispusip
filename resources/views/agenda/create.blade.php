@extends('layouts.app')

@section('content')
<div class="p-4 sm:p-6 lg:p-8">
    <div class="mb-8">
        <a href="{{ route('agenda.index') }}" class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-gray-700 mb-4 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar
        </a>
        <h1 class="text-2xl font-bold text-gray-900">Tambah Agenda</h1>
        <p class="mt-2 text-sm text-gray-700">Tambahkan informasi agenda dinas baru.</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden max-w-4xl">
        <form action="{{ route('agenda.store') }}" method="POST" class="p-6 sm:p-8">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-gray-900 mb-2">Judul Agenda <span class="text-red-500">*</span></label>
                    <input type="text" name="judul" value="{{ old('judul') }}" required
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 transition-colors"
                        placeholder="Contoh: Rapat Koordinasi Tahunan">
                    @error('judul') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-900 mb-2">Tanggal Mulai <span class="text-red-500">*</span></label>
                    <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" required
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 transition-colors">
                    @error('tanggal_mulai') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-900 mb-2">Tanggal Selesai (Opsional)</label>
                    <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 transition-colors">
                    <p class="mt-1 text-xs text-gray-500">Kosongkan jika agenda hanya berlangsung 1 hari.</p>
                    @error('tanggal_selesai') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-900 mb-2">Jam Agenda <span class="text-red-500">*</span></label>
                    <input type="text" name="jam_agenda" value="{{ old('jam_agenda') }}" required
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 transition-colors"
                        placeholder="Contoh: 08:00 - Selesai">
                    @error('jam_agenda') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-900 mb-2">Tempat <span class="text-red-500">*</span></label>
                    <input type="text" name="tempat" value="{{ old('tempat') }}" required
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 transition-colors"
                        placeholder="Contoh: Aula Dinas">
                    @error('tempat') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-900 mb-2">Penyelenggara (Opsional)</label>
                    <input type="text" name="penyelenggara" value="{{ old('penyelenggara') }}"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 transition-colors"
                        placeholder="Contoh: Bidang Kearsipan">
                    @error('penyelenggara') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-900 mb-2">Narahubung (Opsional)</label>
                    <input type="text" name="narahubung" value="{{ old('narahubung') }}"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 transition-colors"
                        placeholder="Contoh: Budi (08123456789)">
                    @error('narahubung') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-gray-900 mb-2">Deskripsi Agenda <span class="text-red-500">*</span></label>
                    <textarea name="deskripsi" rows="5" required
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 transition-colors"
                        placeholder="Tuliskan deksripsi detail mengenai agenda ini...">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2 pt-4">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" class="sr-only peer" checked value="1">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-sky-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-sky-500"></div>
                        <span class="ml-3 text-sm font-medium text-gray-900">Tampilkan di Halaman Publik</span>
                    </label>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-100 flex items-center justify-end gap-3">
                <a href="{{ route('agenda.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 transition-colors">Batal</a>
                <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-sky-500 rounded-xl hover:bg-sky-600 transition-colors shadow-sm shadow-sky-100">Simpan Agenda</button>
            </div>
        </form>
    </div>
</div>
@endsection

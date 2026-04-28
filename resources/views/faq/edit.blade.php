@extends('layouts.app')

@section('title', 'Edit FAQ')

@section('page-header')
<div class="flex items-center justify-between flex-wrap gap-3">
    <div>
        <h1 class="text-xl font-bold text-gray-900">Edit FAQ</h1>
        <p class="text-[13px] text-gray-500 mt-0.5">Ubah pertanyaan atau jawaban FAQ</p>
    </div>
    <a href="{{ route('faq.index') }}"
       class="flex items-center gap-2 px-4 py-2.5 bg-white hover:bg-gray-50 border border-gray-200
              text-gray-700 text-sm font-semibold rounded-xl transition-colors shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Kembali
    </a>
</div>
@endsection

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <form action="{{ route('faq.update', $faq->id) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="space-y-6">
                <!-- Pertanyaan -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Pertanyaan <span class="text-red-500">*</span></label>
                    <input type="text" name="pertanyaan" value="{{ old('pertanyaan', $faq->pertanyaan) }}" required
                           class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 transition-all text-sm">
                    @error('pertanyaan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jawaban -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Jawaban <span class="text-red-500">*</span></label>
                    <textarea name="jawaban" required rows="4"
                              class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 transition-all text-sm">{{ old('jawaban', $faq->jawaban) }}</textarea>
                    @error('jawaban')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status Aktif -->
                <div class="flex items-center gap-3">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ $faq->is_active ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-sky-500"></div>
                        <span class="ml-3 text-sm font-medium text-gray-700">Aktifkan Tampilan di Website</span>
                    </label>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end">
                <button type="submit"
                        class="px-6 py-2.5 bg-sky-500 hover:bg-sky-600 text-white text-sm font-semibold rounded-xl transition-colors shadow-sm shadow-sky-200">
                    Perbarui FAQ
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

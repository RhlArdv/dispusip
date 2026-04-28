@extends('layouts.app')

@section('title', 'Pengaturan Aplikasi')

@section('page-header')
<div class="flex items-center justify-between flex-wrap gap-3">
    <div>
        <h1 class="text-xl font-bold text-gray-900">Pengaturan Aplikasi</h1>
        <p class="text-[13px] text-gray-500 mt-0.5">Atur informasi kontak dan Google Maps embed</p>
    </div>
</div>
@endsection

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <form action="{{ route('settings.update') }}" method="POST" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="space-y-8">
                <!-- Kontak Information -->
                <div>
                    <h2 class="text-lg font-bold text-gray-900 mb-4 border-b pb-2">Informasi Kontak</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Alamat Email</label>
                            <input type="email" name="contact_email" value="{{ old('contact_email', $settings['contact']['contact_email']->value ?? '') }}"
                                   class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 transition-all text-sm"
                                   placeholder="Contoh: info@dispusip.padang.go.id">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Nomor Telepon / WhatsApp</label>
                            <input type="text" name="contact_phone" value="{{ old('contact_phone', $settings['contact']['contact_phone']->value ?? '') }}"
                                   class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 transition-all text-sm"
                                   placeholder="Contoh: +62 812 3456 7890">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Alamat Lengkap</label>
                            <textarea name="contact_address" rows="3"
                                      class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 transition-all text-sm"
                                      placeholder="Masukkan alamat lengkap kantor...">{{ old('contact_address', $settings['contact']['contact_address']->value ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Google Maps -->
                <div>
                    <h2 class="text-lg font-bold text-gray-900 mb-4 border-b pb-2">Google Maps Embed</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Link Embed Google Maps</label>
                            <textarea name="maps_embed_link" rows="4"
                                      class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 transition-all text-sm"
                                      placeholder='Masukkan src link dari iframe Google Maps. Contoh: https://www.google.com/maps/embed?pb=...'>{{ old('maps_embed_link', $settings['maps']['maps_embed_link']->value ?? '') }}</textarea>
                            <p class="text-xs text-gray-500 mt-2">Buka Google Maps > Cari Lokasi > Bagikan > Sematkan Peta > Salin hanya bagian URL di dalam atribut src="...".</p>
                        </div>
                        
                        @if(isset($settings['maps']['maps_embed_link']) && $settings['maps']['maps_embed_link']->value)
                        <div class="mt-4 p-4 border rounded-xl bg-gray-50">
                            <p class="text-xs font-semibold text-gray-500 mb-2 uppercase">Preview Peta</p>
                            <div class="w-full h-48 rounded-lg overflow-hidden relative border border-gray-200">
                                <iframe src="{{ $settings['maps']['maps_embed_link']->value }}" 
                                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end">
                <button type="submit"
                        class="px-6 py-2.5 bg-sky-500 hover:bg-sky-600 text-white text-sm font-semibold rounded-xl transition-colors shadow-sm shadow-sky-200">
                    Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

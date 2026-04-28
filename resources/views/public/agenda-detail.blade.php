@extends('layouts.eperpus')

@section('content')

<!-- HEADER SECTION -->
<section class="relative pt-32 pb-20 lg:pt-40 lg:pb-24 bg-navy-900 overflow-hidden">
    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-navy-900/50 to-navy-950"></div>
    <div class="max-w-4xl mx-auto px-6 relative z-10">
        <a href="{{ route('public.aktivitas.index') }}#agenda" class="inline-flex items-center gap-2 text-white/70 hover:text-gold-400 font-bold text-sm tracking-widest uppercase mb-8 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Kalender
        </a>
        <h1 class="text-3xl md:text-5xl lg:text-6xl font-black text-white tracking-tight leading-[1.1] mb-6">
            {{ $agenda->judul }}
        </h1>
        <div class="flex flex-wrap gap-4 mt-8">
            <div class="flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white text-sm font-bold shadow-sm">
                <svg class="w-4 h-4 text-gold-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                {{ \Carbon\Carbon::parse($agenda->tanggal_mulai)->translatedFormat('d F Y') }}
                @if($agenda->tanggal_selesai && $agenda->tanggal_mulai !== $agenda->tanggal_selesai)
                    - {{ \Carbon\Carbon::parse($agenda->tanggal_selesai)->translatedFormat('d F Y') }}
                @endif
            </div>
            <div class="flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white text-sm font-bold shadow-sm">
                <svg class="w-4 h-4 text-gold-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                {{ $agenda->jam_agenda }}
            </div>
        </div>
    </div>
</section>

<!-- CONTENT SECTION -->
<section class="py-16 bg-gray-50 border-b border-gray-100">
    <div class="max-w-4xl mx-auto px-6">
        <div class="bg-white rounded-3xl shadow-xl shadow-navy-900/5 overflow-hidden border border-navy-50">
            <div class="p-8 md:p-12">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                    
                    <!-- Main Content (Deskripsi) -->
                    <div class="md:col-span-2">
                        <h3 class="text-xl font-bold text-navy-900 mb-6 flex items-center gap-3">
                            <span class="w-8 h-px bg-gold-500"></span> Deskripsi Agenda
                        </h3>
                        <div class="prose prose-lg prose-navy max-w-none font-medium leading-relaxed text-gray-700">
                            {!! nl2br(e($agenda->deskripsi)) !!}
                        </div>
                    </div>

                    <!-- Sidebar (Info Box) -->
                    <div class="md:col-span-1 space-y-6">
                        <div class="bg-navy-50 rounded-2xl p-6 border border-navy-100">
                            <h4 class="text-sm font-black text-navy-900 uppercase tracking-widest mb-4">Informasi Tambahan</h4>
                            
                            <div class="space-y-4">
                                <div>
                                    <p class="text-xs font-bold text-navy-400 uppercase tracking-wider mb-1">Tempat</p>
                                    <p class="text-navy-900 font-semibold">{{ $agenda->tempat }}</p>
                                </div>
                                
                                @if($agenda->penyelenggara)
                                <div>
                                    <p class="text-xs font-bold text-navy-400 uppercase tracking-wider mb-1">Penyelenggara</p>
                                    <p class="text-navy-900 font-semibold">{{ $agenda->penyelenggara }}</p>
                                </div>
                                @endif

                                @if($agenda->narahubung)
                                <div>
                                    <p class="text-xs font-bold text-navy-400 uppercase tracking-wider mb-1">Narahubung</p>
                                    <p class="text-navy-900 font-semibold">{{ $agenda->narahubung }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="bg-gold-50 rounded-2xl p-6 border border-gold-200">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-full bg-gold-100 flex items-center justify-center flex-shrink-0 text-gold-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-gold-900 mb-1">Catat Tanggalnya</h4>
                                    <p class="text-sm font-medium text-gold-800">Jangan lewatkan agenda penting ini. Pastikan Anda hadir tepat waktu.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection

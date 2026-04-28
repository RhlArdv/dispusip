@extends('layouts.public')

@section('title', 'Video Testimoni E-Perpus | DISPUSIP Padang')

@section('content')
    <!-- Header Section -->
    <section class="pt-32 pb-16 px-6 bg-navy-900 relative overflow-hidden">
        <div class="absolute inset-0 z-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        <div class="max-w-7xl mx-auto relative z-10 text-center">
            <span class="inline-block px-4 py-1.5 bg-gold-500/20 text-gold-400 rounded-full text-xs font-black uppercase tracking-widest mb-4">Galeri Video</span>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-white leading-[1.1] tracking-tight mb-6">
                Testimoni <span class="text-transparent bg-clip-text bg-gradient-to-r from-gold-400 to-gold-200">E-Perpus</span>
            </h1>
            <p class="text-navy-100 text-lg md:text-xl max-w-2xl mx-auto font-medium">
                Saksikan berbagai ulasan dan panduan seputar layanan E-Perpus DISPUSIP Kota Padang langsung dari para pemustaka.
            </p>
        </div>
    </section>

    <!-- Testimoni Grid -->
    <section class="py-20 px-6 bg-[#F8FAFC]">
        <div class="max-w-7xl mx-auto">
            @if($testimoni->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($testimoni as $testi)
                        <div class="bg-white rounded-[2rem] p-5 shadow-sm border border-navy-50 flex flex-col group hover:shadow-xl transition-all duration-300">
                            @if($testi->youtube_id)
                                <div class="w-full aspect-video rounded-2xl overflow-hidden mb-5 shadow-inner bg-navy-900 border border-gray-100 relative">
                                    <iframe class="w-full h-full" src="https://www.youtube.com/embed/{{ $testi->youtube_id }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                            @else
                                <div class="w-full aspect-video rounded-2xl overflow-hidden mb-5 shadow-inner bg-navy-100 border border-gray-100 flex items-center justify-center">
                                    <span class="text-navy-400 text-sm font-medium">Video tidak tersedia</span>
                                </div>
                            @endif
                            <h3 class="text-lg font-bold text-navy-900 leading-snug line-clamp-2 px-2 pb-2">{{ $testi->title }}</h3>
                        </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="mt-16 flex justify-center">
                    {{ $testimoni->links() }}
                </div>
            @else
                <div class="text-center py-24 bg-white rounded-[3rem] border border-navy-50 shadow-sm max-w-3xl mx-auto">
                    <div class="w-24 h-24 bg-navy-50 rounded-full flex items-center justify-center mx-auto mb-6 text-navy-300">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-black text-navy-900 mb-3">Belum Ada Video Testimoni</h3>
                    <p class="text-navy-600 max-w-md mx-auto">Saat ini belum ada video testimoni yang dipublikasikan. Silakan kembali lagi nanti untuk melihat update terbaru.</p>
                </div>
            @endif
        </div>
    </section>
@endsection

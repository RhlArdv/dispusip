@extends('layouts.eperpus')

@push('styles')
<!-- FullCalendar CSS -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
<!-- Tippy.js CSS -->
<link rel="stylesheet" href="https://unpkg.com/tippy.js@6/animations/scale.css" />
<style>
    /* FullCalendar Customizations */
    .fc {
        font-family: 'Inter', sans-serif;
    }
    .fc-theme-standard .fc-scrollgrid {
        border: none;
    }
    .fc-theme-standard th {
        border: none;
        padding: 1rem 0;
        text-transform: uppercase;
        font-size: 0.75rem;
        font-weight: 800;
        letter-spacing: 0.1em;
        color: #0f2440; /* navy-900 */
        background: #f8fafc;
    }
    .fc-daygrid-day-frame {
        border: 1px solid #f1f5f9;
        transition: all 0.3s ease;
    }
    .fc-daygrid-day-frame:hover {
        background-color: #f8fafc;
    }
    .fc-day-today .fc-daygrid-day-frame {
        background-color: #f0f9ff; /* sky-50 */
        border-color: #bae6fd; /* sky-200 */
    }
    .fc-daygrid-day-top {
        flex-direction: row;
        padding: 0.5rem;
    }
    .fc-daygrid-day-number {
        font-weight: 600;
        color: #475569;
        text-decoration: none !important;
    }
    .fc-event {
        border: none !important;
        margin: 2px 4px !important;
    }
    .fc-event-main {
        padding: 4px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    .fc-button-primary {
        background-color: #0f2440 !important;
        border-color: #0f2440 !important;
        text-transform: capitalize !important;
        font-weight: 600 !important;
        border-radius: 0.5rem !important;
        padding: 0.5rem 1rem !important;
    }
    .fc-button-primary:hover {
        background-color: #d4af37 !important; /* gold-500 */
        border-color: #d4af37 !important;
        color: #0f2440 !important;
    }
    .fc-button-primary:not(:disabled):active, .fc-button-primary:not(:disabled).fc-button-active {
        background-color: #1e3a8a !important;
        border-color: #1e3a8a !important;
    }
    .fc-toolbar-title {
        font-size: 1.5rem !important;
        font-weight: 900 !important;
        color: #0f2440;
    }

    /* Custom Event Styling (Pill) */
    .custom-agenda-event {
        background-color: #d1fae5 !important; /* bg-green-100 */
        border-color: #d1fae5 !important;
        border-radius: 0.375rem !important; /* rounded-md */
        padding: 0.125rem 0.25rem !important;
        box-shadow: none !important;
        transition: background-color 0.2s ease;
    }
    .custom-agenda-event:hover {
        background-color: #bbf7d0 !important; /* bg-green-200 */
    }
    .custom-agenda-event .fc-event-main {
        color: #047857 !important; /* text-green-700 */
        font-weight: 700 !important;
        font-size: 0.75rem !important;
    }

    /* Tippy Tooltip Theme */
    .tippy-box[data-theme~='custom-light'] {
        background-color: #ffffff;
        color: #1e293b;
        border-radius: 0.75rem;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        border: 1px solid #e2e8f0;
    }
    .tippy-box[data-theme~='custom-light'] > .tippy-arrow {
        color: #ffffff;
    }
    .tippy-box[data-theme~='custom-light'] > .tippy-arrow::before {
        border-color: transparent transparent #e2e8f0 transparent; /* Border match for arrow */
    }
</style>
@endpush

@section('content')

<!-- HERO SECTION -->
<section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 bg-navy-900 overflow-hidden">
    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-navy-900/50 to-navy-950"></div>
    <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-gold-400 text-xs font-black tracking-widest uppercase mb-8 shadow-sm">
            <span class="w-2 h-2 rounded-full bg-gold-400 animate-pulse"></span> E-Perpus Padang
        </span>
        <h1 class="text-4xl md:text-6xl lg:text-7xl font-black text-white tracking-tight uppercase leading-[1.1] mb-6">
            Aktivitas <span class="text-transparent bg-clip-text bg-gradient-to-r from-gold-300 to-gold-500">Dinas</span>
        </h1>
        <p class="text-lg md:text-xl text-white/80 font-medium max-w-2xl mx-auto leading-relaxed">
            Pantau seluruh berita terkini, agenda kegiatan, serta ulasan dari masyarakat tentang pelayanan kami.
        </p>
    </div>
</section>

<!-- KALENDER AGENDA SECTION -->
<section class="py-24 relative overflow-hidden border-b border-navy-800" id="agenda">
    <!-- Background Image -->
    <div class="absolute inset-0 bg-cover bg-center bg-fixed" style="background-image: url('{{ asset('assets/img/kerangka.jpeg') }}');"></div>
    <div class="absolute inset-0 bg-white/90 backdrop-blur-[1px]"></div>

    <div class="max-w-5xl mx-auto px-6 relative z-10">
        <div class="text-center mb-10">
            <span class="text-navy-400 font-bold tracking-[0.2em] uppercase text-xs mb-4 flex items-center justify-center gap-2">
                <span class="w-8 h-px bg-gold-500"></span> Jadwal Kegiatan <span class="w-8 h-px bg-gold-500"></span>
            </span>
            <h2 class="text-4xl md:text-5xl font-black tracking-tight text-navy-900 leading-none">Agenda Dinas</h2>
        </div>

        <div class="bg-white/95 backdrop-blur-md rounded-3xl p-6 md:p-8 shadow-xl border border-navy-50">
            <div id='calendar'></div>
        </div>
    </div>
</section>

<!-- BERITA SECTION -->
<section class="py-24 bg-white" id="berita">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col md:flex-row items-end justify-between mb-16 gap-8">
            <div>
                <span class="text-navy-400 font-bold tracking-[0.2em] uppercase text-xs mb-4 flex items-center gap-2">
                    <span class="w-8 h-px bg-gold-500"></span> Informasi Terbaru
                </span>
                <h2 class="text-4xl md:text-5xl font-black tracking-tight text-navy-900 leading-none">Berita Terkini</h2>
            </div>
            <a href="{{ route('public.berita.index') }}" class="inline-flex items-center gap-2 text-navy-900 hover:text-gold-600 transition-colors font-bold text-lg border-b-2 border-navy-200 hover:border-gold-500 pb-1">
                Semua Berita <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($berita as $news)
                <a href="{{ route('public.berita.show', $news->slug) }}" class="group block">
                    <div class="aspect-[4/3] rounded-[2rem] overflow-hidden mb-6 bg-navy-50 relative">
                        <img src="{{ $news->cover_image }}" alt="{{ $news->judul_berita }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute inset-0 bg-navy-900/10 group-hover:bg-navy-900/0 transition-colors duration-500"></div>
                        <div class="absolute top-4 left-4">
                            <span class="px-4 py-2 bg-white/90 backdrop-blur-md rounded-xl text-xs font-black text-navy-900 uppercase tracking-widest shadow-sm">
                                {{ $news->kategori->nama_kategori ?? 'Berita' }}
                            </span>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center gap-3 mb-4">
                            <span class="text-sm font-semibold text-navy-400 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ $news->created_at->format('d M Y') }}
                            </span>
                        </div>
                        <h3 class="text-2xl font-black text-navy-900 group-hover:text-gold-500 transition-colors leading-tight line-clamp-2">
                            {{ $news->judul_berita }}
                        </h3>
                    </div>
                </a>
            @empty
                <div class="col-span-3 text-center py-12">
                    <p class="text-navy-500 font-medium">Belum ada berita yang diterbitkan.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- TESTIMONI SECTION -->
<section class="py-24 bg-navy-900 border-t border-navy-800" id="testimoni">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col md:flex-row items-end justify-between mb-16 gap-8">
            <div>
                <span class="text-gold-500 font-bold tracking-[0.2em] uppercase text-xs mb-4 flex items-center gap-2">
                    <span class="w-8 h-px bg-gold-500"></span> Ulasan Pemustaka
                </span>
                <h2 class="text-4xl md:text-5xl font-black tracking-tight text-white leading-none">Testimoni</h2>
            </div>
            <a href="{{ route('public.testimoni.index') }}" class="inline-flex items-center gap-2 text-white hover:text-gold-400 transition-colors font-bold text-lg border-b-2 border-white/20 hover:border-gold-400 pb-1">
                Semua Testimoni <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($testimoni as $testi)
                <div class="bg-navy-800 p-4 rounded-3xl border border-white/10 shadow-lg group">
                    @if($testi->youtube_id)
                        <div class="w-full aspect-video rounded-2xl overflow-hidden shadow-inner bg-black relative">
                            <iframe class="w-full h-full" src="https://www.youtube.com/embed/{{ $testi->youtube_id }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                        <div class="pt-4 px-2 pb-2">
                            <h3 class="text-white font-bold text-lg line-clamp-1" title="{{ $testi->title }}">{{ $testi->title }}</h3>
                        </div>
                    @else
                        <div class="w-full aspect-video rounded-2xl overflow-hidden shadow-inner bg-black flex items-center justify-center">
                            <span class="text-white/30 text-sm font-medium">Video tidak tersedia</span>
                        </div>
                        <div class="pt-4 px-2 pb-2">
                            <h3 class="text-white font-bold text-lg line-clamp-1">{{ $testi->title }}</h3>
                        </div>
                    @endif
                </div>
            @empty
                <div class="col-span-3 text-center py-12">
                    <p class="text-white/50 font-medium">Belum ada testimoni.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

@endsection

@push('scripts')
<!-- FullCalendar JS -->
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/id.js'></script>
<!-- Popper & Tippy JS -->
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://unpkg.com/tippy.js@6"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var agendas = @json($agendas);

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'id',
            views: {
                listYear: {
                    buttonText: 'Agenda (List)'
                },
                dayGridMonth: {
                    buttonText: 'Kalender'
                }
            },
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,listYear'
            },
            events: agendas,
            eventDidMount: function(info) {
                var props = info.event.extendedProps;
                
                var tooltipContent = `
                    <div class="p-2 text-left font-sans">
                        <div class="text-emerald-600 font-bold text-[0.65rem] tracking-wider mb-1 uppercase">DETAIL EVENT</div>
                        <div class="text-navy-900 font-black text-sm mb-1">${info.event.title}</div>
                        <div class="text-gray-500 text-xs mb-3">${props.formatted_date || ''}</div>
                        <div class="text-gray-600 text-xs mb-4 leading-relaxed">${props.excerpt || ''}</div>
                        <a href="${info.event.url}" class="text-blue-600 hover:text-blue-800 text-xs font-semibold">Buka detail event</a>
                    </div>
                `;

                tippy(info.el, {
                    content: tooltipContent,
                    allowHTML: true,
                    theme: 'custom-light',
                    placement: 'top',
                    interactive: true,
                    animation: 'scale',
                    appendTo: document.body,
                });
            },
            eventClick: function(info) {
                // Supaya browser langsung follow ke URL
                if (info.event.url) {
                    window.location.href = info.event.url;
                    info.jsEvent.preventDefault(); // don't let the browser navigate normally
                }
            }
        });

        calendar.render();
    });
</script>
@endpush

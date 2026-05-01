@extends('layouts.eperpus')

@push('styles')
    <!-- FullCalendar CSS -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
    <!-- Tippy.js CSS -->
    <link rel="stylesheet" href="https://unpkg.com/tippy.js@6/animations/scale.css" />
    <style>
        /* =========================================
           FullCalendar Customizations & Responsiveness
           ========================================= */
        .fc {
            font-family: 'Inter', sans-serif;
            color: #1e293b;
        }

        /* Responsive Toolbar */
        .fc .fc-toolbar.fc-header-toolbar {
            margin-bottom: 2rem;
        }

        @media (max-width: 768px) {
            .fc .fc-toolbar.fc-header-toolbar {
                flex-direction: column;
                gap: 1rem;
            }

            .fc-toolbar-title {
                font-size: 1.25rem !important;
                text-align: center;
            }

            .fc-button-group {
                width: 100%;
                justify-content: center;
            }
        }

        /* Grid & Cells Styling */
        .fc-theme-standard .fc-scrollgrid {
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            overflow: hidden;
        }

        .fc-theme-standard th {
            border-bottom: 1px solid #e2e8f0;
            border-right: none;
            border-left: none;
            padding: 1.25rem 0;
            text-transform: uppercase;
            font-size: 0.75rem;
            font-weight: 800;
            letter-spacing: 0.05em;
            color: #64748b;
            background: #f8fafc;
        }

        .fc-theme-standard td {
            border: 1px solid #f1f5f9;
        }

        .fc-daygrid-day-frame {
            transition: all 0.2s ease;
            padding: 4px;
        }

        .fc-daygrid-day-frame:hover {
            background-color: #f8fafc;
        }

        .fc-day-today .fc-daygrid-day-frame {
            background-color: #f0f9ff !important;
        }

        .fc-day-today .fc-daygrid-day-number {
            background-color: #0f2440;
            color: white !important;
            border-radius: 50%;
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 4px;
        }

        .fc-daygrid-day-top {
            flex-direction: row;
            justify-content: center;
            padding-top: 4px;
        }

        .fc-daygrid-day-number {
            font-weight: 700;
            font-size: 0.875rem;
            color: #475569;
            text-decoration: none !important;
        }

        /* Buttons Styling */
        .fc-button-primary {
            background-color: #0f2440 !important;
            border-color: #0f2440 !important;
            text-transform: capitalize !important;
            font-weight: 600 !important;
            border-radius: 0.5rem !important;
            padding: 0.5rem 1rem !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
        }

        .fc-button-primary:hover {
            background-color: #d4af37 !important;
            /* gold-500 */
            border-color: #d4af37 !important;
            color: #0f2440 !important;
        }

        .fc-button-primary:not(:disabled):active,
        .fc-button-primary:not(:disabled).fc-button-active {
            background-color: #1e3a8a !important;
            border-color: #1e3a8a !important;
        }

        .fc-toolbar-title {
            font-size: 1.5rem !important;
            font-weight: 900 !important;
            color: #0f2440;
        }

        /* Custom Event Styling (Pill) */
        .fc-event {
            border: none !important;
            margin: 2px 4px !important;
            background-color: transparent !important;
        }

        .custom-agenda-event {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%) !important;
            border-left: 3px solid #10b981 !important;
            border-radius: 0.375rem !important;
            padding: 0.25rem 0.5rem !important;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05) !important;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            cursor: pointer;
        }

        .custom-agenda-event:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.2) !important;
        }

        .custom-agenda-event .fc-event-main {
            color: #065f46 !important;
            font-weight: 700 !important;
            font-size: 0.75rem !important;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* List View Customizations (Mobile View) */
        .fc-list {
            border-radius: 1rem;
            overflow: hidden;
            border: 1px solid #e2e8f0 !important;
        }

        .fc-list-day-cushion {
            background-color: #f8fafc !important;
            font-weight: 800 !important;
            color: #0f2440 !important;
            padding: 0.75rem 1rem !important;
        }

        .fc-list-event:hover td {
            background-color: #f0fdf4 !important;
        }

        .fc-list-event-title a {
            color: #0f2440 !important;
            font-weight: 600;
            text-decoration: none !important;
        }

        /* Tippy Tooltip Theme */
        .tippy-box[data-theme~='custom-light'] {
            background-color: #ffffff;
            color: #1e293b;
            border-radius: 1rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border: 1px solid #f1f5f9;
            padding: 0.5rem;
        }

        .tippy-box[data-theme~='custom-light']>.tippy-arrow {
            color: #ffffff;
        }

        .tippy-box[data-theme~='custom-light']>.tippy-arrow::before {
            border-color: transparent transparent #f1f5f9 transparent;
        }
    </style>
@endpush

@section('content')

    <!-- HERO SECTION -->
    <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 bg-navy-900 overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-navy-900/50 to-navy-950"></div>
        <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
            <span
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-gold-400 text-xs font-black tracking-widest uppercase mb-8 shadow-sm">
                <span class="w-2 h-2 rounded-full bg-gold-400 animate-pulse"></span> E-Perpus Padang
            </span>
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-black text-white tracking-tight uppercase leading-[1.1] mb-6">
                Aktivitas <span
                    class="text-transparent bg-clip-text bg-gradient-to-r from-gold-300 to-gold-500">Dinas</span>
            </h1>
            <p class="text-lg md:text-xl text-white/80 font-medium max-w-2xl mx-auto leading-relaxed">
                Pantau seluruh berita terkini, agenda kegiatan, serta ulasan dari masyarakat tentang pelayanan kami.
            </p>
        </div>
    </section>

    <!-- KALENDER AGENDA SECTION -->
    <section class="py-24 relative overflow-hidden border-b border-navy-50 bg-[#F8FAFC]" id="agenda">
        <!-- Background Image -->
        <div class="absolute inset-0 bg-cover bg-center bg-fixed opacity-5"
            style="background-image: url('{{ asset('assets/img/kerangka.jpeg') }}');"></div>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 relative z-10">
            <div class="text-center mb-12">
                <span
                    class="text-gold-600 font-bold tracking-[0.2em] uppercase text-xs mb-4 flex items-center justify-center gap-2">
                    <span class="w-8 h-px bg-gold-500"></span> Jadwal Kegiatan <span class="w-8 h-px bg-gold-500"></span>
                </span>
                <h2 class="text-4xl md:text-5xl font-black tracking-tight text-navy-900 leading-none">Agenda Dinas</h2>
            </div>

            <!-- Kalender Container -->
            <div
                class="bg-white rounded-[2rem] p-4 sm:p-6 md:p-10 shadow-[0_20px_50px_rgba(15,36,64,0.05)] border border-navy-50">
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
                    <h2 class="text-4xl md:text-5xl font-black tracking-tight text-navy-900 leading-none">Berita Terkini
                    </h2>
                </div>
                <a href="{{ route('public.berita.index') }}"
                    class="inline-flex items-center gap-2 text-navy-900 hover:text-gold-600 transition-colors font-bold text-lg border-b-2 border-navy-200 hover:border-gold-500 pb-1">
                    Semua Berita <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3">
                        </path>
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($berita as $news)
                    <a href="{{ route('public.berita.show', $news->slug) }}" class="group block">
                        <div class="aspect-[4/3] rounded-[2rem] overflow-hidden mb-6 bg-navy-50 relative">
                            <img src="{{ $news->cover_image }}" alt="{{ $news->judul_berita }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            <div
                                class="absolute inset-0 bg-navy-900/10 group-hover:bg-navy-900/0 transition-colors duration-500">
                            </div>
                            <div class="absolute top-4 left-4">
                                <span
                                    class="px-4 py-2 bg-white/90 backdrop-blur-md rounded-xl text-xs font-black text-navy-900 uppercase tracking-widest shadow-sm">
                                    {{ $news->kategori->nama_kategori ?? 'Berita' }}
                                </span>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-center gap-3 mb-4">
                                <span class="text-sm font-semibold text-navy-400 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    {{ $news->created_at->format('d M Y') }}
                                </span>
                            </div>
                            <h3
                                class="text-2xl font-black text-navy-900 group-hover:text-gold-500 transition-colors leading-tight line-clamp-2">
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
                <a href="{{ route('public.testimoni.index') }}"
                    class="inline-flex items-center gap-2 text-white hover:text-gold-400 transition-colors font-bold text-lg border-b-2 border-white/20 hover:border-gold-400 pb-1">
                    Semua Testimoni <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3">
                        </path>
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($testimoni as $testi)
                    <div class="bg-navy-800 p-4 rounded-3xl border border-white/10 shadow-lg group">
                        @if($testi->youtube_id)
                            <div class="w-full aspect-video rounded-2xl overflow-hidden shadow-inner bg-black relative">
                                <iframe class="w-full h-full" src="https://www.youtube.com/embed/{{ $testi->youtube_id }}"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                            <div class="pt-4 px-2 pb-2">
                                <h3 class="text-white font-bold text-lg line-clamp-1" title="{{ $testi->title }}">
                                    {{ $testi->title }}</h3>
                            </div>
                        @else
                            <div
                                class="w-full aspect-video rounded-2xl overflow-hidden shadow-inner bg-black flex items-center justify-center">
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

    <!-- Digital Notice Board Section (Gen Z Editorial Style) -->
    @if($pengumumans->count() > 0)
        <section class="py-20 px-6 bg-white overflow-hidden relative">
            <div class="max-w-[90rem] mx-auto">
                <div class="flex flex-col md:flex-row md:items-center justify-between mb-16 gap-6 px-4">
                    <div class="relative">
                        <span class="text-gold-500 font-black tracking-[0.3em] text-[10px] uppercase mb-4 block">Pusat
                            Informasi</span>
                        <h2 class="text-4xl md:text-6xl font-black text-navy-900 tracking-tighter uppercase leading-[0.9]">
                            Notice<br><span
                                class="text-transparent bg-clip-text bg-gradient-to-r from-gold-400 to-gold-600">Board.</span>
                        </h2>
                        <div class="absolute -left-8 top-0 w-1 h-full bg-navy-900 hidden md:block"></div>
                    </div>
                    <div class="max-w-xs md:text-right">
                        <p class="text-navy-500 text-sm font-medium leading-relaxed">
                            Pantau informasi terbaru, himbauan resmi, dan tautan penting dari kami secara real-time.
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 p-4">
                    @foreach($pengumumans as $pengumuman)
                        <div
                            class="group relative bg-white rounded-[2.5rem] p-10 border border-navy-50 hover:border-gold-400/30 transition-all duration-700 hover:shadow-[0_40px_80px_-20px_rgba(245,158,11,0.1)] hover:-translate-y-3 overflow-hidden flex flex-col h-full shadow-sm">
                            <!-- Pin Icon -->
                            @if($pengumuman->is_pinned)
                                <div class="absolute top-8 right-8 text-gold-500 animate-pulse">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                    </svg>
                                </div>
                            @endif

                            <div class="mb-8">
                                <span
                                    class="inline-block px-5 py-2 rounded-full text-[9px] font-black tracking-[0.2em] uppercase {{ $pengumuman->tipe == 'HIMBAUAN' ? 'bg-red-500 text-white shadow-lg shadow-red-200' : 'bg-navy-900 text-white shadow-lg shadow-navy-100' }}">
                                    {{ $pengumuman->tipe }}
                                </span>
                            </div>

                            <h3
                                class="text-2xl font-black text-navy-900 leading-tight mb-6 group-hover:text-gold-600 transition-colors duration-500">
                                {{ $pengumuman->judul }}
                            </h3>

                            <div
                                class="text-navy-500 text-sm leading-relaxed mb-10 flex-grow prose prose-sm max-w-none prose-navy line-clamp-4">
                                {!! nl2br(e($pengumuman->isi)) !!}
                            </div>

                            <div class="flex items-center justify-between pt-8 border-t border-navy-50">
                                <div class="flex flex-col">
                                    <span
                                        class="text-[9px] font-black text-navy-300 uppercase tracking-widest mb-1">Diterbitkan</span>
                                    <span
                                        class="text-xs font-bold text-navy-900">{{ $pengumuman->created_at->translatedFormat('d M Y') }}</span>
                                </div>

                                @if($pengumuman->tautan)
                                    <a href="{{ $pengumuman->tautan }}" target="_blank"
                                        class="w-12 h-12 rounded-2xl bg-navy-50 text-navy-900 flex items-center justify-center hover:bg-gold-500 hover:text-white transition-all duration-500 group/btn">
                                        <svg class="w-5 h-5 transform group-hover/btn:translate-x-1 group-hover/btn:-translate-y-1 transition-transform"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                    </a>
                                @endif
                            </div>

                            <!-- Decorative Background -->
                            <div
                                class="absolute -right-20 -bottom-20 w-64 h-64 bg-gold-400/5 rounded-full blur-[80px] group-hover:bg-gold-400/10 transition-all duration-700">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Background Elements -->
            <div class="absolute top-1/2 left-0 w-64 h-64 bg-gold-100/30 rounded-full blur-[100px] -translate-x-1/2 -z-10">
            </div>
            <div
                class="absolute bottom-0 right-0 w-96 h-96 bg-navy-100/30 rounded-full blur-[120px] translate-x-1/3 translate-y-1/3 -z-10">
            </div>
        </section>
    @endif

@endsection

@push('scripts')
    <!-- FullCalendar JS -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/id.js'></script>
    <!-- Popper & Tippy JS -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var agendas = @json($agendas);

            // Cek apakah perangkat adalah mobile (lebar layar < 768px)
            var isMobile = window.innerWidth < 768;

            var calendar = new FullCalendar.Calendar(calendarEl, {
                // Jika mobile, otomatis pakai List View agar rapi. Jika PC, pakai Calendar Grid.
                initialView: isMobile ? 'listMonth' : 'dayGridMonth',
                locale: 'id',
                height: 'auto', // Agar tinggi kalender menyesuaikan konten dan tidak terpotong
                views: {
                    listMonth: {
                        buttonText: 'Daftar'
                    },
                    dayGridMonth: {
                        buttonText: 'Kalender'
                    }
                },
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,listMonth'
                },
                events: agendas,

                // Event listener saat ukuran browser berubah (rotasi layar HP / resize PC)
                windowResize: function (arg) {
                    if (window.innerWidth < 768) {
                        calendar.changeView('listMonth');
                    } else {
                        calendar.changeView('dayGridMonth');
                    }
                },

                eventDidMount: function (info) {
                    // Di mode list, kita tidak butuh tooltip yang rumit karena detailnya sudah terlihat sebagai baris
                    if (info.view.type === 'listMonth') return;

                    var props = info.event.extendedProps;

                    var tooltipContent = `
                        <div class="p-2 text-left font-sans">
                            <div class="text-emerald-600 font-bold text-[0.65rem] tracking-wider mb-1 uppercase">DETAIL EVENT</div>
                            <div class="text-navy-900 font-black text-sm mb-1">${info.event.title}</div>
                            <div class="text-gray-500 text-xs mb-3 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                ${props.formatted_date || ''}
                            </div>
                            <div class="text-gray-600 text-xs mb-4 leading-relaxed line-clamp-3">${props.excerpt || ''}</div>
                            <a href="${info.event.url}" class="inline-block bg-navy-900 text-white hover:bg-gold-500 hover:text-navy-900 px-3 py-1.5 rounded-lg text-xs font-bold transition-colors w-full text-center">Lihat Detail</a>
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
                        delay: [100, 50],
                    });
                },
                eventClick: function (info) {
                    if (info.event.url) {
                        window.location.href = info.event.url;
                        info.jsEvent.preventDefault();
                    }
                }
            });

            calendar.render();
        });
    </script>
@endpush
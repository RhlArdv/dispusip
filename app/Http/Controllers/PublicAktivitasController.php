<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Berita;
use App\Models\Testimoni;
use App\Models\Agenda;

class PublicAktivitasController extends Controller
{
    public function index()
    {
        $berita = Berita::latest()->take(3)->get();
        $testimoni = Testimoni::where('is_active', true)->latest()->take(6)->get();
        
        $agendas = Agenda::where('is_active', true)->get()->map(function($agenda) {
            $dateStr = \Carbon\Carbon::parse($agenda->tanggal_mulai)->locale('id')->isoFormat('dddd, D MMMM Y');
            if ($agenda->tanggal_selesai && $agenda->tanggal_selesai->format('Y-m-d') != $agenda->tanggal_mulai->format('Y-m-d')) {
                $dateStr .= ' - ' . \Carbon\Carbon::parse($agenda->tanggal_selesai)->locale('id')->isoFormat('dddd, D MMMM Y');
            }

            return [
                'id' => $agenda->id,
                'title' => $agenda->judul,
                'start' => $agenda->tanggal_mulai->format('Y-m-d'),
                'end' => $agenda->tanggal_selesai ? $agenda->tanggal_selesai->addDay()->format('Y-m-d') : null,
                'url' => route('public.agenda.show', $agenda->slug),
                'className' => 'custom-agenda-event',
                'extendedProps' => [
                    'excerpt' => \Illuminate\Support\Str::limit(strip_tags($agenda->deskripsi), 90),
                    'formatted_date' => $dateStr,
                ],
            ];
        });

        return view('public.aktivitas', compact('berita', 'testimoni', 'agendas'));
    }

    public function showAgenda($slug)
    {
        $agenda = Agenda::where('slug', $slug)->where('is_active', true)->firstOrFail();
        return view('public.agenda-detail', compact('agenda'));
    }
}

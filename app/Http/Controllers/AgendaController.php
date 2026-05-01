<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Agenda::query()->latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('tanggal', function ($row) {
                    $tgl = \Carbon\Carbon::parse($row->tanggal_mulai)->translatedFormat('d M Y');
                    if ($row->tanggal_selesai && $row->tanggal_mulai !== $row->tanggal_selesai) {
                        $tgl .= ' - ' . \Carbon\Carbon::parse($row->tanggal_selesai)->translatedFormat('d M Y');
                    }
                    return $tgl;
                })
                ->addColumn('is_active', function ($row) {
                    $badgeClass = $row->is_active ? 'bg-green-100 text-green-800 border-green-200' : 'bg-red-100 text-red-800 border-red-200';
                    $text = $row->is_active ? 'Aktif' : 'Nonaktif';
                    return '<span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full border ' . $badgeClass . '">' . $text . '</span>';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<div class="flex items-center gap-2">';
                    $btn .= '<a href="' . route('agenda.edit', $row->id) . '" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-sky-50 text-sky-600 hover:bg-sky-100 rounded-lg transition-colors text-sm font-medium"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>Edit</a>';
                    $btn .= '<form action="' . route('agenda.destroy', $row->id) . '" method="POST" class="d-inline" onsubmit="return confirm(\'Yakin ingin menghapus agenda ini?\')">';
                    $btn .= csrf_field() . method_field('DELETE');
                    $btn .= '<button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg transition-colors text-sm font-medium"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>Hapus</button>';
                    $btn .= '</form>';
                    $btn .= '</div>';
                    return $btn;
                })
                ->rawColumns(['is_active', 'action'])
                ->make(true);
        }

        return view('agenda.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('agenda.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'jam_agenda' => 'required|string|max:255',
            'tempat' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'penyelenggara' => 'nullable|string|max:255',
            'narahubung' => 'nullable|string|max:255',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        $data['slug'] = \Illuminate\Support\Str::slug($request->judul) . '-' . time();
        $data['is_active'] = $request->has('is_active');

        Agenda::create($data);

        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agenda $agenda)
    {
        return view('agenda.edit', compact('agenda'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agenda $agenda)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'jam_agenda' => 'required|string|max:255',
            'tempat' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'penyelenggara' => 'nullable|string|max:255',
            'narahubung' => 'nullable|string|max:255',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        $data['slug'] = \Illuminate\Support\Str::slug($request->judul) . '-' . time();
        $data['is_active'] = $request->has('is_active');

        $agenda->update($data);

        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agenda $agenda)
    {
        $agenda->delete();
        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil dihapus.');
    }
}

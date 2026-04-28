<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestimoniController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = \App\Models\Testimoni::orderBy('id', 'desc')->get();
            return \Yajra\DataTables\Facades\DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $editUrl = route('testimoni.edit', $row->id);
                    $deleteUrl = route('testimoni.destroy', $row->id);
                    return '
                        <div class="flex items-center gap-2">
                            <a href="'.$editUrl.'" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <button onclick="deleteData(\''.$deleteUrl.'\')" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>
                    ';
                })
                ->addColumn('status', function($row){
                    if ($row->is_active) {
                        return '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>';
                    }
                    return '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Tidak Aktif</span>';
                })
                ->addColumn('youtube_preview', function($row) {
                    $id = $row->youtube_id;
                    if ($id) {
                        return '<img src="https://img.youtube.com/vi/'.$id.'/mqdefault.jpg" class="h-12 w-auto rounded-md object-cover" alt="Thumbnail">';
                    }
                    return '<span class="text-gray-400 italic">Invalid URL</span>';
                })
                ->rawColumns(['action', 'status', 'youtube_preview'])
                ->make(true);
        }

        return view('testimoni.index');
    }

    public function create()
    {
        return view('testimoni.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'youtube_url' => 'required|url',
        ]);

        $data = [
            'title' => $request->title,
            'youtube_url' => $request->youtube_url,
            'is_active' => $request->has('is_active'),
        ];

        \App\Models\Testimoni::create($data);

        return redirect()->route('testimoni.index')->with('success', 'Testimoni video berhasil ditambahkan.');
    }

    public function edit(\App\Models\Testimoni $testimoni)
    {
        return view('testimoni.edit', compact('testimoni'));
    }

    public function update(Request $request, \App\Models\Testimoni $testimoni)
    {
        $request->validate([
            'title' => 'required',
            'youtube_url' => 'required|url',
        ]);

        $data = [
            'title' => $request->title,
            'youtube_url' => $request->youtube_url,
            'is_active' => $request->has('is_active'),
        ];

        $testimoni->update($data);

        return redirect()->route('testimoni.index')->with('success', 'Testimoni video berhasil diperbarui.');
    }

    public function destroy(\App\Models\Testimoni $testimoni)
    {
        $testimoni->delete();
        return response()->json(['success' => true, 'message' => 'Testimoni video berhasil dihapus']);
    }
}

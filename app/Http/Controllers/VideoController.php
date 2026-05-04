<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Video::orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $editUrl = route('video.edit', $row->id);
                    $deleteUrl = route('video.destroy', $row->id);
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
                ->addColumn('thumbnail', function($row) {
                    $thumbnail = $row->youtube_id ? 'https://img.youtube.com/vi/' . $row->youtube_id . '/mqdefault.jpg' : null;
                    if ($thumbnail) {
                        return '<img src="'.$thumbnail.'" class="h-12 w-auto rounded-md object-cover shadow-sm" alt="Thumbnail">';
                    }
                    return '<span class="text-gray-400 italic text-xs">Invalid URL</span>';
                })
                ->addColumn('video_link', function($row){
                    if ($row->youtube_id) {
                        return '<a href="'.$row->youtube_url.'" target="_blank" class="text-indigo-600 hover:underline text-sm">Tonton</a>';
                    }
                    return '<span class="text-red-500 text-xs">Invalid</span>';
                })
                ->addColumn('status', function($row){
                    if ($row->is_active) {
                        return '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>';
                    }
                    return '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Tidak Aktif</span>';
                })
                ->rawColumns(['action', 'thumbnail', 'video_link', 'status'])
                ->make(true);
        }

        return view('video.index');
    }

    public function create()
    {
        return view('video.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_video' => 'required|string|max:255',
            'youtube_url' => 'required|url',
            'deskripsi' => 'nullable|string',
        ], [
            'judul_video.required' => 'Judul video wajib diisi.',
            'youtube_url.required' => 'Link YouTube wajib diisi.',
            'youtube_url.url' => 'Format link YouTube tidak valid.',
        ]);

        $validated['is_active'] = $request->has('is_active');

        Video::create($validated);

        return redirect()->route('video.index')->with('success', 'Video berhasil ditambahkan.');
    }

    public function edit(Video $video)
    {
        return view('video.edit', compact('video'));
    }

    public function update(Request $request, Video $video)
    {
        $validated = $request->validate([
            'judul_video' => 'required|string|max:255',
            'youtube_url' => 'required|url',
            'deskripsi' => 'nullable|string',
        ], [
            'judul_video.required' => 'Judul video wajib diisi.',
            'youtube_url.required' => 'Link YouTube wajib diisi.',
            'youtube_url.url' => 'Format link YouTube tidak valid.',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $video->update($validated);

        return redirect()->route('video.index')->with('success', 'Video berhasil diperbarui.');
    }

    public function destroy(Video $video)
    {
        $video->delete();

        return response()->json(['success' => true, 'message' => 'Video berhasil dihapus.']);
    }
}

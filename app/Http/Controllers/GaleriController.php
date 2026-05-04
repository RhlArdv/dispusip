<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Galeri::orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $editUrl = route('galeri.edit', $row->id);
                    $deleteUrl = route('galeri.destroy', $row->id);
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
                ->addColumn('preview', function($row) {
                    if ($row->foto_galeri) {
                        return '<img src="'.asset($row->foto_galeri).'" class="h-16 w-auto rounded-md object-cover shadow-sm" alt="Preview">';
                    }
                    return '<div class="w-16 h-16 bg-gray-100 rounded-md flex items-center justify-center">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>';
                })
                ->addColumn('status', function($row){
                    if ($row->is_active) {
                        return '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>';
                    }
                    return '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Tidak Aktif</span>';
                })
                ->rawColumns(['action', 'preview', 'status'])
                ->make(true);
        }

        return view('galeri.index');
    }

    public function create()
    {
        return view('galeri.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_galeri' => 'required|string|max:255',
            'foto_galeri' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'deskripsi' => 'nullable|string',
        ], [
            'judul_galeri.required' => 'Judul galeri wajib diisi.',
            'foto_galeri.required' => 'Foto galeri wajib diunggah.',
            'foto_galeri.image' => 'Foto harus berupa gambar.',
            'foto_galeri.mimes' => 'Foto harus berformat jpeg, png, jpg, gif, atau webp.',
            'foto_galeri.max' => 'Foto maksimal 2MB.',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('foto_galeri')) {
            $file = $request->file('foto_galeri');
            $fileName = time() . '_' . str()->random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/galeri'), $fileName);
            $validated['foto_galeri'] = 'uploads/galeri/' . $fileName;
        }

        Galeri::create($validated);

        return redirect()->route('galeri.index')->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function edit(Galeri $galeri)
    {
        return view('galeri.edit', compact('galeri'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        $validated = $request->validate([
            'judul_galeri' => 'required|string|max:255',
            'foto_galeri' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'deskripsi' => 'nullable|string',
        ], [
            'judul_galeri.required' => 'Judul galeri wajib diisi.',
            'foto_galeri.image' => 'Foto harus berupa gambar.',
            'foto_galeri.mimes' => 'Foto harus berformat jpeg, png, jpg, gif, atau webp.',
            'foto_galeri.max' => 'Foto maksimal 2MB.',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('foto_galeri')) {
            if ($galeri->foto_galeri && file_exists(public_path($galeri->foto_galeri))) {
                unlink(public_path($galeri->foto_galeri));
            }

            $file = $request->file('foto_galeri');
            $fileName = time() . '_' . str()->random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/galeri'), $fileName);
            $validated['foto_galeri'] = 'uploads/galeri/' . $fileName;
        }

        $galeri->update($validated);

        return redirect()->route('galeri.index')->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy(Galeri $galeri)
    {
        if ($galeri->foto_galeri && file_exists(public_path($galeri->foto_galeri))) {
            unlink(public_path($galeri->foto_galeri));
        }

        $galeri->delete();

        return response()->json(['success' => true, 'message' => 'Galeri berhasil dihapus.']);
    }
}

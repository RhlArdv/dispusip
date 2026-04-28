<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class KegiatanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->dataTable();
        }

        return view('kegiatan.index');
    }

    private function dataTable()
    {
        // Select content juga agar accessor cover_image bisa scan gambar dari konten Summernote lama
        $query = Kegiatan::with('user')
            ->select(['id', 'title', 'foto', 'slug', 'content', 'user_id', 'created_at', 'updated_at'])
            ->orderBy('created_at', 'desc');

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('foto', function ($kegiatan) {
                // Gunakan accessor cover_image (foto field atau gambar pertama dari content)
                $coverImage = $kegiatan->cover_image;

                if ($coverImage) {
                    return '<img src="' . $coverImage . '" alt="' . e($kegiatan->title) . '"
                               class="w-16 h-12 object-cover rounded-lg shadow-sm"
                               onerror="this.src=\'/placeholder-kegiatan.png\'">';
                }

                return '<div class="w-16 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                           <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                     d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                           </svg>
                       </div>';
            })
            ->addColumn('judul', function ($kegiatan) {
                return '<div class="font-semibold text-gray-800">' . e($kegiatan->title) . '</div>';
            })
            ->addColumn('penulis', function ($kegiatan) {
                $penulis = '<span class="text-gray-400">—</span>';
                if ($kegiatan->user && $kegiatan->user_id) {
                    $penulis = e($kegiatan->user->name);
                } elseif ($kegiatan->user_id) {
                    // Fallback jika user_id ada tapi relasi gagal
                    $penulis = '<span class="text-gray-400">User #' . $kegiatan->user_id . '</span>';
                }
                return '<div class="text-xs text-gray-600">' . $penulis . '</div>';
            })
            ->addColumn('tanggal', function ($kegiatan) {
                return '<div class="text-xs text-gray-600">' . $kegiatan->created_at->format('d M Y') . '</div>';
            })
            ->addColumn('aksi', function ($kegiatan) {
                $currentUser = Auth::user();
                $btn = '';

                if ($currentUser->hasPermission('edit_kegiatan')) {
                    $btn .= '<a href="/menu/kegiatan/' . $kegiatan->id . '/edit"
                                class="px-3 py-1.5 text-xs font-medium text-amber-700 bg-amber-50
                                       hover:bg-amber-100 rounded-lg transition-colors mr-1">
                                Edit
                             </a>';
                }

                if ($currentUser->hasPermission('delete_kegiatan')) {
                    $btn .= '<button onclick="hapusKegiatan(' . $kegiatan->id . ', \'' . addslashes($kegiatan->title) . '\')"
                                class="px-3 py-1.5 text-xs font-medium text-red-600 bg-red-50
                                       hover:bg-red-100 rounded-lg transition-colors">
                                Hapus
                             </button>';
                }

                return $btn ?: '<span class="text-xs text-gray-400">—</span>';
            })
            ->rawColumns(['foto', 'judul', 'penulis', 'tanggal', 'aksi'])
            ->make(true);
    }

    public function create()
    {
        return view('kegiatan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'content' => 'required|string',
        ], [
            'title.required' => 'Judul kegiatan wajib diisi.',
            'foto.image' => 'Foto harus berupa gambar.',
            'foto.mimes' => 'Foto harus berformat jpeg, png, jpg, gif, atau webp.',
            'foto.max' => 'Ukuran foto maksimal 2MB.',
            'content.required' => 'Isi kegiatan wajib diisi.',
        ]);

        $validated['user_id'] = Auth::id();

        // Handle file upload
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/kegiatan'), $fileName);
            $validated['foto'] = 'uploads/kegiatan/' . $fileName;
        }

        Kegiatan::create($validated);

        return redirect()
            ->route('kegiatan.index')
            ->with('success', 'Kegiatan "' . $validated['title'] . '" berhasil ditambahkan.');
    }

    public function show($id)
    {
        $kegiatan = Kegiatan::with('user')->findOrFail($id);
        return view('kegiatan.show', compact('kegiatan'));
    }

    public function edit($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('kegiatan.edit', compact('kegiatan'));
    }

    public function update(Request $request, $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'content' => 'required|string',
        ], [
            'title.required' => 'Judul kegiatan wajib diisi.',
            'foto.image' => 'Foto harus berupa gambar.',
            'foto.mimes' => 'Foto harus berformat jpeg, png, jpg, gif, atau webp.',
            'foto.max' => 'Ukuran foto maksimal 2MB.',
            'content.required' => 'Isi kegiatan wajib diisi.',
        ]);

        // Handle file upload
        if ($request->hasFile('foto')) {
            // Delete old photo if exists
            if ($kegiatan->foto && file_exists(public_path($kegiatan->foto))) {
                unlink(public_path($kegiatan->foto));
            }

            $file = $request->file('foto');
            $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/kegiatan'), $fileName);
            $validated['foto'] = 'uploads/kegiatan/' . $fileName;
        }

        $kegiatan->update($validated);

        return redirect()
            ->route('kegiatan.index')
            ->with('success', 'Kegiatan "' . $kegiatan->title . '" berhasil diperbarui.');
    }

    public function destroy($id)
    {
        try {
            $kegiatan = Kegiatan::findOrFail($id);

            // Delete foto file
            if ($kegiatan->foto && file_exists(public_path($kegiatan->foto))) {
                unlink(public_path($kegiatan->foto));
            }

            $judul = $kegiatan->title;
            $kegiatan->delete();

            return response()->json([
                'success' => true,
                'message' => 'Kegiatan "' . $judul . '" berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus kegiatan.'
            ], 500);
        }
    }
}

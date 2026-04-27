<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->dataTable();
        }

        return view('berita.index');
    }

    private function dataTable()
    {
        $query = Berita::with('user')
            ->select(['berita.*']) // Explicit select untuk avoid ambiguity
            ->orderBy('created_at', 'desc');

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('thumbnail', function ($berita) {
                if ($berita->thumbnail) {
                    return '<img src="' . asset($berita->thumbnail) . '" alt="' . e($berita->judul_berita) . '"
                               class="w-16 h-12 object-cover rounded-lg shadow-sm">';
                }
                return '<div class="w-16 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                           <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                     d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                           </svg>
                       </div>';
            })
            ->addColumn('judul', function ($berita) {
                return '<div class="font-semibold text-gray-800">' . e($berita->judul_berita) . '</div>';
            })
            ->addColumn('excerpt', function ($berita) {
                // Limit excerpt untuk hindari memory issue dengan longtext
                $isi = $berita->isi_berita;
                if (strlen($isi) > 200) {
                    $isi = substr($isi, 0, 200);
                }
                $excerpt = strip_tags($isi);
                $excerpt = strlen($excerpt) > 100 ? substr($excerpt, 0, 100) . '...' : $excerpt;
                return '<div class="text-sm text-gray-600">' . e($excerpt) . '</div>';
            })
            ->addColumn('penulis', function ($berita) {
                $penulis = '<span class="text-gray-400">—</span>';
                if ($berita->user && $berita->user_id) {
                    $penulis = e($berita->user->name);
                } elseif ($berita->user_id) {
                    // Fallback jika user_id ada tapi relasi gagal
                    $penulis = '<span class="text-gray-400">User #' . $berita->user_id . '</span>';
                }
                return '<div class="text-xs text-gray-600">' . $penulis . '</div>';
            })
            ->addColumn('tanggal', function ($berita) {
                return '<div class="text-xs text-gray-600">' . $berita->created_at->format('d M Y') . '</div>';
            })
            ->addColumn('aksi', function ($berita) {
                $currentUser = Auth::user();
                $btn = '';

                if ($currentUser->hasPermission('edit_berita')) {
                    $btn .= '<a href="/berita/' . $berita->id . '/edit"
                                class="px-3 py-1.5 text-xs font-medium text-amber-700 bg-amber-50
                                       hover:bg-amber-100 rounded-lg transition-colors mr-1">
                                Edit
                             </a>';
                }

                if ($currentUser->hasPermission('delete_berita')) {
                    $btn .= '<button onclick="hapusBerita(' . $berita->id . ', \'' . addslashes($berita->judul_berita) . '\')"
                                class="px-3 py-1.5 text-xs font-medium text-red-600 bg-red-50
                                       hover:bg-red-100 rounded-lg transition-colors">
                                Hapus
                             </button>';
                }

                return $btn ?: '<span class="text-xs text-gray-400">—</span>';
            })
            ->rawColumns(['thumbnail', 'judul', 'excerpt', 'penulis', 'tanggal', 'aksi'])
            ->make(true);
    }

    public function create()
    {
        return view('berita.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_berita' => 'required|string|max:255',
            'isi_berita' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], [
            'judul_berita.required' => 'Judul berita wajib diisi.',
            'isi_berita.required' => 'Isi berita wajib diisi.',
            'thumbnail.image' => 'Thumbnail harus berupa gambar.',
            'thumbnail.mimes' => 'Thumbnail harus berformat jpeg, png, jpg, gif, atau webp.',
            'thumbnail.max' => 'Thumbnail maksimal 2MB.',
        ]);

        $validated['user_id'] = Auth::id();

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnailName = time() . '_' . str()->random(10) . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path('uploads/berita'), $thumbnailName);
            $validated['thumbnail'] = 'uploads/berita/' . $thumbnailName;
        }

        Berita::create($validated);

        return redirect()
            ->route('berita.index')
            ->with('success', 'Berita "' . $validated['judul_berita'] . '" berhasil ditambahkan.');
    }

    public function show($id)
    {
        $berita = Berita::with('user')->findOrFail($id);
        return view('berita.show', compact('berita'));
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('berita.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $validated = $request->validate([
            'judul_berita' => 'required|string|max:255',
            'isi_berita' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], [
            'judul_berita.required' => 'Judul berita wajib diisi.',
            'isi_berita.required' => 'Isi berita wajib diisi.',
            'thumbnail.image' => 'Thumbnail harus berupa gambar.',
            'thumbnail.mimes' => 'Thumbnail harus berformat jpeg, png, jpg, gif, atau webp.',
            'thumbnail.max' => 'Thumbnail maksimal 2MB.',
        ]);

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if exists
            if ($berita->thumbnail && file_exists(public_path($berita->thumbnail))) {
                unlink(public_path($berita->thumbnail));
            }

            $thumbnail = $request->file('thumbnail');
            $thumbnailName = time() . '_' . str()->random(10) . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path('uploads/berita'), $thumbnailName);
            $validated['thumbnail'] = 'uploads/berita/' . $thumbnailName;
        }

        $berita->update($validated);

        return redirect()
            ->route('berita.index')
            ->with('success', 'Berita "' . $berita->judul_berita . '" berhasil diperbarui.');
    }

    public function destroy($id)
    {
        try {
            $berita = Berita::findOrFail($id);
            $judul = $berita->judul_berita;

            // Delete thumbnail if exists
            if ($berita->thumbnail && file_exists(public_path($berita->thumbnail))) {
                unlink(public_path($berita->thumbnail));
            }

            $berita->delete();

            return response()->json([
                'success' => true,
                'message' => 'Berita "' . $judul . '" berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus berita.'
            ], 500);
        }
    }
}

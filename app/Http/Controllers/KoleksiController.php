<?php

namespace App\Http\Controllers;

use App\Models\Koleksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class KoleksiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->dataTable();
        }

        return view('koleksi.index');
    }

    private function dataTable()
    {
        $query = Koleksi::orderBy('created_at', 'desc');

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('foto', function ($koleksi) {
                if ($koleksi->foto_koleksi2) {
                    return '<img src="' . asset($koleksi->foto_koleksi2) . '" alt="' . e($koleksi->judul_koleksi2) . '"
                               class="w-20 h-14 object-cover rounded-lg shadow-sm">';
                }
                return '<div class="w-20 h-14 bg-gray-100 rounded-lg flex items-center justify-center">
                           <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                     d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                           </svg>
                       </div>';
            })
            ->addColumn('judul', function ($koleksi) {
                $kategoriBadge = '';
                if ($koleksi->kategori) {
                    $badgeColors = [
                        1 => 'bg-sky-100 text-sky-700',
                        2 => 'bg-purple-100 text-purple-700',
                        3 => 'bg-emerald-100 text-emerald-700',
                        4 => 'bg-amber-100 text-amber-700',
                    ];
                    $color = $badgeColors[$koleksi->kategori] ?? 'bg-gray-100 text-gray-700';
                    $kategoriBadge = '<span class="inline-block px-2 py-0.5 text-[10px] font-semibold rounded-md ' . $color . ' mb-1.5">' . e($koleksi->kategori_nama) . '</span>';
                }

                return '<div>' . $kategoriBadge . '
                        <div class="font-semibold text-gray-800">' . e($koleksi->judul_koleksi2) . '</div>
                        ' . ($koleksi->link ? '<div class="text-xs text-sky-600 mt-1"><svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>' . e(Str::limit($koleksi->link, 40)) . '</div>' : '') . '
                        </div>';
            })
            ->addColumn('kategori', function ($koleksi) {
                return $koleksi->kategori ? '<div class="text-xs text-gray-600">' . e($koleksi->kategori_nama) . '</div>' : '<span class="text-xs text-gray-400">—</span>';
            })
            ->addColumn('tanggal', function ($koleksi) {
                return '<div class="text-xs text-gray-600">' . $koleksi->created_at->format('d M Y') . '</div>';
            })
            ->addColumn('aksi', function ($koleksi) {
                $currentUser = Auth::user();
                $btn = '';

                if ($currentUser->hasPermission('edit_koleksi')) {
                    $btn .= '<a href="/koleksi/' . $koleksi->id . '/edit"
                                class="px-3 py-1.5 text-xs font-medium text-amber-700 bg-amber-50
                                       hover:bg-amber-100 rounded-lg transition-colors mr-1">
                                Edit
                             </a>';
                }

                if ($currentUser->hasPermission('delete_koleksi')) {
                    $btn .= '<button onclick="hapusKoleksi(' . $koleksi->id . ', \'' . addslashes($koleksi->judul_koleksi2) . '\')"
                                class="px-3 py-1.5 text-xs font-medium text-red-600 bg-red-50
                                       hover:bg-red-100 rounded-lg transition-colors">
                                Hapus
                             </button>';
                }

                return $btn ?: '<span class="text-xs text-gray-400">—</span>';
            })
            ->rawColumns(['foto', 'judul', 'kategori', 'tanggal', 'aksi'])
            ->make(true);
    }

    public function create()
    {
        return view('koleksi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_koleksi2' => 'required|string|max:255',
            'foto_koleksi2' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'kategori' => 'required|in:1,2,3,4',
            'link' => 'nullable|url|max:500',
            'isi_koleksi' => 'nullable|string',
        ], [
            'judul_koleksi2.required' => 'Judul koleksi wajib diisi.',
            'foto_koleksi2.required' => 'Foto koleksi wajib diupload.',
            'foto_koleksi2.image' => 'Foto harus berupa gambar.',
            'foto_koleksi2.mimes' => 'Foto harus berformat jpeg, png, jpg, gif, atau webp.',
            'foto_koleksi2.max' => 'Ukuran foto maksimal 2MB.',
            'kategori.required' => 'Kategori wajib dipilih.',
            'kategori.in' => 'Kategori tidak valid.',
            'link.url' => 'Link harus berupa URL yang valid.',
        ]);

        // Handle file upload
        if ($request->hasFile('foto_koleksi2')) {
            $file = $request->file('foto_koleksi2');
            $fileName = time() . '_' . Str::slug($validated['judul_koleksi2']) . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('uploads/koleksi', $fileName, 'public');
            $validated['foto_koleksi2'] = $filePath;
        }

        Koleksi::create($validated);

        return redirect()
            ->route('koleksi.index')
            ->with('success', 'Koleksi "' . $validated['judul_koleksi2'] . '" berhasil ditambahkan.');
    }

    public function show($id)
    {
        $koleksi = Koleksi::findOrFail($id);
        return view('koleksi.show', compact('koleksi'));
    }

    public function edit($id)
    {
        $koleksi = Koleksi::findOrFail($id);
        return view('koleksi.edit', compact('koleksi'));
    }

    public function update(Request $request, $id)
    {
        $koleksi = Koleksi::findOrFail($id);

        $validated = $request->validate([
            'judul_koleksi2' => 'required|string|max:255',
            'foto_koleksi2' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'kategori' => 'required|in:1,2,3,4',
            'link' => 'nullable|url|max:500',
            'isi_koleksi' => 'nullable|string',
        ], [
            'judul_koleksi2.required' => 'Judul koleksi wajib diisi.',
            'foto_koleksi2.image' => 'Foto harus berupa gambar.',
            'foto_koleksi2.mimes' => 'Foto harus berformat jpeg, png, jpg, gif, atau webp.',
            'foto_koleksi2.max' => 'Ukuran foto maksimal 2MB.',
            'kategori.required' => 'Kategori wajib dipilih.',
            'kategori.in' => 'Kategori tidak valid.',
            'link.url' => 'Link harus berupa URL yang valid.',
        ]);

        // Handle file upload
        if ($request->hasFile('foto_koleksi2')) {
            // Delete old photo
            if ($koleksi->foto_koleksi2) {
                $oldPath = public_path('storage/' . $koleksi->foto_koleksi2);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $file = $request->file('foto_koleksi2');
            $fileName = time() . '_' . Str::slug($validated['judul_koleksi2']) . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('uploads/koleksi', $fileName, 'public');
            $validated['foto_koleksi2'] = $filePath;
        }

        $koleksi->update($validated);

        return redirect()
            ->route('koleksi.index')
            ->with('success', 'Koleksi "' . $koleksi->judul_koleksi2 . '" berhasil diperbarui.');
    }

    public function destroy($id)
    {
        try {
            $koleksi = Koleksi::findOrFail($id);

            // Delete photo file
            if ($koleksi->foto_koleksi2) {
                $photoPath = public_path('storage/' . $koleksi->foto_koleksi2);
                if (file_exists($photoPath)) {
                    unlink($photoPath);
                }
            }

            $judul = $koleksi->judul_koleksi2;
            $koleksi->delete();

            return response()->json([
                'success' => true,
                'message' => 'Koleksi "' . $judul . '" berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus koleksi.'
            ], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\LinkAccess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class LinkAccessController extends Controller
{
    public function index(Request $request)
    {
        // DataTables serverSide selalu mengirim parameter 'draw'
        // Gunakan keduanya sebagai fallback agar lebih andal
        if ($request->ajax() || $request->has('draw')) {
            \Log::info('DataTable AJAX request received', [
                'user_id' => Auth::id(),
                'user_authenticated' => Auth::check(),
                'ajax' => $request->ajax(),
                'wants_json' => $request->wantsJson(),
                'has_draw' => $request->has('draw'),
            ]);
            return $this->dataTable();
        }

        return view('link-access.index');
    }

    private function dataTable()
    {
        \Log::info('DataTable method called', [
            'user_id' => Auth::id(),
            'user_authenticated' => Auth::check(),
        ]);

        $query = LinkAccess::with('user')
            ->select(['link_accesses.*'])
            ->orderBy('urutan', 'asc')
            ->orderBy('created_at', 'desc');

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('icon', function ($link) {
                if ($link->icon_svg) {
                    return '<div class="w-12 h-12 flex items-center justify-center">' . $link->icon_svg . '</div>';
                }
                return '<div class="w-12 h-12 flex items-center justify-center bg-gray-100 rounded-lg">
                           <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                     d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                           </svg>
                       </div>';
            })
            ->addColumn('judul', function ($link) {
                $statusBadge = $link->is_active
                    ? '<span class="px-2 py-0.5 text-[10px] font-semibold text-green-700 bg-green-50 border border-green-100 rounded-full">Aktif</span>'
                    : '<span class="px-2 py-0.5 text-[10px] font-semibold text-gray-700 bg-gray-50 border border-gray-100 rounded-full">Non-Aktif</span>';

                return '<div class="space-y-1">
                        <div class="font-semibold text-gray-800">' . e($link->judul) . '</div>
                        <div class="flex items-center gap-2">' . $statusBadge . '<span class="text-xs text-gray-500">Urutan: ' . $link->urutan . '</span></div>
                       </div>';
            })
            ->addColumn('url', function ($link) {
                return '<div class="text-sm text-blue-600 hover:underline max-w-xs truncate" title="' . e($link->url) . '">' . e($link->url) . '</div>';
            })
            ->addColumn('penulis', function ($link) {
                $penulis = '<span class="text-gray-400">—</span>';
                if ($link->user && $link->user_id) {
                    $penulis = e($link->user->name);
                } elseif ($link->user_id) {
                    $penulis = '<span class="text-gray-400">User #' . $link->user_id . '</span>';
                }
                return '<div class="text-xs text-gray-600">' . $penulis . '</div>';
            })
            ->addColumn('tanggal', function ($link) {
                return '<div class="text-xs text-gray-600">' . $link->created_at->format('d M Y') . '</div>';
            })
            ->addColumn('aksi', function ($link) {
                $currentUser = Auth::user();
                $btn = '';

                if ($currentUser && $currentUser->hasPermission('edit_link_access')) {
                    $btn .= '<a href="/menu/link-access/' . $link->id . '/edit"
                                class="px-2.5 py-1.5 text-[11px] font-semibold text-amber-700 bg-amber-50 border border-amber-100
                                       hover:bg-amber-100 rounded-lg transition-colors flex items-center gap-1">
                                Edit
                             </a>';
                }

                if ($currentUser && $currentUser->hasPermission('delete_link_access')) {
                    $btn .= '<button onclick="hapusLinkAccess(' . $link->id . ', \'' . addslashes($link->judul) . '\')"
                                class="px-2.5 py-1.5 text-[11px] font-semibold text-red-600 bg-red-50 border border-red-100
                                       hover:bg-red-100 rounded-lg transition-colors flex items-center gap-1">
                                Hapus
                             </button>';
                }

                return $btn ? '<div class="flex items-center gap-1.5">' . $btn . '</div>' : '<span class="text-xs text-gray-400">—</span>';
            })
            ->rawColumns(['icon', 'judul', 'url', 'penulis', 'tanggal', 'aksi'])
            ->make(true);
    }

    public function create()
    {
        return view('link-access.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'urutan' => 'required|integer|min:0',
        ], [
            'judul.required' => 'Judul link wajib diisi.',
            'url.required' => 'URL link wajib diisi.',
            'url.url' => 'Format URL tidak valid. Pastikan diawali dengan http:// atau https://',
            'urutan.required' => 'Urutan wajib diisi.',
            'urutan.integer' => 'Urutan harus berupa angka.',
            'urutan.min' => 'Urutan minimal 0.',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['is_active'] = $request->input('is_active', 0);

        LinkAccess::create($validated);

        return redirect()
            ->route('link-access.index')
            ->with('success', 'Link "' . $validated['judul'] . '" berhasil ditambahkan.');
    }

    public function show($id)
    {
        $link = LinkAccess::with('user')->findOrFail($id);
        return view('link-access.show', compact('link'));
    }

    public function edit($id)
    {
        $link = LinkAccess::findOrFail($id);
        return view('link-access.edit', compact('link'));
    }

    public function update(Request $request, $id)
    {
        $link = LinkAccess::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'urutan' => 'required|integer|min:0',
        ], [
            'judul.required' => 'Judul link wajib diisi.',
            'url.required' => 'URL link wajib diisi.',
            'url.url' => 'Format URL tidak valid. Pastikan diawali dengan http:// atau https://',
            'urutan.required' => 'Urutan wajib diisi.',
            'urutan.integer' => 'Urutan harus berupa angka.',
            'urutan.min' => 'Urutan minimal 0.',
        ]);

        $validated['is_active'] = $request->input('is_active', 0);

        $link->update($validated);

        return redirect()
            ->route('link-access.index')
            ->with('success', 'Link "' . $link->judul . '" berhasil diperbarui.');
    }

    public function destroy($id)
    {
        try {
            $link = LinkAccess::findOrFail($id);
            $judul = $link->judul;

            $link->delete();

            return response()->json([
                'success' => true,
                'message' => 'Link "' . $judul . '" berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus link.'
            ], 500);
        }
    }
}

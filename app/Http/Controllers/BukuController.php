<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->dataTable();
        }

        $kategoriBuku = KategoriBuku::active()->ordered()->get();
        $listPenerbit = Buku::select('penerbit')
            ->whereNotNull('penerbit')
            ->distinct()
            ->orderBy('penerbit')
            ->pluck('penerbit');

        $listTahun = Buku::select('tahun_terbit')
            ->whereNotNull('tahun_terbit')
            ->distinct()
            ->orderBy('tahun_terbit', 'desc')
            ->pluck('tahun_terbit');

        return view('buku.index', compact('kategoriBuku', 'listPenerbit', 'listTahun'));
    }

    private function dataTable()
    {
        $query = Buku::with('kategoriBuku')
            ->orderBy('created_at', 'desc');

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('sampul', function ($buku) {
                $sampulUrl = $buku->sampul_url;

                if ($sampulUrl) {
                    return '<img src="' . $sampulUrl . '" alt="' . e($buku->judul) . '"
                               class="w-16 h-20 object-cover rounded shadow-sm">';
                }

                return '<div class="w-16 h-20 bg-gray-100 rounded flex items-center justify-center">
                           <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                     d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                           </svg>
                       </div>';
            })
            ->addColumn('info_buku', function ($buku) {
                $kategoriBadge = '';
                if ($buku->kategoriBuku) {
                    $kategoriBadge = '<span class="inline-block px-2 py-0.5 text-[10px] font-semibold rounded-md bg-emerald-100 text-emerald-700 mb-1.5">' .
                        e($buku->kategoriBuku->nama) . '</span>';
                }

                $penulisText = $buku->penulis ?
                    '<div class="text-xs text-gray-600"><span class="font-medium">Penulis:</span> ' . e(Str::limit($buku->penulis, 60)) . '</div>' : '';

                $penerbitText = $buku->penerbit ?
                    '<div class="text-xs text-gray-600"><span class="font-medium">Penerbit:</span> ' . e($buku->penerbit) . '</div>' : '';

                $tahunText = $buku->tahun_terbit ?
                    '<div class="text-xs text-gray-600"><span class="font-medium">Tahun:</span> ' . e($buku->tahun_terbit) . '</div>' : '';

                $isbnText = $buku->isbn ?
                    '<div class="text-xs text-gray-600"><span class="font-medium">ISBN:</span> ' . e($buku->isbn) . '</div>' : '';

                return '<div>' .
                    $kategoriBadge .
                    '<div class="font-semibold text-gray-800">' . e($buku->judul) . '</div>' .
                    $penulisText .
                    $penerbitText .
                    $tahunText .
                    $isbnText .
                    '</div>';
            })
            ->addColumn('status', function ($buku) {
                if ($buku->is_published) {
                    return '<span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-semibold text-emerald-700 bg-emerald-50 border border-emerald-100 rounded-full">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Published
                    </span>';
                }
                return '<span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-semibold text-gray-700 bg-gray-50 border border-gray-100 rounded-full">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    Draft
                </span>';
            })
            ->addColumn('tanggal', function ($buku) {
                return '<div class="text-xs text-gray-600">' . $buku->created_at->format('d M Y') . '</div>';
            })
            ->addColumn('aksi', function ($buku) {
                $currentUser = Auth::user();
                $btn = '';

                $btn .= '<a href="/menu/buku/' . $buku->id . '"
                            class="px-2.5 py-1.5 text-[11px] font-semibold text-sky-700 bg-sky-50 border border-sky-100
                                   hover:bg-sky-100 rounded-lg transition-colors flex items-center gap-1 mb-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Lihat
                         </a>';

                if ($currentUser->hasPermission('edit_buku')) {
                    $btn .= '<a href="/menu/buku/' . $buku->id . '/edit"
                                class="px-2.5 py-1.5 text-[11px] font-semibold text-amber-700 bg-amber-50 border border-amber-100
                                       hover:bg-amber-100 rounded-lg transition-colors flex items-center gap-1 mb-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit
                             </a>';
                }

                if ($currentUser->hasPermission('delete_buku')) {
                    $btn .= '<button onclick="hapusBuku(' . $buku->id . ', \'' . addslashes($buku->judul) . '\')"
                                class="px-2.5 py-1.5 text-[11px] font-semibold text-red-600 bg-red-50 border border-red-100
                                       hover:bg-red-100 rounded-lg transition-colors flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Hapus
                             </button>';
                }

                return '<div class="flex flex-col gap-1">' . $btn . '</div>';
            })
            ->rawColumns(['sampul', 'info_buku', 'status', 'tanggal', 'aksi'])
            ->make(true);
    }

    public function create()
    {
        $kategoriBuku = KategoriBuku::active()->ordered()->get();
        return view('buku.create', compact('kategoriBuku'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'penulis' => 'nullable|max:500',
            'penerbit' => 'nullable|max:255',
            'tahun_terbit' => 'nullable|digits:4',
            'isbn' => 'nullable|max:50',
            'uraian' => 'nullable',
            'abstrak' => 'nullable',
            'sumber' => 'nullable|url|max:500',
            'sampul' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // 2MB
            'file_pdf' => 'nullable|mimes:pdf|max:10240', // 10MB
            'kategori_buku_id' => 'nullable|exists:kategori_buku,id',
            'is_published' => 'nullable|boolean',
        ]);

        $buku = new Buku();
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->penerbit = $request->penerbit;
        $buku->tahun_terbit = $request->tahun_terbit;
        $buku->isbn = $request->isbn;
        $buku->uraian = $request->uraian;
        $buku->abstrak = $request->abstrak;
        $buku->sumber = $request->sumber;
        $buku->kategori_buku_id = $request->kategori_buku_id;
        $buku->is_published = $request->is_published ?? true;

        // Handle sampul upload
        if ($request->hasFile('sampul')) {
            $file = $request->file('sampul');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('buku/covers', $filename, 'public');
            $buku->sampul = $filename;
        }

        // Handle PDF upload
        if ($request->hasFile('file_pdf')) {
            $file = $request->file('file_pdf');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('buku/pdfs', $filename, 'public');
            $buku->file_pdf = $filename;
        }

        $buku->save();

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil ditambahkan.');
    }

    public function show(Buku $buku)
    {
        $buku->load('kategoriBuku');
        return view('buku.show', compact('buku'));
    }

    public function edit(Buku $buku)
    {
        $kategoriBuku = KategoriBuku::active()->ordered()->get();
        return view('buku.edit', compact('buku', 'kategoriBuku'));
    }

    public function update(Request $request, Buku $buku)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'penulis' => 'nullable|max:500',
            'penerbit' => 'nullable|max:255',
            'tahun_terbit' => 'nullable|digits:4',
            'isbn' => 'nullable|max:50',
            'uraian' => 'nullable',
            'abstrak' => 'nullable',
            'sumber' => 'nullable|url|max:500',
            'sampul' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // 2MB
            'file_pdf' => 'nullable|mimes:pdf|max:10240', // 10MB
            'kategori_buku_id' => 'nullable|exists:kategori_buku,id',
            'is_published' => 'nullable|boolean',
        ]);

        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->penerbit = $request->penerbit;
        $buku->tahun_terbit = $request->tahun_terbit;
        $buku->isbn = $request->isbn;
        $buku->uraian = $request->uraian;
        $buku->abstrak = $request->abstrak;
        $buku->sumber = $request->sumber;
        $buku->kategori_buku_id = $request->kategori_buku_id;
        $buku->is_published = $request->is_published ?? true;

        // Handle sampul upload
        if ($request->hasFile('sampul')) {
            // Delete old file
            if ($buku->sampul && Storage::disk('public')->exists('buku/covers/' . $buku->sampul)) {
                Storage::disk('public')->delete('buku/covers/' . $buku->sampul);
            }

            $file = $request->file('sampul');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('buku/covers', $filename, 'public');
            $buku->sampul = $filename;
        }

        // Handle PDF upload
        if ($request->hasFile('file_pdf')) {
            // Delete old file
            if ($buku->file_pdf && Storage::disk('public')->exists('buku/pdfs/' . $buku->file_pdf)) {
                Storage::disk('public')->delete('buku/pdfs/' . $buku->file_pdf);
            }

            $file = $request->file('file_pdf');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('buku/pdfs', $filename, 'public');
            $buku->file_pdf = $filename;
        }

        $buku->save();

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy(Buku $buku)
    {
        // Delete files
        if ($buku->sampul && Storage::disk('public')->exists('buku/covers/' . $buku->sampul)) {
            Storage::disk('public')->delete('buku/covers/' . $buku->sampul);
        }

        if ($buku->file_pdf && Storage::disk('public')->exists('buku/pdfs/' . $buku->file_pdf)) {
            Storage::disk('public')->delete('buku/pdfs/' . $buku->file_pdf);
        }

        $buku->delete();

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil dihapus.');
    }
}

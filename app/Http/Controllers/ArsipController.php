<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\Facades\DataTables;

class ArsipController extends Controller
{
    // Dropdown options
    private $tingkatPerkembanganOptions = [
        'ASLI DAN COPY',
        'ASLI',
        'COPY',
    ];

    private $bentukOptions = [
        'TEKSTUAL',
        'GAMBAR',
        'TEKSTUAL DAN GAMBAR',
        'AUDIO VISUAL',
    ];

    private $keteranganOptions = [
        'TELAH DIGITALISASI',
        'BELUM DIGITALISASI',
    ];

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->dataTable();
        }

        return view('arsip.index', [
            'tingkatPerkembanganOptions' => $this->tingkatPerkembanganOptions,
            'bentukOptions' => $this->bentukOptions,
            'keteranganOptions' => $this->keteranganOptions,
        ]);
    }

    private function dataTable()
    {
        $query = Arsip::orderBy('tahun', 'desc')
            ->orderBy('indeks');

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('indeks_badge', function ($arsip) {
                return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-700">'
                    . e($arsip->indeks) .
                    '</span>';
            })
            ->addColumn('deskripsi', function ($arsip) {
                return '<div class="text-sm text-gray-800">' . e($arsip->deskripsi) . '</div>';
            })
            ->addColumn('tahun_badge', function ($arsip) {
                return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">'
                    . $arsip->tahun .
                    '</span>';
            })
            ->addColumn('jumlah_badge', function ($arsip) {
                return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-700">'
                    . e($arsip->jumlah) .
                    '</span>';
            })
            ->addColumn('lokasi', function ($arsip) {
                return '<span class="text-xs text-gray-600">' . e($arsip->lokasi_display) . '</span>';
            })
            ->addColumn('tingkat_badge', function ($arsip) {
                if (!$arsip->tingkat_perkembangan) {
                    return '<span class="text-xs text-gray-400">-</span>';
                }
                $colors = [
                    'ASLI DAN COPY' => 'bg-purple-100 text-purple-700',
                    'ASLI' => 'bg-blue-100 text-blue-700',
                    'COPY' => 'bg-green-100 text-green-700',
                ];
                $color = $colors[$arsip->tingkat_perkembangan] ?? 'bg-gray-100 text-gray-700';
                return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold ' . $color . '">'
                    . e($arsip->tingkat_perkembangan) .
                    '</span>';
            })
            ->addColumn('bentuk_badge', function ($arsip) {
                if (!$arsip->bentuk) {
                    return '<span class="text-xs text-gray-400">-</span>';
                }
                $colors = [
                    'TEKSTUAL' => 'bg-amber-100 text-amber-700',
                    'GAMBAR' => 'bg-pink-100 text-pink-700',
                    'TEKSTUAL DAN GAMBAR' => 'bg-orange-100 text-orange-700',
                    'AUDIO VISUAL' => 'bg-red-100 text-red-700',
                ];
                $color = $colors[$arsip->bentuk] ?? 'bg-gray-100 text-gray-700';
                return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold ' . $color . '">'
                    . e($arsip->bentuk) .
                    '</span>';
            })
            ->addColumn('keterangan_badge', function ($arsip) {
                if (!$arsip->keterangan) {
                    return '<span class="text-xs text-gray-400">-</span>';
                }
                $colors = [
                    'TELAH DIGITALISASI' => 'bg-teal-100 text-teal-700',
                    'BELUM DIGITALISASI' => 'bg-red-100 text-red-700',
                ];
                $color = $colors[$arsip->keterangan] ?? 'bg-gray-100 text-gray-700';
                return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold ' . $color . '">'
                    . e($arsip->keterangan) .
                    '</span>';
            })
            ->addColumn('aksi', function ($arsip) {
                $currentUser = Auth::user();
                $btn = '';

                if ($currentUser->hasPermission('edit_arsip')) {
                    $btn .= '<a href="/arsip/' . $arsip->id . '/edit"
                                class="px-3 py-1.5 text-xs font-medium text-amber-700 bg-amber-50
                                       hover:bg-amber-100 rounded-lg transition-colors mr-1">
                                Edit
                             </a>';
                }

                if ($currentUser->hasPermission('delete_arsip')) {
                    $btn .= '<button onclick="hapusArsip(' . $arsip->id . ', \'' . addslashes($arsip->indeks) . '\')"
                                class="px-3 py-1.5 text-xs font-medium text-red-600 bg-red-50
                                       hover:bg-red-100 rounded-lg transition-colors">
                                Hapus
                             </button>';
                }

                return $btn ?: '<span class="text-xs text-gray-400">—</span>';
            })
            ->rawColumns(['indeks_badge', 'deskripsi', 'tahun_badge', 'jumlah_badge', 'lokasi', 'tingkat_badge', 'bentuk_badge', 'keterangan_badge', 'aksi'])
            ->make(true);
    }

    public function create()
    {
        return view('arsip.create', [
            'tingkatPerkembanganOptions' => $this->tingkatPerkembanganOptions,
            'bentukOptions' => $this->bentukOptions,
            'keteranganOptions' => $this->keteranganOptions,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tingkat_perkembangan' => 'nullable|in:ASLI DAN COPY,ASLI,COPY',
            'bentuk' => 'nullable|in:TEKSTUAL,GAMBAR,TEKSTUAL DAN GAMBAR,AUDIO VISUAL',
            'keterangan' => 'nullable|in:TELAH DIGITALISASI,BELUM DIGITALISASI',
            'indeks' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'tahun' => 'required|integer|min:1900|max:2100',
            'jumlah' => 'required|string|max:255',
            'rak' => 'nullable|string|max:255',
            'roll_o_pack' => 'nullable|string|max:255',
            'boks' => 'nullable|string|max:255',
            'bungkus' => 'nullable|string|max:255',
            'buku' => 'nullable|string|max:255',
            'sampul' => 'nullable|string|max:255',
        ], [
            'indeks.required' => 'Indeks wajib diisi.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'tahun.required' => 'Tahun wajib diisi.',
            'jumlah.required' => 'Jumlah wajib diisi.',
        ]);

        Arsip::create($validated);

        return redirect()
            ->route('arsip.index')
            ->with('success', 'Arsip ' . $request->indeks . ' berhasil ditambahkan.');
    }

    public function show($id)
    {
        $arsip = Arsip::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $arsip->id,
                'tingkat_perkembangan' => $arsip->tingkat_perkembangan,
                'bentuk' => $arsip->bentuk,
                'keterangan' => $arsip->keterangan,
                'indeks' => $arsip->indeks,
                'deskripsi' => $arsip->deskripsi,
                'tahun' => $arsip->tahun,
                'jumlah' => $arsip->jumlah,
                'rak' => $arsip->rak,
                'roll_o_pack' => $arsip->roll_o_pack,
                'boks' => $arsip->boks,
                'bungkus' => $arsip->bungkus,
                'buku' => $arsip->buku,
                'sampul' => $arsip->sampul,
            ],
        ]);
    }

    public function edit($id)
    {
        $arsip = Arsip::findOrFail($id);

        return view('arsip.edit', [
            'arsip' => $arsip,
            'tingkatPerkembanganOptions' => $this->tingkatPerkembanganOptions,
            'bentukOptions' => $this->bentukOptions,
            'keteranganOptions' => $this->keteranganOptions,
        ]);
    }

    public function update(Request $request, $id)
    {
        $arsip = Arsip::findOrFail($id);

        $validated = $request->validate([
            'tingkat_perkembangan' => 'nullable|in:ASLI DAN COPY,ASLI,COPY',
            'bentuk' => 'nullable|in:TEKSTUAL,GAMBAR,TEKSTUAL DAN GAMBAR,AUDIO VISUAL',
            'keterangan' => 'nullable|in:TELAH DIGITALISASI,BELUM DIGITALISASI',
            'indeks' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'tahun' => 'required|integer|min:1900|max:2100',
            'jumlah' => 'required|string|max:255',
            'rak' => 'nullable|string|max:255',
            'roll_o_pack' => 'nullable|string|max:255',
            'boks' => 'nullable|string|max:255',
            'bungkus' => 'nullable|string|max:255',
            'buku' => 'nullable|string|max:255',
            'sampul' => 'nullable|string|max:255',
        ], [
            'indeks.required' => 'Indeks wajib diisi.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'tahun.required' => 'Tahun wajib diisi.',
            'jumlah.required' => 'Jumlah wajib diisi.',
        ]);

        $arsip->update($validated);

        return redirect()
            ->route('arsip.index')
            ->with('success', 'Arsip ' . $arsip->indeks . ' berhasil diperbarui.');
    }

    public function destroy($id)
    {
        try {
            $arsip = Arsip::findOrFail($id);
            $indeks = $arsip->indeks;
            $arsip->delete();

            return response()->json([
                'success' => true,
                'message' => 'Arsip ' . $indeks . ' berhasil dihapus.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus arsip.'
            ], 500);
        }
    }
}

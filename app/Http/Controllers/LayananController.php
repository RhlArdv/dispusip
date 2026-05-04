<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LayananController extends Controller
{
    /**
     * Tampilkan daftar semua layanan di admin, dikelompokkan per section.
     */
    public function index()
    {
        $layananUtama    = Layanan::utama()->orderBy('order_number')->get();
        $layananSekunder = Layanan::sekunder()->orderBy('order_number')->get();

        return view('layanans.index', compact('layananUtama', 'layananSekunder'));
    }

    /**
     * Form tambah layanan baru (HANYA untuk section sekunder).
     */
    public function create()
    {
        return view('layanans.create');
    }

    /**
     * Simpan layanan baru (HANYA section sekunder).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'url'         => ['required', 'string', 'max:500'],
            'link_type'   => ['required', Rule::in(['internal', 'external'])],
            'icon_svg'    => ['nullable', 'string'],
            'order_number'=> ['nullable', 'integer', 'min:0'],
            'is_active'   => ['nullable', 'boolean'],
        ]);

        // Paksa section selalu 'sekunder' dari form create
        $validated['section']   = 'sekunder';
        $validated['is_active'] = $request->boolean('is_active', true);

        Layanan::create($validated);

        return redirect()->route('layanans.index')
            ->with('success', 'Layanan berhasil ditambahkan.');
    }

    /**
     * Form edit layanan — berlaku untuk utama maupun sekunder.
     */
    public function edit(Layanan $layanan)
    {
        return view('layanans.edit', compact('layanan'));
    }

    /**
     * Update layanan.
     * Untuk section 'utama', field yang bisa diubah dibatasi hanya title, description, url, link_type, is_active.
     */
    public function update(Request $request, Layanan $layanan)
    {
        $rules = [
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'url'         => ['required', 'string', 'max:500'],
            'link_type'   => ['required', Rule::in(['internal', 'external'])],
            'is_active'   => ['nullable', 'boolean'],
        ];

        // Hanya section sekunder yang boleh ubah icon_svg dan order_number
        if ($layanan->section === 'sekunder') {
            $rules['icon_svg']     = ['nullable', 'string'];
            $rules['order_number'] = ['nullable', 'integer', 'min:0'];
        }

        $validated = $request->validate($rules);
        $validated['is_active'] = $request->boolean('is_active', true);

        $layanan->update($validated);

        return redirect()->route('layanans.index')
            ->with('success', 'Layanan berhasil diperbarui.');
    }

    /**
     * Hapus layanan — HANYA untuk section sekunder.
     * Section utama (Bento Grid) tidak boleh dihapus agar desain tetap utuh.
     */
    public function destroy(Layanan $layanan)
    {
        if ($layanan->isUtama()) {
            return redirect()->route('layanans.index')
                ->with('error', 'Layanan utama tidak dapat dihapus untuk menjaga konsistensi tampilan.');
        }

        $layanan->delete();

        return redirect()->route('layanans.index')
            ->with('success', 'Layanan berhasil dihapus.');
    }
}

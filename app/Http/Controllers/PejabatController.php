<?php

namespace App\Http\Controllers;

use App\Models\Pejabat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PejabatController extends Controller
{
    public function index()
    {
        $pejabats = Pejabat::orderBy('order_no')->get();
        return view('admin.pejabat.index', compact('pejabats'));
    }

    public function create()
    {
        return view('admin.pejabat.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50',
            'keterangan' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'order_no' => 'required|integer|min:0',
            'is_active' => 'nullable|boolean',
            'facebook' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('pejabat', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        Pejabat::create($validated);

        return redirect()->route('admin.pejabat.index')
            ->with('success', 'Data pejabat berhasil ditambahkan!');
    }

    public function edit(Pejabat $pejabat)
    {
        return view('admin.pejabat.edit', compact('pejabat'));
    }

    public function update(Request $request, Pejabat $pejabat)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50',
            'keterangan' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'order_no' => 'required|integer|min:0',
            'is_active' => 'nullable|boolean',
            'facebook' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($pejabat->image) {
                Storage::disk('public')->delete($pejabat->image);
            }
            $validated['image'] = $request->file('image')->store('pejabat', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        $pejabat->update($validated);

        return redirect()->route('admin.pejabat.index')
            ->with('success', 'Data pejabat berhasil diperbarui!');
    }

    public function destroy(Pejabat $pejabat)
    {
        if ($pejabat->image) {
            Storage::disk('public')->delete($pejabat->image);
        }

        $pejabat->delete();

        return response()->json(['message' => 'Data pejabat berhasil dihapus.']);
    }
}

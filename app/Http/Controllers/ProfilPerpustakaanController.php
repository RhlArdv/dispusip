<?php

namespace App\Http\Controllers;

use App\Models\ProfilPerpustakaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilPerpustakaanController extends Controller
{
    public function sejarah()
    {
        $data = ProfilPerpustakaan::where('slug', 'sejarah')->firstOrFail();
        return view('admin.profil_perpustakaan.edit', compact('data'));
    }

    public function tupoksi()
    {
        $data = ProfilPerpustakaan::where('slug', 'tupoksi')->firstOrFail();
        return view('admin.profil_perpustakaan.edit', compact('data'));
    }

    public function struktur()
    {
        $data = ProfilPerpustakaan::where('slug', 'struktur')->firstOrFail();
        return view('admin.profil_perpustakaan.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'nullable|string',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
        ]);

        $profil = ProfilPerpustakaan::findOrFail($id);

        $data = [
            'content'   => $request->content,
            'is_active' => $request->has('is_active'),
        ];

        if ($request->has('meta') && is_array($request->meta)) {
            $data['meta'] = $request->meta;
        }

        if ($request->hasFile('image')) {
            if ($profil->image && Storage::disk('public')->exists($profil->image)) {
                Storage::disk('public')->delete($profil->image);
            }
            $data['image'] = $request->file('image')->store('profil-perpustakaan', 'public');
        }

        $profil->update($data);

        return back()->with('success', 'Data berhasil disimpan!');
    }
}

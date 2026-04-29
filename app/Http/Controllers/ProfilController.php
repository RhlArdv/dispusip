<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use App\Models\Pejabat;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    // FRONTEND
    public function show($slug)
    {
        // Fetch all active profiles, keyed by slug for easy access in the single page
        $profiles = Profil::where('is_active', true)->get()->keyBy('slug');
        $activeSlug = $slug; // Optional: can be used to auto-scroll if needed

        // If the requested slug doesn't exist, we still show the page but maybe throw a 404 if it's completely invalid
        if (!$profiles->has($slug) && $slug !== 'index') {
            abort(404);
        }

        $pejabats    = Pejabat::active()->get();
        $kepalaDinas = $pejabats->first(); // order_no=1 is first

        return view('public.profil', compact('profiles', 'activeSlug', 'pejabats', 'kepalaDinas'));
    }


    // =====================
    // ADMIN
    // =====================

    public function tentangKami()
    {
        $data = Profil::where('slug', 'tentang-kami')->firstOrFail();
        return view('admin.profil.edit', compact('data'));
    }

    public function visiMisi()
    {
        $data = Profil::where('slug', 'visi-dan-misi')->firstOrFail();
        return view('admin.profil.edit', compact('data'));
    }

    public function strukturOrganisasi()
    {
        $data = Profil::where('slug', 'struktur-organisasi')->firstOrFail();
        return view('admin.profil.edit', compact('data'));
    }

    public function tupoksi()
    {
        $data = Profil::where('slug', 'tupoksi')->firstOrFail();
        return view('admin.profil.edit', compact('data'));
    }

    public function kontakKami()
    {
        $data = Profil::where('slug', 'kontak-kami')->firstOrFail();
        return view('admin.profil.edit', compact('data'));
    }

    // =====================
    // UPDATE (semua pakai ini)
    // =====================

    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $profil = Profil::findOrFail($id);
        
        $data = [
            'content' => $request->content,
            'is_active' => $request->has('is_active') ? true : false,
        ];

        if ($request->has('meta') && is_array($request->meta)) {
            $data['meta'] = $request->meta;
        }

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($profil->image && \Storage::disk('public')->exists($profil->image)) {
                \Storage::disk('public')->delete($profil->image);
            }
            $data['image'] = $request->file('image')->store('profil', 'public');
        }

        $profil->update($data);

        return back()->with('success', 'Data berhasil disimpan!');
    }
}
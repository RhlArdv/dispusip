<?php

namespace App\Http\Controllers;

use App\Models\Infografis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InfografisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $infografis = Infografis::orderBy('order')->get();
        return view('infografis.index', compact('infografis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('infografis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'order' => 'required|integer',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('infografis', 'public');
            $validated['image'] = $path;
        }

        $validated['is_active'] = $request->has('is_active');

        Infografis::create($validated);

        return redirect()->route('infografis.index')->with('success', 'Infografis berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Infografis $infografi)
    {
        return view('infografis.edit', compact('infografi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Infografis $infografi)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'order' => 'required|integer',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($infografi->image) {
                Storage::disk('public')->delete($infografi->image);
            }
            
            $path = $request->file('image')->store('infografis', 'public');
            $validated['image'] = $path;
        }

        $validated['is_active'] = $request->has('is_active');

        $infografi->update($validated);

        return redirect()->route('infografis.index')->with('success', 'Infografis berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Infografis $infografi)
    {
        if ($infografi->image) {
            Storage::disk('public')->delete($infografi->image);
        }
        
        $infografi->delete();

        return redirect()->route('infografis.index')->with('success', 'Infografis berhasil dihapus');
    }
}

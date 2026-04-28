<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $groups = ['maps', 'contact'];

        $settings = [];
        foreach ($groups as $group) {
            $settings[$group] = Setting::where('group', $group)->get()->keyBy('key');
        }

        if ($request->ajax()) {
            return response()->json($settings);
        }

        return view('settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        // Jika user tidak sengaja paste seluruh tag iframe, ekstrak atribut src-nya
        $mapsLink = $request->input('maps_embed_link');
        if ($mapsLink && preg_match('/src="([^"]+)"/', $mapsLink, $matches)) {
            $request->merge(['maps_embed_link' => $matches[1]]);
        } elseif ($mapsLink && str_contains($mapsLink, '" width')) {
            // Jika user copas url plus width attribute
            $mapsLink = explode('"', $mapsLink)[0];
            $request->merge(['maps_embed_link' => $mapsLink]);
        }

        $validated = $request->validate([
            'maps_embed_link' => 'nullable|url|max:2000',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:50',
            'contact_address' => 'nullable|string|max:500',
        ]);

        foreach ($validated as $key => $value) {
            if ($value !== null) {
                $type = 'text';
                if ($key === 'maps_embed_link') {
                    $type = 'text';
                } elseif (str_contains($key, 'email')) {
                    $type = 'email';
                }

                $group = str_contains($key, 'maps') ? 'maps' : 'contact';
                Setting::set($key, $value, $type, $group);
            }
        }

        return redirect()
            ->route('settings.index')
            ->with('success', 'Pengaturan berhasil diperbarui.');
    }
}

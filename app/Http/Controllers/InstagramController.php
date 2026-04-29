<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class InstagramController extends Controller
{
    public function index()
    {
        // Ganti dengan username IG Dispusip yang asli
        $username = 'dispusip_padang'; 
        
        // Simpan data di cache selama 12 jam (43200 detik)
        // Jadi server Kominfo cuma nembak API 2 kali sehari
        $posts = Cache::remember('ig_posts_' . $username, 43200, function () use ($username) {
            try {
                $response = Http::withHeaders([
                    'x-rapidapi-host' => env('RAPID_API_HOST'),
                    'x-rapidapi-key'  => env('RAPID_API_KEY'),
                ])->asForm()->post('https://' . env('RAPID_API_HOST') . '/get_ig_user_posts.php', [
                    'username' => $username, 
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    
                    // Asumsi struktur data ada di root atau key tertentu.
                    // Ambil maksimal 8 postingan terbaru agar layout grid Tailwind rapi.
                    // (Sesuaikan $data jika array aslinya ada di dalam key ['data'] atau ['items'])
                    return is_array($data) ? array_slice($data, 1, 8) : []; 
                }
            } catch (\Exception $e) {
                // Jika API error/timeout, kembalikan array kosong agar web tetap jalan
                return [];
            }

            return [];
        });

        // Lempar variabel $posts ke view (misalnya nama file blade-nya 'galeri.blade.php')
        return view('galeri', compact('posts'));
    }
}
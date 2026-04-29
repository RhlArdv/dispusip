<?php

namespace Database\Seeders;

use App\Models\Profil;
use Illuminate\Database\Seeder;

class ProfilSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['title' => 'Tentang Kami',         'slug' => 'tentang-kami',         'order' => 1],
            ['title' => 'Visi dan Misi',         'slug' => 'visi-dan-misi',        'order' => 2],
            ['title' => 'Struktur Organisasi',   'slug' => 'struktur-organisasi',  'order' => 3],
            ['title' => 'Tupoksi',               'slug' => 'tupoksi',              'order' => 4],
            ['title' => 'Kontak Kami',           'slug' => 'kontak-kami',          'order' => 5],
        ];

        foreach ($data as $item) {
            Profil::firstOrCreate(['slug' => $item['slug']], $item);
        }
    }
}
<?php

namespace Database\Seeders;

use App\Models\ProfilPerpustakaan;
use Illuminate\Database\Seeder;

class ProfilPerpustakaanSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'slug'       => 'sejarah',
                'title'      => 'Sejarah Perpustakaan',
                'content'    => '<p>Perpustakaan Daerah Kota Padang didirikan sebagai salah satu upaya pemerintah dalam meningkatkan minat baca dan budaya literasi masyarakat Kota Padang. Sejak berdirinya, perpustakaan ini telah menjadi pusat pengetahuan dan sumber informasi bagi seluruh lapisan masyarakat.</p><p>Seiring perkembangan zaman dan kebutuhan masyarakat, perpustakaan terus bertransformasi dengan menghadirkan layanan digital melalui platform E-Perpus DISPUSIP, yang memungkinkan akses koleksi buku kapan saja dan di mana saja.</p>',
                'image'      => null,
                'meta'       => null,
                'is_active'  => true,
            ],
            [
                'slug'       => 'tupoksi',
                'title'      => 'Tugas Pokok & Fungsi',
                'content'    => '<p>Bidang Perpustakaan mempunyai tugas pokok melaksanakan sebagian tugas Kepala Dinas dalam menyiapkan bahan perumusan kebijakan, pelaksanaan, pengkoordinasian, pemantauan, evaluasi, dan pelaporan di bidang perpustakaan.</p><h3>Fungsi Utama</h3><ul><li>Penyusunan rencana dan program kerja bidang perpustakaan</li><li>Pengelolaan dan pengembangan koleksi perpustakaan</li><li>Pelayanan perpustakaan kepada masyarakat umum</li><li>Pembinaan dan pengembangan minat baca masyarakat</li><li>Digitalisasi koleksi dan pengembangan layanan perpustakaan digital</li><li>Pelaksanaan kerjasama antar perpustakaan</li></ul>',
                'image'      => null,
                'meta'       => [
                    'fungsi' => '<ul><li>Penyusunan rencana program bidang perpustakaan</li><li>Pengelolaan dan pengembangan koleksi</li><li>Pelayanan kepada masyarakat</li><li>Pembinaan minat baca</li><li>Digitalisasi dan layanan digital</li><li>Kerjasama antar perpustakaan</li></ul>',
                ],
                'is_active'  => true,
            ],
            [
                'slug'       => 'struktur',
                'title'      => 'Struktur Bidang Perpustakaan',
                'content'    => '<p>Struktur organisasi Bidang Perpustakaan DISPUSIP Kota Padang terdiri dari Kepala Bidang, Kepala Seksi Layanan Perpustakaan, dan Kepala Seksi Pengembangan Koleksi & Teknologi Perpustakaan.</p>',
                'image'      => null,
                'meta'       => null,
                'is_active'  => true,
            ],
        ];

        foreach ($items as $item) {
            ProfilPerpustakaan::updateOrCreate(
                ['slug' => $item['slug']],
                $item
            );
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Layanan;
use Illuminate\Database\Seeder;

class LayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Data ini persis menyalin konten statis yang ada di eperpus/index.blade.php
     */
    public function run(): void
    {
        // ============================================================
        // SECTION UTAMA - Bento Grid (5 item, TIDAK bisa tambah/hapus)
        // Style tiap card hardcoded di view karena desain berbeda-beda
        // ============================================================
        $layananUtama = [
            [
                'title'         => 'Onesearch.id',
                'description'   => 'Pintu pencarian tunggal untuk semua koleksi publik dari perpustakaan di Indonesia.',
                'url'           => 'https://onesearch.id/',
                'link_type'     => 'external',
                'section'       => 'utama',
                'badge_label'   => null,
                'bg_image'      => null,
                'icon_svg'      => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>',
                'style_variant' => 'light',
                'order_number'  => 1,
                'is_active'     => true,
            ],
            [
                'title'         => 'OPAC & E-Library',
                'description'   => 'Eksplorasi dan pinjam ribuan koleksi literatur digital secara instan dari mana saja.',
                'url'           => 'https://inlislite.pdg.web.id/opac',
                'link_type'     => 'external',
                'section'       => 'utama',
                'badge_label'   => 'Katalog',
                'bg_image'      => 'https://images.unsplash.com/photo-1507842217343-583bb7270b66?auto=format&fit=crop&q=80&w=1200',
                'icon_svg'      => null,
                'style_variant' => 'image',
                'order_number'  => 2,
                'is_active'     => true,
            ],
            [
                'title'         => 'Daftar Anggota',
                'description'   => 'Gabung sekarang dan nikmati seluruh akses layanan eksklusif kami.',
                'url'           => 'https://inlislite.pdg.web.id/pendaftaran',
                'link_type'     => 'external',
                'section'       => 'utama',
                'badge_label'   => 'Registrasi',
                'bg_image'      => null,
                'icon_svg'      => '<svg class="w-64 h-64" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>',
                'style_variant' => 'gold',
                'order_number'  => 3,
                'is_active'     => true,
            ],
            [
                'title'         => 'iPusnas',
                'description'   => 'Aplikasi perpustakaan digital nasional berbasis media sosial.',
                'url'           => 'https://ipusnas.id/',
                'link_type'     => 'external',
                'section'       => 'utama',
                'badge_label'   => null,
                'bg_image'      => null,
                'icon_svg'      => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>',
                'style_variant' => 'dark',
                'order_number'  => 4,
                'is_active'     => true,
            ],
            [
                'title'         => 'Agenda Kegiatan',
                'description'   => 'Informasi lengkap terkait jadwal acara dan aktivitas dinas perpustakaan.',
                'url'           => '/kegiatan',
                'link_type'     => 'internal',
                'section'       => 'utama',
                'badge_label'   => null,
                'bg_image'      => null,
                'icon_svg'      => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>',
                'style_variant' => 'light',
                'order_number'  => 5,
                'is_active'     => true,
            ],
        ];

        // ===================================================================
        // SECTION SEKUNDER - Layanan Perpustakaan (Grid 4 kolom, bisa CRUD)
        // ===================================================================
        $layananSekunder = [
            [
                'title'         => 'Layanan ISBN & QRCBN',
                'description'   => 'Pengajuan nomor standar buku dan kode QR.',
                'url'           => '#',
                'link_type'     => 'external',
                'section'       => 'sekunder',
                'badge_label'   => null,
                'bg_image'      => null,
                'icon_svg'      => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>',
                'style_variant' => null,
                'order_number'  => 1,
                'is_active'     => true,
            ],
            [
                'title'         => 'Data Perpustakaan',
                'description'   => 'Pangkalan data perpustakaan se-Kota Padang.',
                'url'           => '#',
                'link_type'     => 'external',
                'section'       => 'sekunder',
                'badge_label'   => null,
                'bg_image'      => null,
                'icon_svg'      => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>',
                'style_variant' => null,
                'order_number'  => 2,
                'is_active'     => true,
            ],
            [
                'title'         => 'JDIH Perpustakaan',
                'description'   => 'Jaringan Dokumentasi dan Informasi Hukum.',
                'url'           => '/jdih',
                'link_type'     => 'internal',
                'section'       => 'sekunder',
                'badge_label'   => null,
                'bg_image'      => null,
                'icon_svg'      => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>',
                'style_variant' => null,
                'order_number'  => 3,
                'is_active'     => true,
            ],
            [
                'title'         => 'FAQ Perpustakaan',
                'description'   => 'Pertanyaan umum seputar layanan kami.',
                'url'           => '/#faq',
                'link_type'     => 'external',
                'section'       => 'sekunder',
                'badge_label'   => null,
                'bg_image'      => null,
                'icon_svg'      => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>',
                'style_variant' => null,
                'order_number'  => 4,
                'is_active'     => true,
            ],
        ];

        foreach ($layananUtama as $data) {
            Layanan::create($data);
        }

        foreach ($layananSekunder as $data) {
            Layanan::create($data);
        }
    }
}

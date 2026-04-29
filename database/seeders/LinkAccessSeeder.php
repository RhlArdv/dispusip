<?php

namespace Database\Seeders;

use App\Models\LinkAccess;
use Illuminate\Database\Seeder;

class LinkAccessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $links = [
            [
                'judul' => 'OPAC / Katalog',
                'url' => 'https://inlislite.pdg.web.id/opac',
                'icon_svg' => '<svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>',
                'urutan' => 1,
                'is_active' => true,
            ],
            [
                'judul' => 'E-Perpus',
                'url' => 'https://inlislite.pdg.web.id',
                'icon_svg' => '<svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>',
                'urutan' => 2,
                'is_active' => true,
            ],
            [
                'judul' => 'SIKN / Jaringan Arsip',
                'url' => '/arsip',
                'icon_svg' => '<svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                </svg>',
                'urutan' => 3,
                'is_active' => true,
            ],
            [
                'judul' => 'Daftar Anggota',
                'url' => 'https://inlislite.pdg.web.id/pendaftaran',
                'icon_svg' => '<svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>',
                'urutan' => 4,
                'is_active' => true,
            ],
            [
                'judul' => 'JDIH',
                'url' => '/jdih',
                'icon_svg' => '<svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>',
                'urutan' => 5,
                'is_active' => true,
            ],
            [
                'judul' => 'Layanan Srikandi',
                'url' => '#',
                'icon_svg' => null,
                'urutan' => 6,
                'is_active' => true,
            ],
        ];

        // Get admin user (first user) for user_id
        $adminUser = \App\Models\User::first();

        foreach ($links as $link) {
            LinkAccess::create([
                'judul' => $link['judul'],
                'url' => $link['url'],
                'icon_svg' => $link['icon_svg'],
                'urutan' => $link['urutan'],
                'is_active' => $link['is_active'],
                'user_id' => $adminUser ? $adminUser->id : 1,
            ]);
        }
    }
}

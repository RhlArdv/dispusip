<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // User Management
            ['key' => 'view_users', 'display_name' => 'View Users', 'group' => 'User Management', 'description' => 'Melihat daftar users'],
            ['key' => 'create_users', 'display_name' => 'Create Users', 'group' => 'User Management', 'description' => 'Membuat user baru'],
            ['key' => 'edit_users', 'display_name' => 'Edit Users', 'group' => 'User Management', 'description' => 'Mengedit data user'],
            ['key' => 'delete_users', 'display_name' => 'Delete Users', 'group' => 'User Management', 'description' => 'Menghapus user'],

            // Arsip Management
            ['key' => 'view_arsip', 'display_name' => 'View Arsip', 'group' => 'Arsip Management', 'description' => 'Melihat daftar arsip'],
            ['key' => 'create_arsip', 'display_name' => 'Create Arsip', 'group' => 'Arsip Management', 'description' => 'Menambah arsip baru'],
            ['key' => 'edit_arsip', 'display_name' => 'Edit Arsip', 'group' => 'Arsip Management', 'description' => 'Mengedit data arsip'],
            ['key' => 'delete_arsip', 'display_name' => 'Delete Arsip', 'group' => 'Arsip Management', 'description' => 'Menghapus arsip'],
            ['key' => 'export_arsip', 'display_name' => 'Export Arsip', 'group' => 'Arsip Management', 'description' => 'Export data arsip ke Excel'],
            ['key' => 'import_arsip', 'display_name' => 'Import Arsip', 'group' => 'Arsip Management', 'description' => 'Import data arsip dari Excel'],

            // Kategori & Reference
            ['key' => 'view_kategori', 'display_name' => 'View Kategori', 'group' => 'Kategori & Reference', 'description' => 'Melihat daftar kategori'],
            ['key' => 'create_kategori', 'display_name' => 'Create Kategori', 'group' => 'Kategori & Reference', 'description' => 'Membuat kategori baru'],
            ['key' => 'edit_kategori', 'display_name' => 'Edit Kategori', 'group' => 'Kategori & Reference', 'description' => 'Mengedit kategori'],
            ['key' => 'delete_kategori', 'display_name' => 'Delete Kategori', 'group' => 'Kategori & Reference', 'description' => 'Menghapus kategori'],

            ['key' => 'view_bentuk', 'display_name' => 'View Bentuk', 'group' => 'Kategori & Reference', 'description' => 'Melihat daftar bentuk arsip'],
            ['key' => 'create_bentuk', 'display_name' => 'Create Bentuk', 'group' => 'Kategori & Reference', 'description' => 'Membuat bentuk arsip baru'],
            ['key' => 'edit_bentuk', 'display_name' => 'Edit Bentuk', 'group' => 'Kategori & Reference', 'description' => 'Mengedit bentuk arsip'],
            ['key' => 'delete_bentuk', 'display_name' => 'Delete Bentuk', 'group' => 'Kategori & Reference', 'description' => 'Menghapus bentuk arsip'],

            // Laporan
            ['key' => 'view_laporan_arsip', 'display_name' => 'View Laporan Arsip', 'group' => 'Laporan', 'description' => 'Melihat laporan arsip'],
            ['key' => 'download_laporan_arsip', 'display_name' => 'Download Laporan Arsip', 'group' => 'Laporan', 'description' => 'Download laporan arsip'],
            ['key' => 'view_laporan_pustaka', 'display_name' => 'View Laporan Pustaka', 'group' => 'Laporan', 'description' => 'Melihat laporan pustaka'],
            ['key' => 'download_laporan_pustaka', 'display_name' => 'Download Laporan Pustaka', 'group' => 'Laporan', 'description' => 'Download laporan pustaka'],

            // Content Management
            ['key' => 'view_berita', 'display_name' => 'View Berita', 'group' => 'Content Management', 'description' => 'Melihat daftar berita'],
            ['key' => 'create_berita', 'display_name' => 'Create Berita', 'group' => 'Content Management', 'description' => 'Membuat berita baru'],
            ['key' => 'edit_berita', 'display_name' => 'Edit Berita', 'group' => 'Content Management', 'description' => 'Mengedit berita'],
            ['key' => 'delete_berita', 'display_name' => 'Delete Berita', 'group' => 'Content Management', 'description' => 'Menghapus berita'],

            ['key' => 'view_galeri', 'display_name' => 'View Galeri', 'group' => 'Content Management', 'description' => 'Melihat daftar galeri'],
            ['key' => 'create_galeri', 'display_name' => 'Create Galeri', 'group' => 'Content Management', 'description' => 'Membuat galeri baru'],
            ['key' => 'edit_galeri', 'display_name' => 'Edit Galeri', 'group' => 'Content Management', 'description' => 'Mengedit galeri'],
            ['key' => 'delete_galeri', 'display_name' => 'Delete Galeri', 'group' => 'Content Management', 'description' => 'Menghapus galeri'],

            ['key' => 'view_video', 'display_name' => 'View Video', 'group' => 'Content Management', 'description' => 'Melihat daftar video'],
            ['key' => 'create_video', 'display_name' => 'Create Video', 'group' => 'Content Management', 'description' => 'Membuat video baru'],
            ['key' => 'edit_video', 'display_name' => 'Edit Video', 'group' => 'Content Management', 'description' => 'Mengedit video'],
            ['key' => 'delete_video', 'display_name' => 'Delete Video', 'group' => 'Content Management', 'description' => 'Menghapus video'],

            // Settings
            ['key' => 'view_settings', 'display_name' => 'View Settings', 'group' => 'Settings', 'description' => 'Melihat pengaturan sistem'],
            ['key' => 'edit_settings', 'display_name' => 'Edit Settings', 'group' => 'Settings', 'description' => 'Mengedit pengaturan sistem'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

        // Assign permissions to roles
        $adminRole = Role::where('name', 'admin')->first();
        $arsipRole = Role::where('name', 'arsip')->first();
        $pustakaRole = Role::where('name', 'pustaka')->first();

        // Admin gets ALL permissions automatically via isAdmin() method
        // But we can also assign explicitly if needed
        // $adminRole->permissions()->attach(Permission::pluck('id'));

        // Arsip role: Arsip management + kategori + laporan arsip
        $arsipPermissions = [
            'view_arsip', 'create_arsip', 'edit_arsip', 'delete_arsip', 'export_arsip', 'import_arsip',
            'view_kategori', 'create_kategori', 'edit_kategori', 'delete_kategori',
            'view_bentuk', 'create_bentuk', 'edit_bentuk', 'delete_bentuk',
            'view_laporan_arsip', 'download_laporan_arsip',
        ];

        foreach ($arsipPermissions as $key) {
            $permission = Permission::where('key', $key)->first();
            if ($permission) {
                $arsipRole->permissions()->attach($permission->id);
            }
        }

        // Pustaka role: View arsip + laporan pustaka + content management
        $pustakaPermissions = [
            'view_arsip',
            'view_laporan_pustaka', 'download_laporan_pustaka',
            'view_berita', 'create_berita', 'edit_berita', 'delete_berita',
            'view_galeri', 'create_galeri', 'edit_galeri', 'delete_galeri',
            'view_video', 'create_video', 'edit_video', 'delete_video',
        ];

        foreach ($pustakaPermissions as $key) {
            $permission = Permission::where('key', $key)->first();
            if ($permission) {
                $pustakaRole->permissions()->attach($permission->id);
            }
        }
    }
}

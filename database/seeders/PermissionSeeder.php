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

            // Role Management
            ['key' => 'view_roles', 'display_name' => 'View Roles', 'group' => 'Role Management', 'description' => 'Melihat daftar roles'],
            ['key' => 'create_roles', 'display_name' => 'Create Roles', 'group' => 'Role Management', 'description' => 'Membuat role baru'],
            ['key' => 'edit_roles', 'display_name' => 'Edit Roles', 'group' => 'Role Management', 'description' => 'Mengedit data role'],
            ['key' => 'delete_roles', 'display_name' => 'Delete Roles', 'group' => 'Role Management', 'description' => 'Menghapus role'],

            // Arsip
            ['key' => 'view_arsip', 'display_name' => 'View Arsip', 'group' => 'Arsip', 'description' => 'Melihat daftar arsip'],
            ['key' => 'create_arsip', 'display_name' => 'Create Arsip', 'group' => 'Arsip', 'description' => 'Menambah arsip baru'],
            ['key' => 'edit_arsip', 'display_name' => 'Edit Arsip', 'group' => 'Arsip', 'description' => 'Mengedit data arsip'],
            ['key' => 'delete_arsip', 'display_name' => 'Delete Arsip', 'group' => 'Arsip', 'description' => 'Menghapus arsip'],
            ['key' => 'export_arsip', 'display_name' => 'Export Arsip', 'group' => 'Arsip', 'description' => 'Export data arsip ke Excel'],
            ['key' => 'import_arsip', 'display_name' => 'Import Arsip', 'group' => 'Arsip', 'description' => 'Import data arsip dari Excel'],

            // Kategori Arsip
            ['key' => 'view_kategori', 'display_name' => 'View Kategori', 'group' => 'Kategori Arsip', 'description' => 'Melihat daftar kategori'],
            ['key' => 'create_kategori', 'display_name' => 'Create Kategori', 'group' => 'Kategori Arsip', 'description' => 'Membuat kategori baru'],
            ['key' => 'edit_kategori', 'display_name' => 'Edit Kategori', 'group' => 'Kategori Arsip', 'description' => 'Mengedit kategori'],
            ['key' => 'delete_kategori', 'display_name' => 'Delete Kategori', 'group' => 'Kategori Arsip', 'description' => 'Menghapus kategori'],

            // Bentuk Arsip
            ['key' => 'view_bentuk', 'display_name' => 'View Bentuk', 'group' => 'Bentuk Arsip', 'description' => 'Melihat daftar bentuk arsip'],
            ['key' => 'create_bentuk', 'display_name' => 'Create Bentuk', 'group' => 'Bentuk Arsip', 'description' => 'Membuat bentuk arsip baru'],
            ['key' => 'edit_bentuk', 'display_name' => 'Edit Bentuk', 'group' => 'Bentuk Arsip', 'description' => 'Mengedit bentuk arsip'],
            ['key' => 'delete_bentuk', 'display_name' => 'Delete Bentuk', 'group' => 'Bentuk Arsip', 'description' => 'Menghapus bentuk arsip'],

            // Berita
            ['key' => 'view_berita', 'display_name' => 'View Berita', 'group' => 'Berita', 'description' => 'Melihat daftar berita'],
            ['key' => 'create_berita', 'display_name' => 'Create Berita', 'group' => 'Berita', 'description' => 'Membuat berita baru'],
            ['key' => 'edit_berita', 'display_name' => 'Edit Berita', 'group' => 'Berita', 'description' => 'Mengedit berita'],
            ['key' => 'delete_berita', 'display_name' => 'Delete Berita', 'group' => 'Berita', 'description' => 'Menghapus berita'],

            // Koleksi
            ['key' => 'view_koleksi', 'display_name' => 'View Koleksi', 'group' => 'Koleksi', 'description' => 'Melihat daftar koleksi'],
            ['key' => 'create_koleksi', 'display_name' => 'Create Koleksi', 'group' => 'Koleksi', 'description' => 'Membuat koleksi baru'],
            ['key' => 'edit_koleksi', 'display_name' => 'Edit Koleksi', 'group' => 'Koleksi', 'description' => 'Mengedit koleksi'],
            ['key' => 'delete_koleksi', 'display_name' => 'Delete Koleksi', 'group' => 'Koleksi', 'description' => 'Menghapus koleksi'],

            // Kategori Buku
            ['key' => 'view_kategori_buku', 'display_name' => 'View Kategori Buku', 'group' => 'Kategori Buku', 'description' => 'Melihat daftar kategori buku'],
            ['key' => 'create_kategori_buku', 'display_name' => 'Create Kategori Buku', 'group' => 'Kategori Buku', 'description' => 'Membuat kategori buku baru'],
            ['key' => 'edit_kategori_buku', 'display_name' => 'Edit Kategori Buku', 'group' => 'Kategori Buku', 'description' => 'Mengedit kategori buku'],
            ['key' => 'delete_kategori_buku', 'display_name' => 'Delete Kategori Buku', 'group' => 'Kategori Buku', 'description' => 'Menghapus kategori buku'],

            // Buku
            ['key' => 'view_buku', 'display_name' => 'View Buku', 'group' => 'Buku', 'description' => 'Melihat daftar buku'],
            ['key' => 'create_buku', 'display_name' => 'Create Buku', 'group' => 'Buku', 'description' => 'Membuat buku baru'],
            ['key' => 'edit_buku', 'display_name' => 'Edit Buku', 'group' => 'Buku', 'description' => 'Mengedit buku'],
            ['key' => 'delete_buku', 'display_name' => 'Delete Buku', 'group' => 'Buku', 'description' => 'Menghapus buku'],

            // Kegiatan
            ['key' => 'view_kegiatan', 'display_name' => 'View Kegiatan', 'group' => 'Kegiatan', 'description' => 'Melihat daftar kegiatan'],
            ['key' => 'create_kegiatan', 'display_name' => 'Create Kegiatan', 'group' => 'Kegiatan', 'description' => 'Membuat kegiatan baru'],
            ['key' => 'edit_kegiatan', 'display_name' => 'Edit Kegiatan', 'group' => 'Kegiatan', 'description' => 'Mengedit kegiatan'],
            ['key' => 'delete_kegiatan', 'display_name' => 'Delete Kegiatan', 'group' => 'Kegiatan', 'description' => 'Menghapus kegiatan'],

            // FAQ
            ['key' => 'view_faq', 'display_name' => 'View FAQ', 'group' => 'FAQ', 'description' => 'Melihat daftar FAQ'],
            ['key' => 'create_faq', 'display_name' => 'Create FAQ', 'group' => 'FAQ', 'description' => 'Membuat FAQ baru'],
            ['key' => 'edit_faq', 'display_name' => 'Edit FAQ', 'group' => 'FAQ', 'description' => 'Mengedit FAQ'],
            ['key' => 'delete_faq', 'display_name' => 'Delete FAQ', 'group' => 'FAQ', 'description' => 'Menghapus FAQ'],

            // Testimoni
            ['key' => 'view_testimoni', 'display_name' => 'View Testimoni', 'group' => 'Testimoni', 'description' => 'Melihat daftar testimoni'],
            ['key' => 'create_testimoni', 'display_name' => 'Create Testimoni', 'group' => 'Testimoni', 'description' => 'Membuat testimoni baru'],
            ['key' => 'edit_testimoni', 'display_name' => 'Edit Testimoni', 'group' => 'Testimoni', 'description' => 'Mengedit testimoni'],
            ['key' => 'delete_testimoni', 'display_name' => 'Delete Testimoni', 'group' => 'Testimoni', 'description' => 'Menghapus testimoni'],

            // Agenda
            ['key' => 'view_agenda', 'display_name' => 'View Agenda', 'group' => 'Agenda', 'description' => 'Melihat daftar agenda'],
            ['key' => 'create_agenda', 'display_name' => 'Create Agenda', 'group' => 'Agenda', 'description' => 'Membuat agenda baru'],
            ['key' => 'edit_agenda', 'display_name' => 'Edit Agenda', 'group' => 'Agenda', 'description' => 'Mengedit agenda'],
            ['key' => 'delete_agenda', 'display_name' => 'Delete Agenda', 'group' => 'Agenda', 'description' => 'Menghapus agenda'],

            // Infografis
            ['key' => 'view_infografis', 'display_name' => 'View Infografis', 'group' => 'Infografis', 'description' => 'Melihat daftar infografis'],
            ['key' => 'create_infografis', 'display_name' => 'Create Infografis', 'group' => 'Infografis', 'description' => 'Membuat infografis baru'],
            ['key' => 'edit_infografis', 'display_name' => 'Edit Infografis', 'group' => 'Infografis', 'description' => 'Mengedit infografis'],
            ['key' => 'delete_infografis', 'display_name' => 'Delete Infografis', 'group' => 'Infografis', 'description' => 'Menghapus infografis'],

            // Pejabat
            ['key' => 'view_pejabat', 'display_name' => 'View Pejabat', 'group' => 'Pejabat', 'description' => 'Melihat daftar pejabat'],
            ['key' => 'create_pejabat', 'display_name' => 'Create Pejabat', 'group' => 'Pejabat', 'description' => 'Membuat pejabat baru'],
            ['key' => 'edit_pejabat', 'display_name' => 'Edit Pejabat', 'group' => 'Pejabat', 'description' => 'Mengedit pejabat'],
            ['key' => 'delete_pejabat', 'display_name' => 'Delete Pejabat', 'group' => 'Pejabat', 'description' => 'Menghapus pejabat'],

            // Link Access
            ['key' => 'view_link_access', 'display_name' => 'View Link Access', 'group' => 'Link Access', 'description' => 'Melihat daftar link access'],
            ['key' => 'create_link_access', 'display_name' => 'Create Link Access', 'group' => 'Link Access', 'description' => 'Membuat link access baru'],
            ['key' => 'edit_link_access', 'display_name' => 'Edit Link Access', 'group' => 'Link Access', 'description' => 'Mengedit link access'],
            ['key' => 'delete_link_access', 'display_name' => 'Delete Link Access', 'group' => 'Link Access', 'description' => 'Menghapus link access'],

            // Tickets
            ['key' => 'view_tickets', 'display_name' => 'View Tickets', 'group' => 'Tickets', 'description' => 'Melihat daftar tickets'],
            ['key' => 'edit_tickets', 'display_name' => 'Edit Tickets', 'group' => 'Tickets', 'description' => 'Mengedit status tickets'],
            ['key' => 'delete_tickets', 'display_name' => 'Delete Tickets', 'group' => 'Tickets', 'description' => 'Menghapus tickets'],

            // Profil
            ['key' => 'view_profil', 'display_name' => 'View Profil', 'group' => 'Profil', 'description' => 'Melihat halaman profil'],
            ['key' => 'edit_profil_tentang', 'display_name' => 'Edit Profil Tentang Kami', 'group' => 'Profil', 'description' => 'Mengedit halaman tentang kami'],
            ['key' => 'edit_profil_visimisi', 'display_name' => 'Edit Profil Visi Misi', 'group' => 'Profil', 'description' => 'Mengedit halaman visi misi'],
            ['key' => 'edit_profil_struktur', 'display_name' => 'Edit Profil Struktur', 'group' => 'Profil', 'description' => 'Mengedit halaman struktur organisasi'],
            ['key' => 'edit_profil_tupoksi', 'display_name' => 'Edit Profil Tupoksi', 'group' => 'Profil', 'description' => 'Mengedit halaman tupoksi'],
            ['key' => 'edit_profil_kontak', 'display_name' => 'Edit Profil Kontak', 'group' => 'Profil', 'description' => 'Mengedit halaman kontak kami'],

            // Laporan Arsip
            ['key' => 'view_laporan_arsip', 'display_name' => 'View Laporan Arsip', 'group' => 'Laporan Arsip', 'description' => 'Melihat laporan arsip'],
            ['key' => 'download_laporan_arsip', 'display_name' => 'Download Laporan Arsip', 'group' => 'Laporan Arsip', 'description' => 'Download laporan arsip'],

            // Laporan Pustaka
            ['key' => 'view_laporan_pustaka', 'display_name' => 'View Laporan Pustaka', 'group' => 'Laporan Pustaka', 'description' => 'Melihat laporan pustaka'],
            ['key' => 'download_laporan_pustaka', 'display_name' => 'Download Laporan Pustaka', 'group' => 'Laporan Pustaka', 'description' => 'Download laporan pustaka'],

            // Settings
            ['key' => 'view_settings', 'display_name' => 'View Settings', 'group' => 'Settings', 'description' => 'Melihat pengaturan sistem'],
            ['key' => 'edit_settings', 'display_name' => 'Edit Settings', 'group' => 'Settings', 'description' => 'Mengedit pengaturan sistem'],

            // Pengumuman
            ['key' => 'view_pengumuman', 'display_name' => 'View Pengumuman', 'group' => 'Pengumuman', 'description' => 'Melihat daftar pengumuman'],
            ['key' => 'create_pengumuman', 'display_name' => 'Create Pengumuman', 'group' => 'Pengumuman', 'description' => 'Membuat pengumuman baru'],
            ['key' => 'edit_pengumuman', 'display_name' => 'Edit Pengumuman', 'group' => 'Pengumuman', 'description' => 'Mengedit pengumuman'],
            ['key' => 'delete_pengumuman', 'display_name' => 'Delete Pengumuman', 'group' => 'Pengumuman', 'description' => 'Menghapus pengumuman'],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['key' => $permission['key']], // Cari berdasarkan key
                $permission // Update atau create dengan data ini
            );
        }

        // Assign permissions to roles
        $arsipRole = Role::where('name', 'arsip')->first();
        $pustakaRole = Role::where('name', 'pustaka')->first();

        // Admin gets ALL permissions automatically via isAdmin() method
        // No need to assign permissions to admin role

        // Arsip role: Arsip management + kategori + bentuk + laporan arsip
        $arsipPermissions = [
            'view_arsip', 'create_arsip', 'edit_arsip', 'delete_arsip', 'export_arsip', 'import_arsip',
            'view_kategori', 'create_kategori', 'edit_kategori', 'delete_kategori',
            'view_bentuk', 'create_bentuk', 'edit_bentuk', 'delete_bentuk',
            'view_laporan_arsip', 'download_laporan_arsip',
        ];

        foreach ($arsipPermissions as $key) {
            $permission = Permission::where('key', $key)->first();
            if ($permission && !$arsipRole->permissions()->where('permissions.id', $permission->id)->exists()) {
                $arsipRole->permissions()->attach($permission->id);
            }
        }

        // Pustaka role: View arsip + laporan pustaka + content management (berita, koleksi, kegiatan, buku)
        $pustakaPermissions = [
            'view_arsip',
            'view_laporan_pustaka', 'download_laporan_pustaka',
            'view_berita', 'create_berita', 'edit_berita', 'delete_berita',
            'view_koleksi', 'create_koleksi', 'edit_koleksi', 'delete_koleksi',
            'view_kegiatan', 'create_kegiatan', 'edit_kegiatan', 'delete_kegiatan',
            'view_kategori_buku', 'create_kategori_buku', 'edit_kategori_buku', 'delete_kategori_buku',
            'view_buku', 'create_buku', 'edit_buku', 'delete_buku',
        ];

        foreach ($pustakaPermissions as $key) {
            $permission = Permission::where('key', $key)->first();
            if ($permission && !$pustakaRole->permissions()->where('permissions.id', $permission->id)->exists()) {
                $pustakaRole->permissions()->attach($permission->id);
            }
        }
    }
}

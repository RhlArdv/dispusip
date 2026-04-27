<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'Administrator dengan full access ke semua fitur',
            ],
            [
                'name' => 'arsip',
                'display_name' => 'Staff Arsip',
                'description' => 'Staff pengelola arsip dan dokumen',
            ],
            [
                'name' => 'pustaka',
                'display_name' => 'Staff Pustaka',
                'description' => 'Staff pengelola perpustakaan dan konten',
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}

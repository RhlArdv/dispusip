<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UpdateUsersWithRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        if ($users->isEmpty()) {
            $this->command->warn('No users found. Please create users first.');
            return;
        }

        $adminRole = Role::where('name', 'admin')->first();
        $arsipRole = Role::where('name', 'arsip')->first();
        $pustakaRole = Role::where('name', 'pustaka')->first();

        if (!$adminRole || !$arsipRole || !$pustakaRole) {
            $this->command->error('Roles not found. Please run RoleSeeder first.');
            return;
        }

        $this->command->info("Updating {$users->count()} users with roles...");

        foreach ($users as $index => $user) {
            // Skip if user already has a role
            if ($user->role_id) {
                $this->command->line("  User {$user->email} already has role: {$user->role->name}");
                continue;
            }

            // First user becomes admin
            if ($index === 0) {
                $user->role_id = $adminRole->id;
                $user->save();
                $this->command->info("  ✅ User {$user->email} assigned as: admin");
            }
            // Alternate between arsip and pustaka for other users
            elseif ($index % 2 === 1) {
                $user->role_id = $arsipRole->id;
                $user->save();
                $this->command->info("  ✅ User {$user->email} assigned as: arsip");
            }
            else {
                $user->role_id = $pustakaRole->id;
                $user->save();
                $this->command->info("  ✅ User {$user->email} assigned as: pustaka");
            }
        }

        $this->command->info('User roles updated successfully!');
    }
}

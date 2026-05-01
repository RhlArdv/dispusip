<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role_id'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function loadPermissions(): void
    {
        if (!$this->relationLoaded('role')) {
            $this->load('role.permissions');
        } elseif ($this->role && !$this->role->relationLoaded('permissions')) {
            $this->role->load('permissions');
        }
    }

    public function hasPermission(string $key): bool
    {
        if ($this->isAdmin()) {
            return true;
        }

        if (! $this->role) {
            return false;
        }

        // Pastikan permissions sudah ter-load
        $this->loadPermissions();

        return $this->role->permissions->contains('key', $key);
    }

    public function isAdmin(): bool
    {
        return $this->role?->name === 'admin';
    }

    public function hasRole(string $roleName): bool
    {
        return $this->role?->name === $roleName;
    }

    public function getPermissions(): \Illuminate\Support\Collection
    {
        // Cek session cache dulu
        if (session()->has('user_permissions')) {
            return collect(session('user_permissions'));
        }

        if ($this->isAdmin()) {
            $permissions = Permission::pluck('key');
        } else {
            // Pastikan permissions ter-load
            $this->loadPermissions();
            $permissions = $this->role?->permissions->pluck('key') ?? collect();
        }

        // Simpan ke session cache
        session(['user_permissions' => $permissions->toArray()]);

        return $permissions;
    }
}

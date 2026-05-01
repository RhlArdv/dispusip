<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriBuku extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'slug',
        'deskripsi',
        'urutan',
        'is_active',
    ];

    protected $table = 'kategori_buku';

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relasi ke buku
    public function buku(): HasMany
    {
        return $this->hasMany(Buku::class, 'kategori_buku_id');
    }

    // Scope untuk active categories
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk ordered by urutan
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan');
    }
}

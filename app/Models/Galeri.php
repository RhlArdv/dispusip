<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Galeri extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul_galeri',
        'slug',
        'foto_galeri',
        'deskripsi',
        'is_active',
    ];

    protected $table = 'galeris';

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($galeri) {
            if (empty($galeri->slug)) {
                $galeri->slug = Str::slug($galeri->judul_galeri);

                $originalSlug = $galeri->slug;
                $counter = 1;
                while (static::where('slug', $galeri->slug)->exists()) {
                    $galeri->slug = $originalSlug . '-' . $counter++;
                }
            }
        });

        static::updating(function ($galeri) {
            if ($galeri->isDirty('judul_galeri')) {
                $galeri->slug = Str::slug($galeri->judul_galeri);

                $originalSlug = $galeri->slug;
                $counter = 1;
                while (static::where('slug', $galeri->slug)
                    ->where('id', '!=', $galeri->id)
                    ->exists()) {
                    $galeri->slug = $originalSlug . '-' . $counter++;
                }
            }
        });
    }

    public function getFotoUrlAttribute()
    {
        if ($this->foto_galeri) {
            return asset($this->foto_galeri);
        }
        return null;
    }
}

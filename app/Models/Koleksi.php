<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Koleksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul_koleksi2',
        'slug',
        'foto_koleksi2',
        'kategori',
        'link',
        'isi_koleksi',
    ];

    protected $table = 'koleksi';

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Auto-generate slug saat creating
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($koleksi) {
            if (empty($koleksi->slug)) {
                $koleksi->slug = Str::slug($koleksi->judul_koleksi2);

                // Handle duplicate slug
                $originalSlug = $koleksi->slug;
                $counter = 1;
                while (static::where('slug', $koleksi->slug)->exists()) {
                    $koleksi->slug = $originalSlug . '-' . $counter++;
                }
            }
        });

        static::updating(function ($koleksi) {
            // Update slug kalau judul berubah
            if ($koleksi->isDirty('judul_koleksi2')) {
                $koleksi->slug = Str::slug($koleksi->judul_koleksi2);

                // Handle duplicate slug (exclude current ID)
                $originalSlug = $koleksi->slug;
                $counter = 1;
                while (static::where('slug', $koleksi->slug)
                    ->where('id', '!=', $koleksi->id)
                    ->exists()) {
                    $koleksi->slug = $originalSlug . '-' . $counter++;
                }
            }
        });
    }

    // Helper untuk get nama kategori
    public function getKategoriNamaAttribute()
    {
        $kategori = [
            1 => 'Koleksi Terbaru',
            2 => 'Koleksi Populer',
            3 => 'Koleksi Referensi',
            4 => 'Informasi Terkini',
        ];

        return $kategori[$this->kategori] ?? 'Unknown';
    }
}

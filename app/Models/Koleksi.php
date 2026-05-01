<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Koleksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul_koleksi',
        'slug',
        'foto_koleksi',
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
                $koleksi->slug = Str::slug($koleksi->judul_koleksi);

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
            if ($koleksi->isDirty('judul_koleksi')) {
                $koleksi->slug = Str::slug($koleksi->judul_koleksi);

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
        // Jika kategori sudah string, langsung return
        if (!is_numeric($this->kategori)) {
            return $this->kategori;
        }

        // Mapping dari integer ke nama (untuk backward compatibility)
        $kategoriMap = [
            1 => 'Koleksi Terbaru',
            2 => 'Koleksi Populer',
            3 => 'Koleksi Referensi',
            4 => 'Informasi Terkini',
        ];

        return $kategoriMap[$this->kategori] ?? $this->kategori ?? 'Unknown';
    }

    // Accessor untuk cover image:
    // Prioritas 1 → foto_koleksi (foto yang diupload langsung)
    // Prioritas 2 → gambar pertama yang ditemukan di isi_koleksi (konten rich text)
    public function getCoverImageAttribute(): ?string
    {
        if ($this->foto_koleksi) {
            return \Illuminate\Support\Facades\Storage::url($this->foto_koleksi);
        }

        if ($this->isi_koleksi) {
            preg_match('/<img[^>]+src=["\']([^"\'<>]+)["\']/i', $this->isi_koleksi, $matches);
            if (!empty($matches[1])) {
                return $matches[1];
            }
        }

        return null;
    }
}

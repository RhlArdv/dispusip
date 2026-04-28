<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul_berita',
        'slug',
        'isi_berita',
        'thumbnail',
        'user_id',
    ];

    protected $table = 'berita';

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relasi ke User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Accessor untuk mendapatkan gambar cover (Thumbnail atau gambar pertama dari isi konten)
    public function getCoverImageAttribute()
    {
        if ($this->thumbnail) {
            return asset($this->thumbnail);
        }

        // Cari tag img pertama di isi_berita (bisa berupa base64 atau URL)
        preg_match('/<img[^>]+src=["\']([^"\']+)["\']/i', $this->isi_berita, $matches);
        
        if (isset($matches[1])) {
            return $matches[1];
        }

        return null;
    }

    // Auto-generate slug saat creating
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($berita) {
            if (empty($berita->slug)) {
                $berita->slug = Str::slug($berita->judul_berita);

                // Handle duplicate slug
                $originalSlug = $berita->slug;
                $counter = 1;
                while (static::where('slug', $berita->slug)->exists()) {
                    $berita->slug = $originalSlug . '-' . $counter++;
                }
            }
        });

        static::updating(function ($berita) {
            // Update slug kalau judul berubah
            if ($berita->isDirty('judul_berita')) {
                $berita->slug = Str::slug($berita->judul_berita);

                // Handle duplicate slug (exclude current ID)
                $originalSlug = $berita->slug;
                $counter = 1;
                while (static::where('slug', $berita->slug)
                    ->where('id', '!=', $berita->id)
                    ->exists()) {
                    $berita->slug = $originalSlug . '-' . $counter++;
                }
            }
        });
    }
}

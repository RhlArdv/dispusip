<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Kegiatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'foto',
        'slug',
        'content',
        'user_id',
    ];

    protected $table = 'kegiatan';

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relasi ke User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Auto-generate slug saat creating
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($kegiatan) {
            if (empty($kegiatan->slug)) {
                $kegiatan->slug = Str::slug($kegiatan->title);

                // Handle duplicate slug
                $originalSlug = $kegiatan->slug;
                $counter = 1;
                while (static::where('slug', $kegiatan->slug)->exists()) {
                    $kegiatan->slug = $originalSlug . '-' . $counter++;
                }
            }
        });

        static::updating(function ($kegiatan) {
            // Update slug kalau title berubah
            if ($kegiatan->isDirty('title')) {
                $kegiatan->slug = Str::slug($kegiatan->title);

                // Handle duplicate slug (exclude current ID)
                $originalSlug = $kegiatan->slug;
                $counter = 1;
                while (static::where('slug', $kegiatan->slug)
                    ->where('id', '!=', $kegiatan->id)
                    ->exists()) {
                    $kegiatan->slug = $originalSlug . '-' . $counter++;
                }
            }
        });
    }

    // Accessor untuk mendapatkan gambar cover (Foto atau gambar pertama dari isi konten)
    public function getCoverImageAttribute()
    {
        if ($this->foto) {
            return asset($this->foto);
        }

        // Cari tag img pertama di content (bisa berupa base64 atau URL)
        preg_match('/<img[^>]+src=["\']([^"\']+)["\']/i', $this->content, $matches);

        if (isset($matches[1])) {
            return $matches[1];
        }

        return null;
    }
}

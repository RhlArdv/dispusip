<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Buku extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'slug',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'isbn',
        'uraian',
        'abstrak',
        'sumber',
        'sampul',
        'file_pdf',
        'kategori_buku_id',
        'is_published',
    ];

    protected $table = 'buku';

    protected $casts = [
        'tahun_terbit' => 'integer',
        'is_published' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relasi ke kategori_buku
    public function kategoriBuku(): BelongsTo
    {
        return $this->belongsTo(KategoriBuku::class, 'kategori_buku_id');
    }

    // Auto-generate slug saat creating
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($buku) {
            if (empty($buku->slug)) {
                $buku->slug = Str::slug($buku->judul);

                // Handle duplicate slug
                $originalSlug = $buku->slug;
                $counter = 1;
                while (static::where('slug', $buku->slug)->exists()) {
                    $buku->slug = $originalSlug . '-' . $counter++;
                }
            }
        });

        static::updating(function ($buku) {
            // Update slug kalau judul berubah
            if ($buku->isDirty('judul')) {
                $buku->slug = Str::slug($buku->judul);

                // Handle duplicate slug (exclude current ID)
                $originalSlug = $buku->slug;
                $counter = 1;
                while (static::where('slug', $buku->slug)
                    ->where('id', '!=', $buku->id)
                    ->exists()) {
                    $buku->slug = $originalSlug . '-' . $counter++;
                }
            }
        });
    }

    // Accessor untuk URL sampul
    public function getSampulUrlAttribute(): string|null
    {
        if ($this->sampul) {
            return asset('storage/buku/covers/' . $this->sampul);
        }
        return null;
    }

    // Accessor untuk URL PDF
    public function getPdfUrlAttribute(): string|null
    {
        if ($this->file_pdf) {
            return asset('storage/buku/pdfs/' . $this->file_pdf);
        }
        return null;
    }

    // Scope untuk published books
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    // Scope untuk search by judul
    public function scopeSearchJudul($query, $keyword)
    {
        if ($keyword) {
            return $query->where('judul', 'like', "%{$keyword}%");
        }
        return $query;
    }

    // Scope untuk search by penulis (support multiple penulis)
    public function scopeSearchPenulis($query, $keyword)
    {
        if ($keyword) {
            return $query->where('penulis', 'like', "%{$keyword}%");
        }
        return $query;
    }

    // Scope untuk search by penerbit
    public function scopeSearchPenerbit($query, $keyword)
    {
        if ($keyword) {
            return $query->where('penerbit', 'like', "%{$keyword}%");
        }
        return $query;
    }

    // Scope untuk filter by tahun terbit
    public function scopeFilterTahun($query, $tahun)
    {
        if ($tahun) {
            return $query->where('tahun_terbit', $tahun);
        }
        return $query;
    }

    // Scope untuk filter by kategori
    public function scopeFilterKategori($query, $kategoriId)
    {
        if ($kategoriId) {
            return $query->where('kategori_buku_id', $kategoriId);
        }
        return $query;
    }

    // Scope untuk global search (judul, penulis, penerbit, isbn)
    public function scopeGlobalSearch($query, $keyword)
    {
        if ($keyword) {
            return $query->where(function ($q) use ($keyword) {
                $q->where('judul', 'like', "%{$keyword}%")
                  ->orWhere('penulis', 'like', "%{$keyword}%")
                  ->orWhere('penerbit', 'like', "%{$keyword}%")
                  ->orWhere('isbn', 'like', "%{$keyword}%");
            });
        }
        return $query;
    }

    // Helper untuk get list penulis as array
    public function getPenulisListAttribute(): array
    {
        if (!$this->penulis) {
            return [];
        }

        // Split by comma dan trim whitespace
        $penulis = array_map('trim', explode(',', $this->penulis));
        return array_filter($penulis);
    }
}

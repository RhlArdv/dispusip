<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'url',
        'link_type',
        'section',
        'badge_label',
        'bg_image',
        'icon_svg',
        'style_variant',
        'order_number',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order_number' => 'integer',
    ];

    /**
     * Scope untuk section utama (Bento Grid) - tidak bisa ditambah/hapus
     */
    public function scopeUtama($query)
    {
        return $query->where('section', 'utama');
    }

    /**
     * Scope untuk section sekunder (Layanan Perpustakaan) - bisa CRUD penuh
     */
    public function scopeSekunder($query)
    {
        return $query->where('section', 'sekunder');
    }

    /**
     * Scope untuk yang aktif saja
     */
    public function scopeAktif($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Mendapatkan URL final (internal diproses lewat url(), external dibiarkan)
     */
    public function getResolvedUrlAttribute(): string
    {
        if ($this->link_type === 'internal') {
            return url($this->url);
        }
        return $this->url;
    }

    /**
     * Apakah layanan ini bagian dari section utama (Bento Grid)?
     * Section utama tidak boleh ditambah atau dihapus dari admin
     */
    public function isUtama(): bool
    {
        return $this->section === 'utama';
    }
}

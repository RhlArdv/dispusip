<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pejabat extends Model
{
    protected $fillable = [
        'nama',
        'jabatan',
        'nip',
        'keterangan',
        'image',
        'order_no',
        'is_active',
        'facebook',
        'twitter',
        'instagram',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order_no'  => 'integer',
    ];

    /**
     * Scope: hanya pejabat aktif, diurutkan berdasarkan order_no.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order_no');
    }
}

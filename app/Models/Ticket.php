<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'email',
        'pesan',
        'status',
    ];

    protected $table = 'tickets';

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Scope untuk filter status
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeDibaca($query)
    {
        return $query->where('status', 'dibaca');
    }

    public function scopeDiselesaikan($query)
    {
        return $query->where('status', 'diselesaikan');
    }

    // Accessor untuk status badge
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => '<span class="px-2 py-1 text-xs font-semibold rounded-md bg-yellow-100 text-yellow-700">Pending</span>',
            'dibaca' => '<span class="px-2 py-1 text-xs font-semibold rounded-md bg-blue-100 text-blue-700">Dibaca</span>',
            'diselesaikan' => '<span class="px-2 py-1 text-xs font-semibold rounded-md bg-red-100 text-red-700">Ditolak</span>',
        ];

        return $badges[$this->status] ?? $badges['pending'];
    }
}


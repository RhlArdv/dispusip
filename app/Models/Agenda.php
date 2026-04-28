<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $fillable = [
        'judul',
        'slug',
        'deskripsi',
        'jam_agenda',
        'tempat',
        'tanggal_mulai',
        'tanggal_selesai',
        'penyelenggara',
        'narahubung',
        'is_active',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'is_active' => 'boolean',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = ['ip_address'];
    
    // Asumsi tabel 'visitors' atau 'visitor'. Jika tabel spesifik, bisa diatur:
    // protected $table = 'visitors';
}

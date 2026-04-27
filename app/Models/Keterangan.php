<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keterangan extends Model
{
    protected $fillable = ['nama'];

    public function arsips()
    {
        return $this->hasMany(Arsip::class);
    }
}

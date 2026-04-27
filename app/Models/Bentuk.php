<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bentuk extends Model
{
    protected $fillable = ['nama'];

    public function arsips()
    {
        return $this->hasMany(Arsip::class);
    }
}

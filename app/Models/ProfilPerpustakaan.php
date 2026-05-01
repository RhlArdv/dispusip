<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilPerpustakaan extends Model
{
    protected $table = 'profil_perpustakaans';

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'meta',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'meta' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = \Illuminate\Support\Str::slug($model->title);
            }
        });
    }
}

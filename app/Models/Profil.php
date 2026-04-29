<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Profil extends Model
{
    protected $table = 'profils';

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'meta',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'meta' => 'array',
    ];

    // Auto generate slug dari title
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->title);
            }
        });
    }
}
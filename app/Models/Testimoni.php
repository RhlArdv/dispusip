<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    protected $fillable = [
        'title',
        'youtube_url',
        'is_active',
    ];

    public function getYoutubeIdAttribute()
    {
        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $this->youtube_url, $match)) {
            return $match[1];
        }
        return null;
    }
}

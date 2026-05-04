<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul_video',
        'slug',
        'youtube_url',
        'deskripsi',
        'is_active',
    ];

    protected $table = 'videos';

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($video) {
            if (empty($video->slug)) {
                $video->slug = Str::slug($video->judul_video);

                $originalSlug = $video->slug;
                $counter = 1;
                while (static::where('slug', $video->slug)->exists()) {
                    $video->slug = $originalSlug . '-' . $counter++;
                }
            }
        });

        static::updating(function ($video) {
            if ($video->isDirty('judul_video')) {
                $video->slug = Str::slug($video->judul_video);

                $originalSlug = $video->slug;
                $counter = 1;
                while (static::where('slug', $video->slug)
                    ->where('id', '!=', $video->id)
                    ->exists()) {
                    $video->slug = $originalSlug . '-' . $counter++;
                }
            }
        });
    }

    public function getYoutubeIdAttribute()
    {
        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $this->youtube_url, $match)) {
            return $match[1];
        }
        return null;
    }
}

<?php

namespace App\Models;

use App\Services\IconService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkAccess extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'url',
        'icon_svg',
        'urutan',
        'is_active',
        'user_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'urutan' => 'integer',
    ];

    /**
     * Get icon SVG with auto-assignment fallback
     */
    public function getIconSvgAttribute(): string
    {
        // If already has custom icon, return it
        if (!empty($this->attributes['icon_svg'])) {
            return $this->attributes['icon_svg'];
        }

        // Auto-assign icon if empty
        $iconService = app(IconService::class);
        $icon = $iconService->getIconByHash($this);

        // Return icon immediately without auto-saving in accessor
        // Auto-save will cause issues in DataTables and read-only contexts
        // Icons should be pre-assigned via artisan command instead
        return $icon ?: $this->getDefaultIcon();
    }

    /**
     * Get default fallback icon
     */
    protected function getDefaultIcon(): string
    {
        return '<svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                  d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
        </svg>';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'asc')->orderBy('created_at', 'desc');
    }
}

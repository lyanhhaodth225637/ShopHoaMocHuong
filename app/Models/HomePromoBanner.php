<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomePromoBanner extends Model
{
    protected $fillable = [
        'title',
        'description',
        'badge_text',
        'highlight_text',
        'button_text',
        'button_url',
        'image',
        'css_class',
        'size',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
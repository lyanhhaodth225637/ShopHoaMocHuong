<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeFeatureBox extends Model
{
    protected $fillable = [
        'title',
        'description',
        'icon',
        'link_url',
        'is_external',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_external' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
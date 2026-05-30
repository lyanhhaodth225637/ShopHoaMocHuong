<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeOccasionCategory extends Model
{
    protected $fillable = [
        'title',
        'icon',
        'link_url',
        'category_id',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
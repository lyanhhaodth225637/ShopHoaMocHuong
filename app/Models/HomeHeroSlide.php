<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeHeroSlide extends Model
{
    protected $fillable = [
        'image',
        'title',
        'alt',
        'sort_order',
        'is_active',
    ];
}
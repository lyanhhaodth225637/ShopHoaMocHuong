<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeHeroStat extends Model
{
    protected $fillable = [
        'value',
        'label',
        'sort_order',
        'is_active',
    ];
}
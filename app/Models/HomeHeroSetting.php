<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeHeroSetting extends Model
{
    protected $fillable = [
        'badge_text',
        'title_line_1',
        'title_highlight',
        'title_line_2',
        'subtitle',
        'primary_button_text',
        'primary_button_link',
        'secondary_button_text',
        'secondary_button_link',
        'circle_image',
        'float_badge_1_title',
        'float_badge_1_subtitle',
        'float_badge_2_title',
        'float_badge_2_subtitle',
        'is_active',
    ];
}
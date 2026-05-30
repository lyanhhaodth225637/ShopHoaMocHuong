<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PostCategory extends Model
{
    protected $table = 'post_categories';
    protected $fillable = [
        'name',
        'slug',
        'description',
        'meta_title',
        'meta_description',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];



    public function posts()
    {
        return $this->hasMany(Post::class, 'post_category_id', 'id');
    }


    //
    public function activePosts()
    {
        return $this->hasMany(Post::class, 'post_category_id', 'id')
            ->where('is_active', true)
            ->latest();
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

}
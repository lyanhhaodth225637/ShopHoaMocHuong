<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $table = 'posts'; 

    protected $fillable = [
        'post_category_id',
        'user_id',
        'title',
        'slug',
        'thumbnail',
        'video_url',
        'excerpt',
        'content',
        'type',
        'status',
        'is_featured',
        'is_active',
        'view_count',
        'meta_title',
        'meta_description',
        'published_at',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'view_count' => 'integer',
        'published_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(PostCategory::class, 'post_category_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(PostImage::class, 'post_id', 'id')
            ->orderBy('sort_order')
            ->orderBy('id');
    }

    public function activeImages()
    {
        return $this->hasMany(PostImage::class, 'post_id', 'id')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeType($query, string $type)
    {
        return $query->where('type', $type);
    }
}

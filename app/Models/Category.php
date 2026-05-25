<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'mega_section_key',
        'mega_section_label',
        'image',
        'icon',
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

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function activeChildren()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id')->where('is_active', true)->orderBy('sort_order');
    }

    public function scopeParent($query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeAtive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'category_product',
            'category_id',
            'product_id',
            'id',
            'id'
        );
    }

    public function getMegaSectionAttribute(): ?string
    {
        return $this->getMegaSectionResolvedLabelAttribute();
    }

    public function getMegaSectionResolvedKeyAttribute(): string
    {
        return $this->mega_section_key ?: 'khac';
    }

    public function getMegaSectionResolvedLabelAttribute(): string
    {
        if (!empty($this->mega_section_label)) {
            return $this->mega_section_label;
        }

        if (!empty($this->mega_section_key)) {
            return (string) Str::of($this->mega_section_key)
                ->replace('_', ' ')
                ->title();
        }

        return 'Khác';
    }
}

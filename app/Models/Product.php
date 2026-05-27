<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Binafy\LaravelCart\Cartable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model implements Cartable
{
    protected $table = 'products';

    protected $with = [
        'defaultSku.inventory',
    ];

    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'main_image',
        'video_url',
        'product_type',
        'is_active',
        'is_featured',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'canonical_url',
        'og_title',
        'og_description',
        'og_image',
        'sort_order',
    ];

    protected $casts = [
        'product_type' => 'string',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function getPrice(): float
    {
        return (float) ($this->defaultSku?->price ?? 0);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSkuAttribute(): ?string
    {
        return $this->defaultSku?->sku;
    }

    public function getPriceAttribute(): float
    {
        return $this->getPrice();
    }

    public function getStockQuantityAttribute(): int
    {
        if (!$this->defaultSku?->track_inventory) {
            return 0;
        }

        return (int) ($this->defaultSku?->inventory?->quantity ?? 0);
    }

    public function getMinQuantityAttribute(): int
    {
        return (int) ($this->defaultSku?->inventory?->min_quantity ?? 0);
    }

    public function getCostPriceAttribute(): float
    {
        return (float) ($this->defaultSku?->cost_price ?? 0);
    }

    public function getTrackInventoryAttribute(): bool
    {
        return (bool) ($this->defaultSku?->track_inventory ?? false);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            Category::class,
            'category_product',
            'product_id',
            'category_id',
            'id',
            'id'
        );
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function skus(): HasMany
    {
        return $this->hasMany(ProductSku::class, 'product_id', 'id');
    }

    public function defaultSku(): HasOne
    {
        return $this->hasOne(ProductSku::class, 'product_id', 'id')->oldestOfMany();
    }
}

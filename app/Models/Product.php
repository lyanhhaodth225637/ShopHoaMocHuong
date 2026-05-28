<?php

namespace App\Models;

use Binafy\LaravelCart\Cartable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model implements Cartable
{
    protected $table = 'products';

    protected $with = [
        'sku.inventory',
    ];

    protected $fillable = [
        'sku_id',
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
        'sort_order' => 'integer',
    ];

    public function getPrice(): float
    {
        return (float) ($this->sku?->default_sale_price ?? 0);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSkuCodeAttribute(): ?string
    {
        return $this->sku?->sku;
    }

    public function getPriceAttribute(): float
    {
        return $this->getPrice();
    }

    public function getCostPriceAttribute(): float
    {
        return (float) ($this->sku?->default_cost_price ?? 0);
    }

    public function getStockQuantityAttribute(): int
    {
        if (!$this->sku?->track_inventory) {
            return 0;
        }

        return (int) ($this->sku?->inventory?->quantity ?? 0);
    }

    public function getMinQuantityAttribute(): int
    {
        return (int) ($this->sku?->min_quantity ?? 0);
    }

    public function getTrackInventoryAttribute(): bool
    {
        return (bool) ($this->sku?->track_inventory ?? false);
    }

    public function getStockStatusAttribute(): string
    {
        if (!$this->sku) {
            return 'not_linked';
        }

        if (!$this->sku->track_inventory) {
            return 'not_tracked';
        }

        $quantity = (int) ($this->sku->inventory?->quantity ?? 0);

        if ($quantity <= 0) {
            return 'out_of_stock';
        }

        if ($quantity <= $this->sku->min_quantity) {
            return 'low_stock';
        }

        return 'in_stock';
    }

    public function getIsInStockAttribute(): bool
    {
        if (!$this->sku) {
            return false;
        }

        if (!$this->sku->track_inventory) {
            return true;
        }

        return $this->stock_quantity > 0;
    }

    public function sku(): BelongsTo
    {
        return $this->belongsTo(Sku::class, 'sku_id', 'id');
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
}
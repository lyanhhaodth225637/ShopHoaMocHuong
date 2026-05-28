<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Sku extends Model
{
    protected $table = 'skus';

    protected $with = [
        'inventory',
    ];

    protected $fillable = [
        'unit_id',
        'sku',
        'name',
        'description',
        'default_cost_price',
        'default_sale_price',
        'track_inventory',
        'min_quantity',
        'max_quantity',
        'attributes',
        'is_active',
    ];

    protected $casts = [
        'default_cost_price' => 'decimal:2',
        'default_sale_price' => 'decimal:2',
        'track_inventory' => 'boolean',
        'min_quantity' => 'integer',
        'max_quantity' => 'integer',
        'attributes' => 'array',
        'is_active' => 'boolean',
    ];

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }

    public function inventory(): HasOne
    {
        return $this->hasOne(WarehouseInventory::class, 'sku_id', 'id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'sku_id', 'id');
    }

    public function inputSlipItems(): HasMany
    {
        return $this->hasMany(InputSlipItem::class, 'sku_id', 'id');
    }

    public function outputSlipItems(): HasMany
    {
        return $this->hasMany(OutputSlipItem::class, 'sku_id', 'id');
    }

    public function movements(): HasMany
    {
        return $this->hasMany(InventoryMovement::class, 'sku_id', 'id');
    }

    public function getQuantityAttribute(): int
    {
        return (int) ($this->inventory?->quantity ?? 0);
    }

    public function getStockStatusAttribute(): string
    {
        if (! $this->track_inventory) {
            return 'not_tracked';
        }

        if ($this->quantity <= 0) {
            return 'out_of_stock';
        }

        if ($this->quantity <= $this->min_quantity) {
            return 'low_stock';
        }

        return 'in_stock';
    }

    public function getIsInStockAttribute(): bool
    {
        if (! $this->track_inventory) {
            return true;
        }

        return $this->quantity > 0;
    }
}

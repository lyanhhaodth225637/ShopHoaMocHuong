<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WarehouseInventory extends Model
{
    protected $table = 'warehouse_inventories';

    protected $fillable = [
        'sku_id',
        'quantity',
    ];

    protected $casts = [
        'quantity' => 'integer',
    ];

    public function sku(): BelongsTo
    {
        return $this->belongsTo(Sku::class, 'sku_id', 'id');
    }
}
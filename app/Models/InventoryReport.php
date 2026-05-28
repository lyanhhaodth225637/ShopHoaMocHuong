<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryReport extends Model
{
    protected $table = 'inventory_reports';

    protected $primaryKey = 'sku_id';

    public $incrementing = false;

    public $timestamps = false;

    protected $casts = [
        'sku_id' => 'integer',
        'quantity' => 'integer',
        'min_quantity' => 'integer',
        'default_cost_price' => 'decimal:2',
        'default_sale_price' => 'decimal:2',
    ];
}
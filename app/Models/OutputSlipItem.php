<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OutputSlipItem extends Model
{
    protected $table = 'output_slip_items';

    protected $fillable = [
        'output_slip_id',
        'sku_id',
        'quantity',
        'sale_price',
        'total_price',
        'note',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'sale_price' => 'decimal:2',
        'total_price' => 'decimal:2',
    ];

    public function outputSlip(): BelongsTo
    {
        return $this->belongsTo(OutputSlip::class, 'output_slip_id', 'id');
    }

    public function sku(): BelongsTo
    {
        return $this->belongsTo(Sku::class, 'sku_id', 'id');
    }
}
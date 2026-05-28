<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InputSlipItem extends Model
{
    protected $table = 'input_slip_items';

    protected $fillable = [
        'input_slip_id',
        'sku_id',
        'quantity',
        'cost_price',
        'total_price',
        'note',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'cost_price' => 'decimal:2',
        'total_price' => 'decimal:2',
    ];

    public function inputSlip(): BelongsTo
    {
        return $this->belongsTo(InputSlip::class, 'input_slip_id', 'id');
    }

    public function sku(): BelongsTo
    {
        return $this->belongsTo(Sku::class, 'sku_id', 'id');
    }
}
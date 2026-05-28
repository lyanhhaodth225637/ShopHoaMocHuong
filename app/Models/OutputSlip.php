<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OutputSlip extends Model
{
    protected $table = 'output_slips';

    protected $fillable = [
        'code',
        'customer_id',
        'output_date',
        'output_type',
        'status',
        'total_amount',
        'note',
        'created_by',
    ];

    protected $casts = [
        'output_date' => 'date',
        'total_amount' => 'decimal:2',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(OutputSlipItem::class, 'output_slip_id', 'id');
    }

    public function movements(): HasMany
    {
        return $this->hasMany(InventoryMovement::class, 'reference_id', 'id')
            ->where('reference_type', self::class);
    }

    public function getIsDraftAttribute(): bool
    {
        return $this->status === 'draft';
    }

    public function getIsCompletedAttribute(): bool
    {
        return $this->status === 'completed';
    }

    public function getIsCancelledAttribute(): bool
    {
        return $this->status === 'cancelled';
    }
}
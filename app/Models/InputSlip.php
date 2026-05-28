<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InputSlip extends Model
{
    protected $table = 'input_slips';

    protected $fillable = [
        'code',
        'supplier_id',
        'input_date',
        'status',
        'total_amount',
        'note',
        'created_by',
    ];

    protected $casts = [
        'input_date' => 'date',
        'total_amount' => 'decimal:2',
    ];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(InputSlipItem::class, 'input_slip_id', 'id');
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
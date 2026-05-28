<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    protected $table = 'suppliers';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'tax_code',
        'note',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function inputSlips(): HasMany
    {
        return $this->hasMany(InputSlip::class, 'supplier_id', 'id');
    }
}
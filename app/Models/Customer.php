<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    protected $table = 'customers';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'note',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function outputSlips(): HasMany
    {
        return $this->hasMany(OutputSlip::class, 'customer_id', 'id');
    }
}
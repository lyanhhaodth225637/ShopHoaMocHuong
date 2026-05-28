<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Unit extends Model
{
    protected $table = 'units';

    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function skus(): HasMany
    {
        return $this->hasMany(Sku::class, 'unit_id', 'id');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeInactive(Builder $query): Builder
    {
        return $query->where('is_active', false);
    }

    public function getStatusLabelAttribute(): string
    {
        return $this->is_active ? 'Hoạt động' : 'Tắt';
    }

    public function getStatusBadgeAttribute(): string
    {
        return $this->is_active ? 'success' : 'danger';
    }
}

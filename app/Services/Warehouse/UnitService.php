<?php

namespace App\Services\Warehouse;

use App\Models\Unit;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class UnitService
{
    public function getList(int $perPage = 10): LengthAwarePaginator
    {
        return Unit::query()
            ->latest('id')
            ->paginate($perPage);
    }

    public function store(array $data): Unit
    {
        return DB::transaction(fn() => Unit::create($data));
    }

    public function update(Unit $unit, array $data): bool
    {
        return DB::transaction(fn() => $unit->update($data));
    }

    public function delete(Unit $unit): bool
    {
        return DB::transaction(function () use ($unit) {
            if ($unit->skus()->exists()) {
                throw new \Exception('Không thể xóa đơn vị tính đang có SKU.');
            }

            return $unit->delete();
        });
    }
}
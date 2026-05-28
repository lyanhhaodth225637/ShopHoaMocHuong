<?php

namespace App\Services\Warehouse;

use App\Models\Sku;
use App\Models\WarehouseInventory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class SkuService
{
    public function getList(int $perPage = 10): LengthAwarePaginator
    {
        return Sku::query()
            ->with(['unit', 'inventory'])
            ->latest('id')
            ->paginate($perPage);
    }

    public function store(array $data): Sku
    {
        return DB::transaction(function () use ($data) {
            $sku = Sku::create($data);

            WarehouseInventory::firstOrCreate(
                ['sku_id' => $sku->id],
                ['quantity' => 0]
            );

            return $sku;
        });
    }

    public function update(Sku $sku, array $data): bool
    {
        return DB::transaction(function () use ($sku, $data) {
            return $sku->update($data);
        });
    }

    public function delete(Sku $sku): bool
    {
        return DB::transaction(function () use ($sku) {
            if ($sku->products()->exists()) {
                throw new \Exception('Không thể xóa SKU đang được gắn với sản phẩm frontend.');
            }

            if ($sku->inputSlipItems()->exists() || $sku->outputSlipItems()->exists()) {
                throw new \Exception('Không thể xóa SKU đã phát sinh phiếu nhập/xuất.');
            }

            return $sku->delete();
        });
    }
}

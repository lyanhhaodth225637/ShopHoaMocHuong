<?php

namespace App\Services\Warehouse;

use App\Models\Supplier;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class SupplierService
{
    public function getList(int $perPage = 10): LengthAwarePaginator
    {
        return Supplier::query()
            ->latest('id')
            ->paginate($perPage);
    }

    public function store(array $data): Supplier
    {
        return DB::transaction(fn () => Supplier::create($data));
    }

    public function update(Supplier $supplier, array $data): bool
    {
        return DB::transaction(fn () => $supplier->update($data));
    }

    public function delete(Supplier $supplier): bool
    {
        return DB::transaction(function () use ($supplier) {
            if ($supplier->inputSlips()->exists()) {
                throw new \Exception('Không thể xóa nhà cung cấp đã có phiếu nhập.');
            }

            return $supplier->delete();
        });
    }
}
<?php

namespace App\Services\Warehouse;

use App\Models\Customer;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class CustomerService
{
    public function getList(int $perPage = 10): LengthAwarePaginator
    {
        return Customer::query()
            ->latest('id')
            ->paginate($perPage);
    }

    public function store(array $data): Customer
    {
        return DB::transaction(fn() => Customer::create($data));
    }

    public function update(Customer $customer, array $data): bool
    {
        return DB::transaction(fn() => $customer->update($data));
    }

    public function delete(Customer $customer): bool
    {
        return DB::transaction(function () use ($customer) {
            if ($customer->outputSlips()->exists()) {
                throw new \Exception('Không thể xóa khách hàng đã có phiếu xuất.');
            }

            return $customer->delete();
        });
    }
}
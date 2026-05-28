<?php

namespace App\Services\Warehouse;

use App\Models\InputSlip;
use App\Models\InventoryMovement;
use App\Models\WarehouseInventory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InputSlipService
{
    public function getList(int $perPage = 10): LengthAwarePaginator
    {
        return InputSlip::query()
            ->with(['supplier', 'creator'])
            ->latest('id')
            ->paginate($perPage);
    }

    public function store(array $data): InputSlip
    {
        return DB::transaction(function () use ($data) {
            $items = $data['items'];
            unset($data['items']);

            $data['code'] = $this->generateCode();
            $data['status'] = 'draft';
            $data['created_by'] = Auth::id();
            $data['total_amount'] = $this->calculateTotal($items, 'cost_price');

            $inputSlip = InputSlip::create($data);

            foreach ($items as $item) {
                $inputSlip->items()->create([
                    'sku_id' => $item['sku_id'],
                    'quantity' => $item['quantity'],
                    'cost_price' => $item['cost_price'],
                    'total_price' => $item['quantity'] * $item['cost_price'],
                    'note' => $item['note'] ?? null,
                ]);
            }

            return $inputSlip;
        });
    }

    public function update(InputSlip $inputSlip, array $data): bool
    {
        return DB::transaction(function () use ($inputSlip, $data) {
            if ($inputSlip->status !== 'draft') {
                throw new \Exception('Chỉ được sửa phiếu nhập ở trạng thái nháp.');
            }

            $items = $data['items'];
            unset($data['items']);

            $data['total_amount'] = $this->calculateTotal($items, 'cost_price');

            $inputSlip->update($data);

            $inputSlip->items()->delete();

            foreach ($items as $item) {
                $inputSlip->items()->create([
                    'sku_id' => $item['sku_id'],
                    'quantity' => $item['quantity'],
                    'cost_price' => $item['cost_price'],
                    'total_price' => $item['quantity'] * $item['cost_price'],
                    'note' => $item['note'] ?? null,
                ]);
            }

            return true;
        });
    }

    public function delete(InputSlip $inputSlip): bool
    {
        return DB::transaction(function () use ($inputSlip) {
            if ($inputSlip->status !== 'draft') {
                throw new \Exception('Chỉ được xóa phiếu nhập ở trạng thái nháp.');
            }

            return $inputSlip->delete();
        });
    }

    public function complete(InputSlip $inputSlip): bool
    {
        return DB::transaction(function () use ($inputSlip) {
            if ($inputSlip->status !== 'draft') {
                throw new \Exception('Chỉ được hoàn tất phiếu nhập ở trạng thái nháp.');
            }

            $inputSlip->load('items.sku');

            foreach ($inputSlip->items as $item) {
                if (!$item->sku->track_inventory) {
                    continue;
                }

                $inventory = WarehouseInventory::firstOrCreate(
                    ['sku_id' => $item->sku_id],
                    ['quantity' => 0]
                );

                $before = (int) $inventory->quantity;
                $after = $before + (int) $item->quantity;

                $inventory->update([
                    'quantity' => $after,
                ]);

                InventoryMovement::create([
                    'sku_id' => $item->sku_id,
                    'movement_type' => 'input',
                    'quantity_change' => $item->quantity,
                    'quantity_before' => $before,
                    'quantity_after' => $after,
                    'reference_type' => InputSlip::class,
                    'reference_id' => $inputSlip->id,
                    'note' => 'Hoàn tất phiếu nhập ' . $inputSlip->code,
                    'created_by' => Auth::id(),
                ]);
            }

            $inputSlip->update([
                'status' => 'completed',
            ]);

            return true;
        });
    }

    public function cancel(InputSlip $inputSlip): bool
    {
        return DB::transaction(function () use ($inputSlip) {
            if ($inputSlip->status === 'cancelled') {
                throw new \Exception('Phiếu nhập đã bị hủy trước đó.');
            }

            if ($inputSlip->status === 'completed') {
                throw new \Exception('Phiếu nhập đã hoàn tất, không hủy trực tiếp. Cần tạo phiếu điều chỉnh hoặc phiếu xuất trả.');
            }

            $inputSlip->update([
                'status' => 'cancelled',
            ]);

            return true;
        });
    }

    private function calculateTotal(array $items, string $priceKey): float
    {
        return collect($items)->sum(function ($item) use ($priceKey) {
            return (float) $item['quantity'] * (float) $item[$priceKey];
        });
    }

    private function generateCode(): string
    {
        $prefix = 'PN' . now()->format('Ymd');

        $countToday = InputSlip::whereDate('created_at', now()->toDateString())->count() + 1;

        return $prefix . str_pad($countToday, 4, '0', STR_PAD_LEFT);
    }
}
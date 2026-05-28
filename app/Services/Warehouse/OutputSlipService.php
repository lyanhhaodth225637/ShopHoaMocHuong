<?php

namespace App\Services\Warehouse;

use App\Models\InventoryMovement;
use App\Models\OutputSlip;
use App\Models\WarehouseInventory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OutputSlipService
{
    public function getList(int $perPage = 10): LengthAwarePaginator
    {
        return OutputSlip::query()
            ->with(['customer', 'creator'])
            ->latest('id')
            ->paginate($perPage);
    }

    public function store(array $data): OutputSlip
    {
        return DB::transaction(function () use ($data) {
            $items = $data['items'];
            unset($data['items']);

            $data['code'] = $this->generateCode();
            $data['status'] = 'draft';
            $data['created_by'] = Auth::id();
            $data['total_amount'] = $this->calculateTotal($items, 'sale_price');

            $outputSlip = OutputSlip::create($data);

            foreach ($items as $item) {
                $outputSlip->items()->create([
                    'sku_id' => $item['sku_id'],
                    'quantity' => $item['quantity'],
                    'sale_price' => $item['sale_price'],
                    'total_price' => $item['quantity'] * $item['sale_price'],
                    'note' => $item['note'] ?? null,
                ]);
            }

            return $outputSlip;
        });
    }

    public function update(OutputSlip $outputSlip, array $data): bool
    {
        return DB::transaction(function () use ($outputSlip, $data) {
            if ($outputSlip->status !== 'draft') {
                throw new \Exception('Chỉ được sửa phiếu xuất ở trạng thái nháp.');
            }

            $items = $data['items'];
            unset($data['items']);

            $data['total_amount'] = $this->calculateTotal($items, 'sale_price');

            $outputSlip->update($data);

            $outputSlip->items()->delete();

            foreach ($items as $item) {
                $outputSlip->items()->create([
                    'sku_id' => $item['sku_id'],
                    'quantity' => $item['quantity'],
                    'sale_price' => $item['sale_price'],
                    'total_price' => $item['quantity'] * $item['sale_price'],
                    'note' => $item['note'] ?? null,
                ]);
            }

            return true;
        });
    }

    public function delete(OutputSlip $outputSlip): bool
    {
        return DB::transaction(function () use ($outputSlip) {
            if ($outputSlip->status !== 'draft') {
                throw new \Exception('Chỉ được xóa phiếu xuất ở trạng thái nháp.');
            }

            return $outputSlip->delete();
        });
    }

    public function complete(OutputSlip $outputSlip): bool
    {
        return DB::transaction(function () use ($outputSlip) {
            if ($outputSlip->status !== 'draft') {
                throw new \Exception('Chỉ được hoàn tất phiếu xuất ở trạng thái nháp.');
            }

            $outputSlip->load('items.sku.inventory');

            foreach ($outputSlip->items as $item) {
                $sku = $item->sku;

                if (!$sku->track_inventory) {
                    continue;
                }

                $inventory = WarehouseInventory::firstOrCreate(
                    ['sku_id' => $item->sku_id],
                    ['quantity' => 0]
                );

                $before = (int) $inventory->quantity;
                $quantity = (int) $item->quantity;

                if ($before < $quantity) {
                    throw new \Exception("SKU {$sku->sku} không đủ tồn. Tồn hiện tại: {$before}.");
                }

                $after = $before - $quantity;

                $inventory->update([
                    'quantity' => $after,
                ]);

                InventoryMovement::create([
                    'sku_id' => $item->sku_id,
                    'movement_type' => 'output',
                    'quantity_change' => -$quantity,
                    'quantity_before' => $before,
                    'quantity_after' => $after,
                    'reference_type' => OutputSlip::class,
                    'reference_id' => $outputSlip->id,
                    'note' => 'Hoàn tất phiếu xuất ' . $outputSlip->code,
                    'created_by' => Auth::id(),
                ]);
            }

            $outputSlip->update([
                'status' => 'completed',
            ]);

            return true;
        });
    }

    public function cancel(OutputSlip $outputSlip): bool
    {
        return DB::transaction(function () use ($outputSlip) {
            if ($outputSlip->status === 'cancelled') {
                throw new \Exception('Phiếu xuất đã bị hủy trước đó.');
            }

            if ($outputSlip->status === 'completed') {
                throw new \Exception('Phiếu xuất đã hoàn tất, không hủy trực tiếp. Cần tạo phiếu nhập hoàn hoặc phiếu điều chỉnh.');
            }

            $outputSlip->update([
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
        $prefix = 'PX' . now()->format('Ymd');

        $countToday = OutputSlip::whereDate('created_at', now()->toDateString())->count() + 1;

        return $prefix . str_pad($countToday, 4, '0', STR_PAD_LEFT);
    }
}
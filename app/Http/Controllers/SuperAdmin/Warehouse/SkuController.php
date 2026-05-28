<?php

namespace App\Http\Controllers\SuperAdmin\Warehouse;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Warehouse\Sku\StoreSkuRequest;
use App\Http\Requests\SuperAdmin\Warehouse\Sku\UpdateSkuRequest;
use App\Models\Sku;
use App\Models\Unit;
use App\Services\Warehouse\SkuService;

class SkuController extends Controller
{
    public function __construct(
        protected SkuService $skuService
    ) {
    }

    public function index()
    {
        $skus = $this->skuService->getList();

        return view('super-admin.warehouse.skus.index', compact('skus'));
    }

    public function create()
    {
        $units = Unit::where('is_active', true)->orderBy('name')->get();

        return view('super-admin.warehouse.skus.create', compact('units'));
    }

    public function store(StoreSkuRequest $request)
    {
        $this->skuService->store($request->validated());

        return redirect()
            ->route('admin.warehouse.skus.index')
            ->with('success', 'Thêm SKU thành công.');
    }

    public function edit(Sku $sku)
    {
        $units = Unit::where('is_active', true)->orderBy('name')->get();

        return view('super-admin.warehouse.skus.edit', compact('sku', 'units'));
    }

    public function update(UpdateSkuRequest $request, Sku $sku)
    {
        $this->skuService->update($sku, $request->validated());

        return redirect()
            ->route('admin.warehouse.skus.index')
            ->with('success', 'Cập nhật SKU thành công.');
    }

    public function destroy(Sku $sku)
    {
        try {
            $this->skuService->delete($sku);

            return redirect()
                ->route('admin.warehouse.skus.index')
                ->with('success', 'Xóa SKU thành công.');
        } catch (\Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}

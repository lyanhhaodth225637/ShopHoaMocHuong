<?php

namespace App\Http\Controllers\SuperAdmin\Warehouse;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Warehouse\Unit\StoreUnitRequest;
use App\Http\Requests\SuperAdmin\Warehouse\Unit\UpdateUnitRequest;
use App\Models\Unit;
use App\Services\Warehouse\UnitService;

class UnitController extends Controller
{
    public function __construct(
        protected UnitService $unitService
    ) {}

    public function index()
    {
        $units = $this->unitService->getList();

        return view('super-admin.warehouse.units.index', compact('units'));
    }

    public function create()
    {
        return view('super-admin.warehouse.units.create');
    }

    public function store(StoreUnitRequest $request)
    {
        $this->unitService->store($request->validated());

        return redirect()
            ->route('admin.warehouse.units.index')
            ->with('success', 'Thêm đơn vị tính thành công.');
    }

    public function edit(Unit $unit)
    {
        return view('super-admin.warehouse.units.edit', compact('unit'));
    }

    public function update(UpdateUnitRequest $request, Unit $unit)
    {
        $this->unitService->update($unit, $request->validated());

        return redirect()
            ->route('admin.warehouse.units.index')
            ->with('success', 'Cập nhật đơn vị tính thành công.');
    }

    public function destroy(Unit $unit)
    {
        try {
            $this->unitService->delete($unit);

            return redirect()
                ->route('admin.warehouse.units.index')
                ->with('success', 'Xóa đơn vị tính thành công.');
        } catch (\Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
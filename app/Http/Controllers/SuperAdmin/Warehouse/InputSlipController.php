<?php

namespace App\Http\Controllers\SuperAdmin\Warehouse;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Warehouse\InputSlip\StoreInputSlipRequest;
use App\Http\Requests\SuperAdmin\Warehouse\InputSlip\UpdateInputSlipRequest;
use App\Models\InputSlip;
use App\Models\Sku;
use App\Models\Supplier;
use App\Services\Warehouse\InputSlipService;

class InputSlipController extends Controller
{
    public function __construct(
        protected InputSlipService $inputSlipService
    ) {
    }

    public function index()
    {
        $inputSlips = $this->inputSlipService->getList();

        return view('super-admin.warehouse.input-slips.index', compact('inputSlips'));
    }

    public function create()
    {
        $suppliers = Supplier::where('is_active', true)->orderBy('name')->get();
        $skus = Sku::where('is_active', true)->orderBy('name')->get();

        return view('super-admin.warehouse.input-slips.create', compact('suppliers', 'skus'));
    }

    public function store(StoreInputSlipRequest $request)
    {
        $this->inputSlipService->store($request->validated());

        return redirect()
            ->route('admin.warehouse.input-slips.index')
            ->with('success', 'Tạo phiếu nhập thành công.');
    }

    public function show(InputSlip $inputSlip)
    {
        $inputSlip->load(['supplier', 'items.sku', 'creator']);

        return view('super-admin.warehouse.input-slips.show', compact('inputSlip'));
    }

    public function edit(InputSlip $inputSlip)
    {
        $inputSlip->load('items');

        $suppliers = Supplier::where('is_active', true)->orderBy('name')->get();
        $skus = Sku::where('is_active', true)->orderBy('name')->get();

        return view('super-admin.warehouse.input-slips.edit', compact('inputSlip', 'suppliers', 'skus'));
    }

    public function update(UpdateInputSlipRequest $request, InputSlip $inputSlip)
    {
        try {
            $this->inputSlipService->update($inputSlip, $request->validated());

            return redirect()
                ->route('admin.warehouse.input-slips.index')
                ->with('success', 'Cập nhật phiếu nhập thành công.');
        } catch (\Throwable $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function destroy(InputSlip $inputSlip)
    {
        try {
            $this->inputSlipService->delete($inputSlip);

            return redirect()
                ->route('admin.warehouse.input-slips.index')
                ->with('success', 'Xóa phiếu nhập thành công.');
        } catch (\Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function complete(InputSlip $inputSlip)
    {
        try {
            $this->inputSlipService->complete($inputSlip);

            return back()->with('success', 'Hoàn tất phiếu nhập và cộng kho thành công.');
        } catch (\Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function cancel(InputSlip $inputSlip)
    {
        try {
            $this->inputSlipService->cancel($inputSlip);

            return back()->with('success', 'Hủy phiếu nhập thành công.');
        } catch (\Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
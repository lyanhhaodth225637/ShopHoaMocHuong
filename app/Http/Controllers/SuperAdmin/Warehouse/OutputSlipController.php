<?php

namespace App\Http\Controllers\SuperAdmin\Warehouse;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Warehouse\OutputSlip\StoreOutputSlipRequest;
use App\Http\Requests\SuperAdmin\Warehouse\OutputSlip\UpdateOutputSlipRequest;
use App\Models\Customer;
use App\Models\OutputSlip;
use App\Models\Sku;
use App\Services\Warehouse\OutputSlipService;

class OutputSlipController extends Controller
{
    public function __construct(
        protected OutputSlipService $outputSlipService
    ) {
    }

    public function index()
    {
        $outputSlips = $this->outputSlipService->getList();

        return view('super-admin.warehouse.output-slips.index', compact('outputSlips'));
    }

    public function create()
    {
        $customers = Customer::where('is_active', true)->orderBy('name')->get();
        $skus = Sku::where('is_active', true)->orderBy('name')->get();

        return view('super-admin.warehouse.output-slips.create', compact('customers', 'skus'));
    }

    public function store(StoreOutputSlipRequest $request)
    {
        $this->outputSlipService->store($request->validated());

        return redirect()
            ->route('admin.warehouse.output-slips.index')
            ->with('success', 'Tạo phiếu xuất thành công.');
    }

    public function show(OutputSlip $outputSlip)
    {
        $outputSlip->load(['customer', 'items.sku', 'creator']);

        return view('super-admin.warehouse.output-slips.show', compact('outputSlip'));
    }

    public function edit(OutputSlip $outputSlip)
    {
        $outputSlip->load('items');

        $customers = Customer::where('is_active', true)->orderBy('name')->get();
        $skus = Sku::where('is_active', true)->orderBy('name')->get();

        return view('super-admin.warehouse.output-slips.edit', compact('outputSlip', 'customers', 'skus'));
    }

    public function update(UpdateOutputSlipRequest $request, OutputSlip $outputSlip)
    {
        try {
            $this->outputSlipService->update($outputSlip, $request->validated());

            return redirect()
                ->route('admin.warehouse.output-slips.index')
                ->with('success', 'Cập nhật phiếu xuất thành công.');
        } catch (\Throwable $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function destroy(OutputSlip $outputSlip)
    {
        try {
            $this->outputSlipService->delete($outputSlip);

            return redirect()
                ->route('admin.warehouse.output-slips.index')
                ->with('success', 'Xóa phiếu xuất thành công.');
        } catch (\Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function complete(OutputSlip $outputSlip)
    {
        try {
            $this->outputSlipService->complete($outputSlip);

            return back()->with('success', 'Hoàn tất phiếu xuất và trừ kho thành công.');
        } catch (\Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function cancel(OutputSlip $outputSlip)
    {
        try {
            $this->outputSlipService->cancel($outputSlip);

            return back()->with('success', 'Hủy phiếu xuất thành công.');
        } catch (\Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
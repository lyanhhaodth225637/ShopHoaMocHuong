<?php

namespace App\Http\Controllers\SuperAdmin\Warehouse;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Warehouse\Supplier\StoreSupplierRequest;
use App\Http\Requests\SuperAdmin\Warehouse\Supplier\UpdateSupplierRequest;
use App\Models\Supplier;
use App\Services\Warehouse\SupplierService;

class SupplierController extends Controller
{
    public function __construct(
        protected SupplierService $supplierService
    ) {}

    public function index()
    {
        $suppliers = $this->supplierService->getList();

        return view('super-admin.warehouse.suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('super-admin.warehouse.suppliers.create');
    }

    public function store(StoreSupplierRequest $request)
    {
        $this->supplierService->store($request->validated());

        return redirect()
            ->route('admin.warehouse.suppliers.index')
            ->with('success', 'Thêm nhà cung cấp thành công.');
    }

    public function edit(Supplier $supplier)
    {
        return view('super-admin.warehouse.suppliers.edit', compact('supplier'));
    }

    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $this->supplierService->update($supplier, $request->validated());

        return redirect()
            ->route('admin.warehouse.suppliers.index')
            ->with('success', 'Cập nhật nhà cung cấp thành công.');
    }

    public function destroy(Supplier $supplier)
    {
        try {
            $this->supplierService->delete($supplier);

            return redirect()
                ->route('admin.warehouse.suppliers.index')
                ->with('success', 'Xóa nhà cung cấp thành công.');
        } catch (\Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
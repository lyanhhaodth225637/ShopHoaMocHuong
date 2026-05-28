<?php

namespace App\Http\Controllers\SuperAdmin\Warehouse;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Warehouse\Customer\StoreCustomerRequest;
use App\Http\Requests\SuperAdmin\Warehouse\Customer\UpdateCustomerRequest;
use App\Models\Customer;
use App\Services\Warehouse\CustomerService;

class CustomerController extends Controller
{
    public function __construct(
        protected CustomerService $customerService
    ) {
    }

    public function index()
    {
        $customers = $this->customerService->getList();

        return view('super-admin.warehouse.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('super-admin.warehouse.customers.create');
    }

    public function store(StoreCustomerRequest $request)
    {
        $this->customerService->store($request->validated());

        return redirect()
            ->route('admin.warehouse.customers.index')
            ->with('success', 'Thêm khách hàng thành công.');
    }

    public function edit(Customer $customer)
    {
        return view('super-admin.warehouse.customers.edit', compact('customer'));
    }

    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $this->customerService->update($customer, $request->validated());

        return redirect()
            ->route('admin.warehouse.customers.index')
            ->with('success', 'Cập nhật khách hàng thành công.');
    }

    public function destroy(Customer $customer)
    {
        try {
            $this->customerService->delete($customer);

            return redirect()
                ->route('admin.warehouse.customers.index')
                ->with('success', 'Xóa khách hàng thành công.');
        } catch (\Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
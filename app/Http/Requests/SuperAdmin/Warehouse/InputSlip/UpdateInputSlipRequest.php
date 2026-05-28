<?php

namespace App\Http\Requests\SuperAdmin\Warehouse\InputSlip;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInputSlipRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'supplier_id' => ['nullable', 'exists:suppliers,id'],
            'input_date' => ['required', 'date'],
            'note' => ['nullable', 'string'],

            'items' => ['required', 'array', 'min:1'],
            'items.*.sku_id' => ['required', 'exists:skus,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'items.*.cost_price' => ['required', 'numeric', 'min:0'],
            'items.*.note' => ['nullable', 'string'],
        ];
    }
}
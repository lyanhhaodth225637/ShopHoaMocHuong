<?php

namespace App\Http\Requests\SuperAdmin\Warehouse\OutputSlip;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOutputSlipRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_id' => ['nullable', 'exists:customers,id'],
            'output_date' => ['required', 'date'],
            'output_type' => [
                'required',
                Rule::in([
                    'sale',
                    'internal_use',
                    'damage',
                    'return_supplier',
                    'adjustment',
                    'other',
                ]),
            ],
            'note' => ['nullable', 'string'],

            'items' => ['required', 'array', 'min:1'],
            'items.*.sku_id' => ['required', 'exists:skus,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'items.*.sale_price' => ['required', 'numeric', 'min:0'],
            'items.*.note' => ['nullable', 'string'],
        ];
    }
}
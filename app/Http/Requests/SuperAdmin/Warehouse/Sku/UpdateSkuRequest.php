<?php

namespace App\Http\Requests\SuperAdmin\Warehouse\Sku;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSkuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'track_inventory' => $this->boolean('track_inventory'),
            'is_active' => $this->boolean('is_active'),
            'default_cost_price' => $this->input('default_cost_price', 0),
            'default_sale_price' => $this->input('default_sale_price', 0),
            'min_quantity' => $this->input('min_quantity', 0),
        ]);
    }

    public function rules(): array
    {
        $skuId = $this->route('sku')?->id;

        return [
            'unit_id' => ['required', 'exists:units,id'],
            'sku' => [
                'required',
                'string',
                'max:100',
                Rule::unique('skus', 'sku')->ignore($skuId),
            ],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'default_cost_price' => ['required', 'numeric', 'min:0'],
            'default_sale_price' => ['required', 'numeric', 'min:0'],
            'track_inventory' => ['boolean'],
            'min_quantity' => ['nullable', 'integer', 'min:0'],
            'max_quantity' => ['nullable', 'integer', 'min:0'],
            'attributes' => ['nullable', 'array'],
            'is_active' => ['boolean'],
        ];
    }
}

<?php

namespace App\Http\Requests\Admin\HomeHero;

use Illuminate\Foundation\Http\FormRequest;

class StoreHomeHeroStatRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->boolean('is_active'),
            'sort_order' => $this->sort_order ?? 0,
        ]);
    }

    public function rules(): array
    {
        return [
            'value' => ['required', 'string', 'max:255'],
            'label' => ['required', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'value.required' => 'Vui lòng nhập giá trị thống kê.',
            'label.required' => 'Vui lòng nhập nhãn thống kê.',
        ];
    }
}
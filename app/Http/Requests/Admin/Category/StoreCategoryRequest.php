<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $megaSectionLabel = $this->normalizeMegaSectionLabel($this->input('mega_section_label'));
        $megaSectionKey = $this->normalizeMegaSectionKey(
            $this->input('mega_section_key') ?: $megaSectionLabel
        );

        $this->merge([
            'is_active' => $this->boolean('is_active'),
            'mega_section_key' => $megaSectionKey,
            'mega_section_label' => $megaSectionLabel ?: $this->humanizeMegaSectionKey($megaSectionKey),
        ]);
    }

    public function rules(): array
    {
        return [
            'parent_id' => ['nullable', 'exists:categories,id'],
            'mega_section_key' => ['nullable', 'string', 'max:255'],
            'mega_section_label' => ['nullable', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'meta_title' => ['nullable', 'string'],
            'meta_description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên danh mục.',
            'parent_id.exists' => 'Danh mục cha không hợp lệ.',
            'sort_order.integer' => 'Thứ tự phải là số.',
            'sort_order.min' => 'Thứ tự không được nhỏ hơn 0.',
        ];
    }

    private function normalizeMegaSectionKey(?string $megaSectionKey): ?string
    {
        $megaSectionKey = trim((string) $megaSectionKey);

        if ($megaSectionKey === '') {
            return null;
        }

        return Str::slug($megaSectionKey, '_');
    }

    private function normalizeMegaSectionLabel(?string $megaSectionLabel): ?string
    {
        $megaSectionLabel = trim((string) $megaSectionLabel);

        return $megaSectionLabel === '' ? null : $megaSectionLabel;
    }

    private function humanizeMegaSectionKey(?string $megaSectionKey): ?string
    {
        if (!$megaSectionKey) {
            return null;
        }

        return (string) Str::of($megaSectionKey)
            ->replace('_', ' ')
            ->title();
    }
}

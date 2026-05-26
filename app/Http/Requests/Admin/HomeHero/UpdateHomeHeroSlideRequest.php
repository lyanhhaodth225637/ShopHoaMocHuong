<?php

namespace App\Http\Requests\Admin\HomeHero;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHomeHeroSlideRequest extends FormRequest
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
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'mobile_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'title' => ['nullable', 'string', 'max:255'],
            'alt' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'image.image' => 'File tải lên phải là hình ảnh.',
            'image.mimes' => 'Ảnh phải có định dạng jpg, jpeg, png hoặc webp.',
            'image.max' => 'Ảnh không được vượt quá 4MB.',
            'mobile_image.image' => 'Ảnh mobile tải lên phải là hình ảnh.',
            'mobile_image.mimes' => 'Ảnh mobile phải có định dạng jpg, jpeg, png hoặc webp.',
            'mobile_image.max' => 'Ảnh mobile không được vượt quá 4MB.',
        ];
    }
}

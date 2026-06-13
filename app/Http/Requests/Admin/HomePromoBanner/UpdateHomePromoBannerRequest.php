<?php

namespace App\Http\Requests\Admin\HomePromoBanner;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHomePromoBannerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'badge_text' => ['nullable', 'string', 'max:255'],
            'highlight_text' => ['nullable', 'string', 'max:255'],
            'button_text' => ['nullable', 'string', 'max:255'],
            'button_url' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5000'],
            'css_class' => ['nullable', 'string', 'max:255'],
            'size' => ['required', 'in:big,small'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }
}
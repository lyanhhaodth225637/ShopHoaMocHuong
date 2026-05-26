<?php

namespace App\Http\Requests\Admin\HomeHero;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHomeHeroRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->boolean('is_active'),
        ]);
    }

    public function rules(): array
    {
        return [
            'badge_text' => ['nullable', 'string', 'max:255'],

            'title_line_1' => ['nullable', 'string', 'max:255'],
            'title_highlight' => ['nullable', 'string', 'max:255'],
            'title_line_2' => ['nullable', 'string', 'max:255'],

            'subtitle' => ['nullable', 'string'],

            'primary_button_text' => ['nullable', 'string', 'max:255'],
            'primary_button_link' => ['nullable', 'string', 'max:255'],

            'secondary_button_text' => ['nullable', 'string', 'max:255'],
            'secondary_button_link' => ['nullable', 'string', 'max:255'],

            'circle_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],

            'float_badge_1_title' => ['nullable', 'string', 'max:255'],
            'float_badge_1_subtitle' => ['nullable', 'string', 'max:255'],

            'float_badge_2_title' => ['nullable', 'string', 'max:255'],
            'float_badge_2_subtitle' => ['nullable', 'string', 'max:255'],

            'is_active' => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'circle_image.image' => 'File tải lên phải là hình ảnh.',
            'circle_image.mimes' => 'Ảnh phải có định dạng jpg, jpeg, png hoặc webp.',
            'circle_image.max' => 'Ảnh không được vượt quá 4MB.',
        ];
    }
}
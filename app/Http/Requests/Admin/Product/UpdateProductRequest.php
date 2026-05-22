<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->boolean('is_active'),
            'is_featured' => $this->boolean('is_featured'),
        ]);
    }

    public function rules(): array
    {
        return [
            'category_ids' => ['nullable', 'array'],
            'category_ids.*' => ['exists:categories,id'],

            'name' => ['required', 'string', 'max:255'],

            'short_description' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],

            'price' => ['required', 'numeric', 'min:0'],
            'stock_quantity' => ['nullable', 'integer', 'min:0'],

            'main_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],

            'images' => ['nullable', 'array'],
            'images.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],

            'og_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],

            'is_active' => ['boolean'],
            'is_featured' => ['boolean'],

            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'meta_keywords' => ['nullable', 'string', 'max:255'],
            'canonical_url' => ['nullable', 'string', 'max:255'],

            'og_title' => ['nullable', 'string', 'max:255'],
            'og_description' => ['nullable', 'string'],

            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'category_ids.array' => 'Danh mục sản phẩm không hợp lệ.',
            'category_ids.*.exists' => 'Danh mục được chọn không tồn tại.',

            'name.required' => 'Vui lòng nhập tên sản phẩm.',
            'name.string' => 'Tên sản phẩm không hợp lệ.',
            'name.max' => 'Tên sản phẩm không được vượt quá 255 ký tự.',

            'price.required' => 'Vui lòng nhập giá sản phẩm.',
            'price.numeric' => 'Giá sản phẩm không hợp lệ.',
            'price.min' => 'Giá sản phẩm không được nhỏ hơn 0.',

            'stock_quantity.integer' => 'Số lượng tồn kho phải là số nguyên.',
            'stock_quantity.min' => 'Số lượng tồn kho không được nhỏ hơn 0.',

            'main_image.image' => 'Ảnh chính phải là file hình ảnh.',
            'main_image.mimes' => 'Ảnh chính chỉ chấp nhận jpg, jpeg, png, webp.',
            'main_image.max' => 'Ảnh chính không được vượt quá 5MB.',

            'images.array' => 'Danh sách ảnh phụ không hợp lệ.',
            'images.*.image' => 'Ảnh phụ phải là file hình ảnh.',
            'images.*.mimes' => 'Ảnh phụ chỉ chấp nhận jpg, jpeg, png, webp.',
            'images.*.max' => 'Mỗi ảnh phụ không được vượt quá 5MB.',

            'og_image.image' => 'Ảnh SEO phải là file hình ảnh.',
            'og_image.mimes' => 'Ảnh SEO chỉ chấp nhận jpg, jpeg, png, webp.',
            'og_image.max' => 'Ảnh SEO không được vượt quá 5MB.',

            'meta_title.max' => 'Meta title không được vượt quá 255 ký tự.',
            'meta_keywords.max' => 'Meta keywords không được vượt quá 255 ký tự.',
            'canonical_url.max' => 'Canonical URL không được vượt quá 255 ký tự.',

            'og_title.max' => 'OG title không được vượt quá 255 ký tự.',

            'sort_order.integer' => 'Thứ tự hiển thị phải là số nguyên.',
            'sort_order.min' => 'Thứ tự hiển thị không được nhỏ hơn 0.',
        ];
    }
}
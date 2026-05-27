<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;
class StoreProductRequest extends FormRequest
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
            'track_inventory' => $this->boolean('track_inventory', true),
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

            'sku' => ['nullable', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'cost_price' => ['nullable', 'numeric', 'min:0'],
            'stock_quantity' => ['nullable', 'integer', 'min:0'],
            'min_quantity' => ['nullable', 'integer', 'min:0'],
            'track_inventory' => ['boolean'],

            'main_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'video_url' => ['nullable', 'url', 'max:255'],

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
            'category_ids.array' => 'Danh muc san pham khong hop le.',
            'category_ids.*.exists' => 'Danh muc duoc chon khong ton tai.',

            'name.required' => 'Vui long nhap ten san pham.',
            'name.string' => 'Ten san pham khong hop le.',
            'name.max' => 'Ten san pham khong duoc vuot qua 255 ky tu.',

            'sku.max' => 'Ma SKU khong duoc vuot qua 255 ky tu.',
            'price.required' => 'Vui long nhap gia san pham.',
            'price.numeric' => 'Gia san pham khong hop le.',
            'price.min' => 'Gia san pham khong duoc nho hon 0.',

            'cost_price.numeric' => 'Gia von khong hop le.',
            'cost_price.min' => 'Gia von khong duoc nho hon 0.',

            'stock_quantity.integer' => 'So luong ton kho phai la so nguyen.',
            'stock_quantity.min' => 'So luong ton kho khong duoc nho hon 0.',

            'min_quantity.integer' => 'Ton toi thieu phai la so nguyen.',
            'min_quantity.min' => 'Ton toi thieu khong duoc nho hon 0.',

            'main_image.image' => 'Anh chinh phai la file hinh anh.',
            'main_image.mimes' => 'Anh chinh chi chap nhan jpg, jpeg, png, webp.',
            'main_image.max' => 'Anh chinh khong duoc vuot qua 5MB.',

            'video_url.url' => 'Link video khong dung dinh dang URL.',
            'video_url.max' => 'Link video khong duoc vuot qua 255 ky tu.',

            'images.array' => 'Danh sach anh phu khong hop le.',
            'images.*.image' => 'Anh phu phai la file hinh anh.',
            'images.*.mimes' => 'Anh phu chi chap nhan jpg, jpeg, png, webp.',
            'images.*.max' => 'Moi anh phu khong duoc vuot qua 5MB.',

            'og_image.image' => 'Anh SEO phai la file hinh anh.',
            'og_image.mimes' => 'Anh SEO chi chap nhan jpg, jpeg, png, webp.',
            'og_image.max' => 'Anh SEO khong duoc vuot qua 5MB.',

            'meta_title.max' => 'Meta title khong duoc vuot qua 255 ky tu.',
            'meta_keywords.max' => 'Meta keywords khong duoc vuot qua 255 ky tu.',
            'canonical_url.max' => 'Canonical URL khong duoc vuot qua 255 ky tu.',
            'og_title.max' => 'OG title khong duoc vuot qua 255 ky tu.',

            'sort_order.integer' => 'Thu tu hien thi phai la so nguyen.',
            'sort_order.min' => 'Thu tu hien thi khong duoc nho hon 0.',
        ];
    }
}

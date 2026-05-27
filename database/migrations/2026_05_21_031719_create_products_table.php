<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // Mã sản phẩm
            $table->string('sku')->unique()->nullable();

            // Thông tin cơ bản
            $table->string('name');
            $table->string('slug')->unique();

            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();

            // Giá
            $table->decimal('price', 12, 2)->default(0);

            // Kho
            $table->integer('stock_quantity')->default(0);

            // Ảnh chính
            $table->string('main_image')->nullable();
            $table->string('video_url')->nullable();

            // Trạng thái
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);

            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('canonical_url')->nullable();

            // Open Graph
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image')->nullable();

            // Sắp xếp
            $table->integer('sort_order')->default(0);

            $table->timestamps();
        });
    }

  
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

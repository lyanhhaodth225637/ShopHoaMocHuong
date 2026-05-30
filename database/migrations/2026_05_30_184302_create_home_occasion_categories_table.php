<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('home_occasion_categories', function (Blueprint $table) {
            $table->id();

            $table->string('title');

            // Emoji hoặc Font Awesome
            $table->string('icon')->nullable();

            $table->string('link_url')->nullable();

            // Nếu muốn liên kết với bảng categories
            $table->foreignId('category_id')
                ->nullable()
                ->constrained('categories')
                ->nullOnDelete();

            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_occasion_categories');
    }
};

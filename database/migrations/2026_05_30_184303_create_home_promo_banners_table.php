<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('home_promo_banners', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('description')->nullable();

            $table->string('badge_text')->nullable();
            $table->string('highlight_text')->nullable();

            $table->string('button_text')->nullable();
            $table->string('button_url')->nullable();

            // ảnh nền banner nếu sau này muốn upload
            $table->string('image')->nullable();

            // promo-banner-1, promo-banner-2, promo-banner-3
            $table->string('css_class')->nullable();

            $table->enum('size', ['big', 'small'])->default('small');

            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_promo_banners');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('home_hero_settings', function (Blueprint $table) {
            $table->id();

            $table->string('badge_text')->nullable();

            $table->string('title_line_1')->nullable();
            $table->string('title_highlight')->nullable();
            $table->string('title_line_2')->nullable();

            $table->text('subtitle')->nullable();

            $table->string('primary_button_text')->nullable();
            $table->string('primary_button_link')->nullable();

            $table->string('secondary_button_text')->nullable();
            $table->string('secondary_button_link')->nullable();

            $table->string('circle_image')->nullable();

            $table->string('float_badge_1_title')->nullable();
            $table->string('float_badge_1_subtitle')->nullable();

            $table->string('float_badge_2_title')->nullable();
            $table->string('float_badge_2_subtitle')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_hero_settings');
    }
};

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
        Schema::create('input_slip_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('input_slip_id')
                ->constrained('input_slips')
                ->cascadeOnDelete();

            $table->foreignId('sku_id')
                ->constrained('skus')
                ->restrictOnDelete();

            $table->integer('quantity');

            $table->decimal('cost_price', 12, 2)->default(0);
            $table->decimal('total_price', 14, 2)->default(0);

            $table->text('note')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('input_slip_items');
    }
};

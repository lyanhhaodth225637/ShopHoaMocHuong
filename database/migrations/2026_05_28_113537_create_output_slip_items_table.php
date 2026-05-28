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
        Schema::create('output_slip_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('output_slip_id')
                ->constrained('output_slips')
                ->cascadeOnDelete();

            $table->foreignId('sku_id')
                ->constrained('skus')
                ->restrictOnDelete();

            $table->integer('quantity');

            $table->decimal('sale_price', 12, 2)->default(0);
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
        Schema::dropIfExists('output_slip_items');
    }
};

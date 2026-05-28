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
        Schema::create('inventory_movements', function (Blueprint $table) {
            $table->id();

            $table->foreignId('sku_id')
                ->constrained('skus')
                ->cascadeOnDelete();

            $table->enum('movement_type', [
                'input',
                'output',
                'adjustment',
                'cancel_input',
                'cancel_output',
            ]);

            $table->integer('quantity_change');

            $table->integer('quantity_before')->default(0);
            $table->integer('quantity_after')->default(0);

            $table->nullableMorphs('reference');

            $table->text('note')->nullable();

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_movements');
    }
};

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
        Schema::create('output_slips', function (Blueprint $table) {
            $table->id();

            $table->string('code')->unique();

            $table->foreignId('customer_id')
                ->nullable()
                ->constrained('customers')
                ->nullOnDelete();

            $table->date('output_date');

            $table->enum('output_type', [
                'sale',
                'internal_use',
                'damage',
                'return_supplier',
                'adjustment',
                'other',
            ])->default('sale');

            $table->enum('status', [
                'draft',
                'completed',
                'cancelled',
            ])->default('draft');

            $table->decimal('total_amount', 14, 2)->default(0);

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
        Schema::dropIfExists('output_slips');
    }
};

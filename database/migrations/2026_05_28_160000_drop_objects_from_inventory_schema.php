<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('skus') && Schema::hasColumn('skus', 'object_id')) {
            Schema::table('skus', function (Blueprint $table) {
                $table->dropConstrainedForeignId('object_id');
            });
        }

        Schema::dropIfExists('objects');
    }

    public function down(): void
    {
        if (Schema::hasTable('objects')) {
            return;
        }

        Schema::create('objects', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        if (Schema::hasTable('skus') && ! Schema::hasColumn('skus', 'object_id')) {
            Schema::table('skus', function (Blueprint $table) {
                $table->foreignId('object_id')
                    ->nullable()
                    ->after('id')
                    ->constrained('objects')
                    ->nullOnDelete();
            });
        }
    }
};

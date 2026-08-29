<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('maps', function (Blueprint $table) {
            $table->id();

            $table->foreignId('mouza_id')
                ->constrained('mouzas')
                ->cascadeOnDelete();

            $table->string('title');
            $table->string('file_path');

            $table->string('file_name')->nullable();

            $table->decimal('price', 10, 2)->default(0);

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maps');
    }
};
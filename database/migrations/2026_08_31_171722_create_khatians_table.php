<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('khatians', function (Blueprint $table) {
        $table->id();

        $table->foreignId('mouza_id')
            ->constrained('mouzas')
            ->cascadeOnDelete();

        $table->foreignId('survey_type_id')
            ->constrained('survey_types')
            ->cascadeOnDelete();

        $table->string('khatian_number');

        $table->string('owner_name')->nullable();

        $table->string('pdf_path')->nullable();

        $table->decimal('price', 10, 2)->default(0);

        $table->boolean('is_active')->default(true);

        $table->timestamps();

        $table->index('khatian_number');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('khatians');
    }
};

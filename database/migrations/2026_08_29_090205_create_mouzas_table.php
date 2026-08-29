<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mouzas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('upazila_id')
                  ->constrained('upazilas')
                  ->cascadeOnDelete();

            $table->foreignId('survey_type_id')
                  ->constrained('survey_types')
                  ->cascadeOnDelete();

            $table->string('name');
            $table->string('name_bn')->nullable();

            $table->string('jl_number')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->unique([
                'upazila_id',
                'survey_type_id',
                'name'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mouzas');
    }
};
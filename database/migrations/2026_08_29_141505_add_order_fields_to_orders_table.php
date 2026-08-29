<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // All required order columns already exist
        // in the orders table.
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Nothing to rollback because this migration
        // does not add any columns.
    }
};
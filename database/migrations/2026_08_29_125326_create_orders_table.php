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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // Customer information
            $table->string('customer_name');
            $table->string('phone', 30);
            $table->string('email')->nullable();

            // Purchased map
            $table->foreignId('map_id')
                ->constrained('maps')
                ->cascadeOnDelete();

            // Order/payment information
            $table->decimal('amount', 10, 2);
            $table->string('payment_method')->nullable();

            // pending, paid, cancelled, completed
            $table->string('status')->default('pending');

            // Whether customer can download the map
            $table->boolean('download_allowed')->default(false);

            // Unique download token
            $table->string('download_token', 64)->nullable()->unique();

            // Download tracking
            $table->unsignedInteger('download_count')->default(0);
            $table->timestamp('downloaded_at')->nullable();

            $table->timestamps();

            // Faster dashboard statistics
            $table->index('status');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('divisions', function (Blueprint $table) {
            $table->string('name')->after('id');
            $table->string('name_bn')->nullable()->after('name');
            $table->boolean('status')->default(true)->after('name_bn');
        });
    }

    public function down(): void
    {
        Schema::table('divisions', function (Blueprint $table) {
            $table->dropColumn(['name', 'name_bn', 'status']);
        });
    }
};
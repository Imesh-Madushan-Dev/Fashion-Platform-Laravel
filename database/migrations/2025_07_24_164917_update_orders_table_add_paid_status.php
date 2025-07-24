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
        Schema::table('orders', function (Blueprint $table) {
            // Drop the existing enum column
            $table->dropColumn('status');
        });

        Schema::table('orders', function (Blueprint $table) {
            // Add the enum column with the correct values including 'paid'
            $table->enum('status', ['pending', 'paid', 'confirmed', 'in_progress', 'completed', 'cancelled', 'refunded'])
                  ->default('pending')
                  ->after('total_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Drop the updated enum column
            $table->dropColumn('status');
        });

        Schema::table('orders', function (Blueprint $table) {
            // Restore the original enum column
            $table->enum('status', ['pending', 'confirmed', 'in_progress', 'completed', 'cancelled', 'refunded'])
                  ->default('pending')
                  ->after('total_amount');
        });
    }
};

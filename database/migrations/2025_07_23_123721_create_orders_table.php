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
            $table->foreignId('buyer_id')->constrained('buyers')->onDelete('cascade');
            $table->foreignId('design_id')->constrained('designs')->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->decimal('unit_price', 10, 2);
            $table->decimal('total_amount', 10, 2);
            $table->enum('status', ['pending', 'confirmed', 'in_progress', 'completed', 'cancelled', 'refunded'])
                  ->default('pending');
            $table->text('notes')->nullable();
            $table->timestamp('ordered_at');
            $table->timestamps();
            $table->softDeletes();

            // Indexes for performance
            $table->index(['buyer_id', 'status']);
            $table->index(['design_id', 'status']);
            $table->index('ordered_at');
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

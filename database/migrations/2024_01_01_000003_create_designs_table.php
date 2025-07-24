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
        Schema::create('designs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('designer_id')->constrained('designers')->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->string('image_path');
            $table->string('category')->nullable();
            $table->json('tags')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            // Indexes for better performance
            $table->index(['designer_id', 'is_active']);
            $table->index(['category', 'is_active']);
            $table->index(['is_featured', 'is_active']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('designs');
    }
};
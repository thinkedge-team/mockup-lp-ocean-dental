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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('short_description')->nullable();
            $table->string('category', 100)->nullable(); // Dynamic user-defined category
            $table->string('badge', 50)->nullable(); // e.g., 'popular', 'recommended', 'new'
            $table->string('icon')->nullable(); // Font Awesome icon class
            $table->string('image')->nullable(); // File path for uploaded image
            
            // Split price range into start and end
            $table->decimal('price_start', 12, 2)->nullable(); // Starting price
            $table->decimal('price_end', 12, 2)->nullable(); // Ending price (nullable)
            
            // Duration with type
            $table->string('duration')->nullable(); // e.g., '30-45', '2-3', 'Sekitar 1 jam'
            $table->enum('duration_type', ['waktu', 'kunjungan'])->default('waktu'); // Type of duration
            
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};

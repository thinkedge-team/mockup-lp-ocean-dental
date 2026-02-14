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
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position'); // e.g., "Dokter Gigi Umum", "Orthodontist"
            $table->text('bio')->nullable();
            $table->string('photo')->nullable();
            $table->string('specialization')->nullable();
            $table->json('qualifications')->nullable(); // Array of degrees/certifications
            $table->integer('years_of_experience')->nullable();
            $table->json('social_links')->nullable(); // Instagram, LinkedIn, etc.
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_members');
    }
};

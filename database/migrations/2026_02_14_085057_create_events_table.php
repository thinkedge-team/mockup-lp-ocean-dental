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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('short_description')->nullable();
            $table->string('image')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->string('location');
            $table->text('address')->nullable();
            $table->string('category')->nullable(); // promo, seminar, workshop, dental-camp
            $table->integer('max_participants')->nullable();
            $table->integer('registered_participants')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->json('benefits')->nullable(); // Array of benefits
            $table->json('requirements')->nullable(); // Array of requirements
            $table->string('registration_url')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->json('meta_tags')->nullable(); // SEO meta tags
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};

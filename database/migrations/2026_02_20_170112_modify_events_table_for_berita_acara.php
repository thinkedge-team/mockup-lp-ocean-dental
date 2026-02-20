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
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn([
                'max_participants',
                'registered_participants',
                'benefits',
                'requirements',
                'registration_url',
                'price'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->integer('max_participants')->nullable();
            $table->integer('registered_participants')->default(0);
            $table->json('benefits')->nullable();
            $table->json('requirements')->nullable();
            $table->string('registration_url')->nullable();
            $table->decimal('price', 10, 2)->default(0);
        });
    }
};

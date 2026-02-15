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
        if (! Schema::hasColumn('locations', 'schedule')) {
            Schema::table('locations', function (Blueprint $table) {
                // Add schedule JSON column
                $table->json('schedule')->nullable();
            });
        }

        // After schedule is backfilled: drop legacy hour fields
        // Legacy column removal and backfill are skipped (already done or not needed).

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->dropColumn('schedule');
        });
    }
};

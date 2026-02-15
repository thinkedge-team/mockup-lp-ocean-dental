<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Replace all Unsplash URLs with NULL for team members
        DB::table('team_members')
            ->where('photo', 'like', 'https://images.unsplash.com%')
            ->update(['photo' => null]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Cannot restore original Unsplash URLs - this is a one-way migration
        // Team members will need to re-upload photos
    }
};

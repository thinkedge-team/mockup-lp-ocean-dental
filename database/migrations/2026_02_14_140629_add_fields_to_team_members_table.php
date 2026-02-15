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
        Schema::table('team_members', function (Blueprint $table) {
            $table->enum('badge', ['founder', 'specialist'])->nullable()->after('position');
            $table->enum('status', ['online', 'busy', 'offline'])->default('online')->after('badge');
            $table->decimal('rating', 2, 1)->default(5.0)->after('status');
            $table->string('review_count')->nullable()->after('rating');
            $table->string('patient_count')->nullable()->after('review_count');
            $table->json('expertise_tags')->nullable()->after('specialization');
            $table->string('university')->nullable()->after('qualifications');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('team_members', function (Blueprint $table) {
            $table->dropColumn(['badge', 'status', 'rating', 'review_count', 'patient_count', 'expertise_tags', 'university']);
        });
    }
};

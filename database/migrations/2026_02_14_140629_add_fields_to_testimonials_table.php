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
        Schema::table('testimonials', function (Blueprint $table) {
            $table->string('location')->nullable()->after('position');
            $table->string('service_type')->nullable()->after('service_used');
            $table->string('platform')->default('google')->after('service_type');
            $table->boolean('verified')->default(true)->after('platform');
            $table->timestamp('review_date')->nullable()->after('verified');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropColumn(['location', 'service_type', 'platform', 'verified', 'review_date']);
        });
    }
};

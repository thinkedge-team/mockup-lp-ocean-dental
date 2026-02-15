<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('soc_med_platforms', function (Blueprint $table) {
            $table->renameColumn('url', 'value');
        });
    }

    public function down(): void
    {
        Schema::table('soc_med_platforms', function (Blueprint $table) {
            $table->renameColumn('value', 'url');
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Gallery;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $mapping = [
            'klinik' => 'Klinik',
            'peralatan' => 'Peralatan',
            'tim' => 'Tim',
        ];
        
        echo "\n✓ Normalizing gallery categories to title case...\n\n";
        
        foreach ($mapping as $old => $new) {
            $count = Gallery::where('category', $old)->count();
            Gallery::where('category', $old)->update(['category' => $new]);
            echo "  ✓ Updated {$count} items: '{$old}' → '{$new}'\n";
        }
        
        echo "\n✓ Category normalization complete!\n";
        echo "✓ All categories are now in title case for consistency.\n\n";
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $mapping = [
            'Klinik' => 'klinik',
            'Peralatan' => 'peralatan',
            'Tim' => 'tim',
        ];
        
        foreach ($mapping as $old => $new) {
            Gallery::where('category', $old)->update(['category' => $new]);
        }
        
        echo "\n✓ Categories reverted to lowercase.\n\n";
    }
};

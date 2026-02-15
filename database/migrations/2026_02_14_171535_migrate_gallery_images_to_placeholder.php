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
        // Get all gallery items with external URLs (Unsplash)
        $galleries = Gallery::where('image', 'LIKE', 'http%')->get();
        
        echo "\n✓ Found {$galleries->count()} gallery items with external URLs\n";
        echo "✓ Migrating to placeholder (setting image to null)...\n\n";
        
        foreach ($galleries as $gallery) {
            $old = substr($gallery->image, 0, 60);
            $gallery->image = null;
            $gallery->save();
            
            echo "  ✓ Migrated: {$gallery->title}\n";
            echo "    Old: {$old}...\n";
            echo "    New: null (will show placeholder)\n\n";
        }
        
        echo "✓ Migration complete! All {$galleries->count()} items will now show placeholder image.\n";
        echo "✓ Upload real images through admin panel: http://localhost:8000/admin/galleries\n\n";
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        echo "\n✗ Cannot reverse: Original Unsplash URLs were permanently deleted.\n";
        echo "✓ This is expected behavior per user request (Option A).\n\n";
    }
};

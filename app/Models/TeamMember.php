<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'position',
        'bio',
        'photo',
        'specialization',
        'qualifications',
        'years_of_experience',
        'social_links',
        'badge',
        'status',
        'rating',
        'review_count',
        'patient_count',
        'expertise_tags',
        'university',
        'practice_locations',
        'order',
        'is_active',
    ];

    protected $casts = [
        'qualifications' => 'array',
        'social_links' => 'array',
        'expertise_tags' => 'array',
        'practice_locations' => 'array',
        'is_active' => 'boolean',
        'rating' => 'decimal:1',
        'review_count' => 'integer',
        'patient_count' => 'integer',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Auto-generate slug when creating (only if column exists)
        static::creating(function ($teamMember) {
            if (static::hasSlugColumn()) {
                if (empty($teamMember->slug)) {
                    $teamMember->slug = static::generateUniqueSlug($teamMember->name);
                }
            }
        });

        // Update slug when name changes (only if column exists)
        static::updating(function ($teamMember) {
            if (static::hasSlugColumn()) {
                if ($teamMember->isDirty('name')) {
                    $teamMember->slug = static::generateUniqueSlug($teamMember->name, $teamMember->id);
                }
            }
        });
        
        // Remove slug from attributes if column doesn't exist
        static::saving(function ($teamMember) {
            if (!static::hasSlugColumn() && isset($teamMember->attributes['slug'])) {
                unset($teamMember->attributes['slug']);
            }
        });
    }

    /**
     * Check if slug column exists in database.
     */
    protected static function hasSlugColumn()
    {
        static $hasColumn = null;
        
        if ($hasColumn === null) {
            try {
                $hasColumn = Schema::hasColumn('team_members', 'slug');
            } catch (\Exception $e) {
                $hasColumn = false;
            }
        }
        
        return $hasColumn;
    }

    /**
     * Generate a unique slug from name.
     */
    protected static function generateUniqueSlug($name, $ignoreId = null)
    {
        $slug = Str::slug($name);
        $count = 1;

        // Check if slug exists, if so add counter
        $query = static::where('slug', $slug);
        
        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        while ($query->exists()) {
            $slug = Str::slug($name) . '-' . $count;
            $count++;
            
            $query = static::where('slug', $slug);
            if ($ignoreId) {
                $query->where('id', '!=', $ignoreId);
            }
        }

        return $slug;
    }
}

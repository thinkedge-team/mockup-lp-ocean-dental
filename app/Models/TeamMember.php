<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

        // Auto-generate slug when creating
        static::creating(function ($teamMember) {
            if (empty($teamMember->slug)) {
                $teamMember->slug = static::generateUniqueSlug($teamMember->name);
            }
        });

        // Update slug when name changes
        static::updating(function ($teamMember) {
            if ($teamMember->isDirty('name') && empty($teamMember->slug)) {
                $teamMember->slug = static::generateUniqueSlug($teamMember->name);
            }
        });
    }

    /**
     * Generate a unique slug from name.
     */
    protected static function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $count = 1;

        // Check if slug exists, if so add counter
        while (static::where('slug', $slug)->exists()) {
            $slug = Str::slug($name) . '-' . $count;
            $count++;
        }

        return $slug;
    }
}

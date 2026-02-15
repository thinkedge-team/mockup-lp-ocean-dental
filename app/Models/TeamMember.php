<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
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
        'order',
        'is_active',
    ];

    protected $casts = [
        'qualifications' => 'array',
        'social_links' => 'array',
        'expertise_tags' => 'array',
        'is_active' => 'boolean',
        'rating' => 'decimal:1',
        'review_count' => 'integer',
        'patient_count' => 'integer',
    ];
}

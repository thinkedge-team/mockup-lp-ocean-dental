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
        'order',
        'is_active',
    ];

    protected $casts = [
        'qualifications' => 'array',
        'social_links' => 'array',
        'is_active' => 'boolean',
    ];
}

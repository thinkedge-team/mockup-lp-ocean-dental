<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'content',
        'rating',
        'avatar',
        'location',
        'service_type',
        'platform',
        'verified',
        'review_date',
        'service_used',
        'is_active',
        'is_featured',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'verified' => 'boolean',
        'rating' => 'decimal:1',
        'review_date' => 'datetime',
    ];
}

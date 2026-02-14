<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'short_description',
        'image',
        'start_date',
        'end_date',
        'location',
        'address',
        'category',
        'max_participants',
        'registered_participants',
        'is_active',
        'is_featured',
        'benefits',
        'requirements',
        'registration_url',
        'price',
        'meta_tags',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'benefits' => 'array',
        'requirements' => 'array',
        'meta_tags' => 'array',
        'price' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($event) {
            if (empty($event->slug)) {
                $event->slug = Str::slug($event->title);
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}

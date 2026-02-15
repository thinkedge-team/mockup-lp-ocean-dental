<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'address',
        'region_id',
        'whatsapp',
        'email',
        'latitude',
        'longitude',
        'schedule',
        'image',
        'order',
    ];

    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'schedule' => 'array',
    ];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($location) {
            if (empty($location->slug)) {
                $location->slug = Str::slug($location->name);
            }
        });
    }
}

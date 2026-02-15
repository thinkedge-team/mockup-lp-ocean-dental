<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'short_description',
        'category',
        'badge',
        'icon',
        'image',
        'price_start',
        'price_end',
        'duration',
        'duration_type',
        'order',
        'is_active',
        'is_featured',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'price_start' => 'decimal:2',
        'price_end' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->name);
            }
        });
    }

    /**
     * Get formatted price range
     */
    public function getFormattedPriceAttribute(): string
    {
        if (!$this->price_start) {
            return 'Hubungi kami';
        }

        $startInMillions = $this->price_start / 1000000;
        $start = 'Rp ' . ($startInMillions < 1 
            ? number_format($this->price_start / 1000, 0, ',', '.') . 'rb'
            : rtrim(rtrim(number_format($startInMillions, 1, ',', '.'), '0'), ',') . 'jt');
        
        if ($this->price_end && $this->price_end > $this->price_start) {
            $endInMillions = $this->price_end / 1000000;
            $end = $endInMillions < 1
                ? number_format($this->price_end / 1000, 0, ',', '.') . 'rb'
                : rtrim(rtrim(number_format($endInMillions, 1, ',', '.'), '0'), ',') . 'jt';
            return $start . ' - Rp ' . $end;
        }
        
        return $start . '+';
    }

    /**
     * Get formatted duration with type
     */
    public function getFormattedDurationAttribute(): ?string
    {
        if (!$this->duration) {
            return null;
        }

        if ($this->duration_type === 'kunjungan') {
            return $this->duration . ' kunjungan';
        }

        return $this->duration;
    }

    /**
     * Get image URL or placeholder
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }

        // Return placeholder (handled in view)
        return '';
    }
}

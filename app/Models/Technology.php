<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'tag',
        'description',
        'image',
        'is_highlight',
        'eyebrow_text',
        'feature_list',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_highlight'  => 'boolean',
        'is_active'     => 'boolean',
        'feature_list'  => 'array',
        'order'         => 'integer',
    ];

    // ── Accessors ────────────────────────────────────────────────────────────

    /**
     * URL publik gambar via storage symlink.
     */
    public function getImageUrlAttribute(): ?string
    {
        if (! $this->image) {
            return null;
        }

        // Jika sudah berupa URL penuh (mis. https://...), kembalikan apa adanya
        if (filter_var($this->image, FILTER_VALIDATE_URL)) {
            return $this->image;
        }

        return asset('storage/' . $this->image);
    }

    // ── Scopes ───────────────────────────────────────────────────────────────

    /**
     * Hanya item yang aktif.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Hanya item highlight (hero utama).
     */
    public function scopeHighlight($query)
    {
        return $query->where('is_highlight', true);
    }

    /**
     * Hanya item card biasa (bukan highlight).
     */
    public function scopeCards($query)
    {
        return $query->where('is_highlight', false);
    }
}

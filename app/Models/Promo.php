<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Promo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'price_highlight',
        'description',
        'image',
        'badge_text',
        'badge_icon',
        'badge_color',
        'category_tag',
        'category_icon',
        'discount_value',
        'discount_label',
        'discount_color_from',
        'discount_color_to',
        'price_from',
        'price_original',
        'price_suffix',
        'cta_text',
        'whatsapp_message',
        'expires_at',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active'      => 'boolean',
        'expires_at'     => 'date',
        'price_from'     => 'integer',
        'price_original' => 'integer',
        'order'          => 'integer',
    ];

    // ───────────────────────────────────────────────────────
    // Accessors
    // ───────────────────────────────────────────────────────

    /**
     * Harga promo dalam format Rupiah (mis. Rp 199.000)
     */
    public function getFormattedPriceFromAttribute(): ?string
    {
        if (! $this->price_from) {
            return null;
        }
        return 'Rp ' . number_format($this->price_from, 0, ',', '.');
    }

    /**
     * Harga asli (sebelum promo) dalam format Rupiah
     */
    public function getFormattedPriceOriginalAttribute(): ?string
    {
        if (! $this->price_original) {
            return null;
        }
        return 'Rp ' . number_format($this->price_original, 0, ',', '.');
    }

    /**
     * Apakah promo sudah kadaluarsa
     */
    public function getIsExpiredAttribute(): bool
    {
        if (! $this->expires_at) {
            return false;
        }
        return $this->expires_at->isPast();
    }

    /**
     * Format tanggal kadaluarsa (mis. "s/d 31 Juli 2025")
     */
    public function getFormattedExpiryAttribute(): ?string
    {
        if (! $this->expires_at) {
            return null;
        }
        return 's/d ' . $this->expires_at->translatedFormat('j F Y');
    }

    /**
     * Gradient style untuk diskon
     */
    public function getDiscountGradientStyleAttribute(): string
    {
        $from = $this->discount_color_from ?: '#EF4444';
        $to   = $this->discount_color_to   ?: '#DC2626';
        return "background:linear-gradient(135deg,{$from},{$to})";
    }

    /**
     * URL gambar atau null
     */
    public function getImageUrlAttribute(): ?string
    {
        if (! $this->image) {
            return null;
        }
        return asset('storage/' . $this->image);
    }

    // ───────────────────────────────────────────────────────
    // Scopes
    // ───────────────────────────────────────────────────────

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}

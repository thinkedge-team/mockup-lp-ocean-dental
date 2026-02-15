<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class SocMedPlatform extends Model
{
    use HasFactory;

    protected $fillable = [
        'platform',
        'label',
        'value',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getConfig(): array
    {
        return Config::get('social_platforms.platforms.'.$this->platform, [
            'name' => $this->platform,
            'icon' => 'fas fa-globe',
            'color' => '#666666',
            'bg_color' => 'rgba(0,0,0,0.1)',
            'type' => 'url',
        ]);
    }

    public function getIcon(): string
    {
        return $this->getConfig()['icon'] ?? 'fas fa-globe';
    }

    public function getColor(): string
    {
        return $this->getConfig()['color'] ?? '#666666';
    }

    public function getBgColor(): string
    {
        return $this->getConfig()['bg_color'] ?? 'rgba(0,0,0,0.1)';
    }

    public function getType(): string
    {
        return $this->getConfig()['type'] ?? 'url';
    }

    public function getUrl(): string
    {
        $value = $this->value;

        if (empty($value)) {
            return '#';
        }

        if ($this->getType() === 'phone') {
            $phone = preg_replace('/[^0-9]/', '', $value);

            return 'https://wa.me/'.$phone;
        }

        if (! str_starts_with($value, 'http://') && ! str_starts_with($value, 'https://')) {
            return 'https://'.$value;
        }

        return $value;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
    ];

    public static function get($key, $default = null)
    {
        // Cache all settings at once to prevent N+1 queries
        // Cache duration: 24 hours (86400 seconds)
        $allSettings = \Cache::remember('all_settings', 86400, function () {
            return self::all()->pluck('value', 'key')->toArray();
        });

        return $allSettings[$key] ?? $default;
    }

    public static function set($key, $value, $type = 'text', $group = 'general')
    {
        // Clear settings cache when updating
        \Cache::forget('all_settings');
        
        return self::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'type' => $type, 'group' => $group]
        );
    }

    public function getValueAttribute($value)
    {
        if ($this->type === 'image' && empty($value)) {
            return null;
        }

        return $value;
    }
}

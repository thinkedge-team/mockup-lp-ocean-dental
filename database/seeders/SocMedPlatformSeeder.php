<?php

namespace Database\Seeders;

use App\Models\SocMedPlatform;
use Illuminate\Database\Seeder;

class SocMedPlatformSeeder extends Seeder
{
    public function run(): void
    {
        $platforms = [
            [
                'platform' => 'instagram',
                'label' => 'Instagram',
                'value' => '',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'platform' => 'facebook',
                'label' => 'Facebook',
                'value' => '',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'platform' => 'youtube',
                'label' => 'YouTube',
                'value' => '',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'platform' => 'tiktok',
                'label' => 'TikTok',
                'value' => '',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'platform' => 'whatsapp',
                'label' => 'WhatsApp',
                'value' => '',
                'order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($platforms as $platform) {
            SocMedPlatform::updateOrCreate(
                ['platform' => $platform['platform']],
                $platform
            );
        }
    }
}

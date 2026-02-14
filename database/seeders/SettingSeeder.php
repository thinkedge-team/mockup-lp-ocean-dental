<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // Site Information
            ['key' => 'site_name', 'value' => 'Ocean Dental', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_tagline', 'value' => 'Senyum Sehat Bersama Kami', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_description', 'value' => 'Klinik Gigi Profesional & Terjangkau. 10+ tahun pengalaman, 25+ cabang di Jakarta & Jabodetabek. Senyum Sehat, Percaya Diri Meningkat.', 'type' => 'textarea', 'group' => 'general'],
            
            // Contact Information
            ['key' => 'contact_phone', 'value' => '081234567890', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_email', 'value' => 'info@oceandental.co.id', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_whatsapp', 'value' => '6281234567890', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_address', 'value' => 'Jl. Raya Bogor No. 123, Jakarta Timur 13810', 'type' => 'textarea', 'group' => 'contact'],
            
            // Operating Hours
            ['key' => 'operating_hours', 'value' => 'Daily 09:00-21:00', 'type' => 'text', 'group' => 'general'],
            ['key' => 'operating_hours_weekday', 'value' => '09:00 - 21:00', 'type' => 'text', 'group' => 'general'],
            ['key' => 'operating_hours_weekend', 'value' => '09:00 - 21:00', 'type' => 'text', 'group' => 'general'],
            
            // Social Media
            ['key' => 'social_facebook', 'value' => 'https://facebook.com/oceandental', 'type' => 'text', 'group' => 'social'],
            ['key' => 'social_instagram', 'value' => 'https://instagram.com/oceandental', 'type' => 'text', 'group' => 'social'],
            ['key' => 'social_twitter', 'value' => 'https://twitter.com/oceandental', 'type' => 'text', 'group' => 'social'],
            ['key' => 'social_youtube', 'value' => 'https://youtube.com/@oceandental', 'type' => 'text', 'group' => 'social'],
            ['key' => 'social_tiktok', 'value' => 'https://tiktok.com/@oceandental', 'type' => 'text', 'group' => 'social'],
            
            // Statistics
            ['key' => 'stat_branches', 'value' => '29', 'type' => 'text', 'group' => 'stats'],
            ['key' => 'stat_doctors', 'value' => '50', 'type' => 'text', 'group' => 'stats'],
            ['key' => 'stat_patients', 'value' => '100000', 'type' => 'text', 'group' => 'stats'],
            ['key' => 'stat_years', 'value' => '10', 'type' => 'text', 'group' => 'stats'],
            ['key' => 'stat_rating', 'value' => '4.8', 'type' => 'text', 'group' => 'stats'],
            
            // SEO
            ['key' => 'meta_keywords', 'value' => 'klinik gigi, ocean dental, dokter gigi jakarta, tambal gigi, behel, veneer, implant gigi, scaling, bleaching', 'type' => 'textarea', 'group' => 'seo'],
            ['key' => 'meta_author', 'value' => 'Ocean Dental', 'type' => 'text', 'group' => 'seo'],
            
            // Images
            ['key' => 'logo', 'value' => null, 'type' => 'image', 'group' => 'media'],
            ['key' => 'favicon', 'value' => null, 'type' => 'image', 'group' => 'media'],
            ['key' => 'og_image', 'value' => null, 'type' => 'image', 'group' => 'media'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}

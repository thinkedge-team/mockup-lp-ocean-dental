<?php

namespace Database\Seeders;

use App\Models\Setting;
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

            // Hero Section
            ['key' => 'hero_title', 'value' => 'Senyum Sehat', 'type' => 'text', 'group' => 'hero'],
            ['key' => 'hero_subtitle', 'value' => 'Bersama Ocean Dental', 'type' => 'text', 'group' => 'hero'],
            ['key' => 'hero_description', 'value' => 'Perawatan Gigi Profesional & Terjangkau', 'type' => 'text', 'group' => 'hero'],
            ['key' => 'hero_experience', 'value' => '10+ Tahun Pengalaman', 'type' => 'text', 'group' => 'hero'],
            ['key' => 'hero_branches', 'value' => '25+ Cabang', 'type' => 'text', 'group' => 'hero'],
            ['key' => 'hero_location', 'value' => 'di Jabodetabek', 'type' => 'text', 'group' => 'hero'],
            ['key' => 'hero_cta_primary', 'value' => 'Book Appointment Now', 'type' => 'text', 'group' => 'hero'],
            ['key' => 'hero_cta_secondary', 'value' => 'Lihat Layanan', 'type' => 'text', 'group' => 'hero'],
            ['key' => 'hero_badge_1', 'value' => 'Daily 09:00-21:00', 'type' => 'text', 'group' => 'hero'],
            ['key' => 'hero_badge_2', 'value' => 'Dokter Berpengalaman', 'type' => 'text', 'group' => 'hero'],
            ['key' => 'hero_badge_3', 'value' => 'Alat Modern & Steril', 'type' => 'text', 'group' => 'hero'],
            ['key' => 'hero_floating_rating', 'value' => '4.8', 'type' => 'text', 'group' => 'hero'],
            ['key' => 'hero_floating_rating_label', 'value' => 'Rating Pasien', 'type' => 'text', 'group' => 'hero'],

            // About Section
            ['key' => 'about_section_title', 'value' => 'Mengapa Memilih Ocean Dental?', 'type' => 'text', 'group' => 'about'],
            ['key' => 'about_section_description', 'value' => 'Lebih dari sekedar klinik gigi, kami adalah mitra kesehatan oral Anda', 'type' => 'text', 'group' => 'about'],
            ['key' => 'about_founder_name', 'value' => 'drg. Aersy Henny Paramitha', 'type' => 'text', 'group' => 'about'],
            ['key' => 'about_founder_role', 'value' => 'Founder & Lead Dentist', 'type' => 'text', 'group' => 'about'],
            ['key' => 'about_founder_quote', 'value' => 'Senyum yang sehat adalah cerminan dari tubuh yang sehat. Di Ocean Dental, kami tidak hanya merawat gigi, tetapi juga membangun kepercayaan diri setiap pasien.', 'type' => 'textarea', 'group' => 'about'],
            ['key' => 'about_founder_description', 'value' => 'Mendirikan Ocean Dental pada tahun 2013 dengan visi menyediakan layanan kesehatan gigi berkualitas yang dapat diakses oleh semua kalangan. Kini telah berkembang menjadi jaringan 29 cabang di Jabodetabek.', 'type' => 'textarea', 'group' => 'about'],
            ['key' => 'about_founder_university', 'value' => 'Universitas Trisakti', 'type' => 'text', 'group' => 'about'],
            ['key' => 'about_founder_certification', 'value' => 'PDGI Certified', 'type' => 'text', 'group' => 'about'],
            ['key' => 'about_founder_image', 'value' => null, 'type' => 'image', 'group' => 'about'],
            ['key' => 'about_years_experience', 'value' => '10', 'type' => 'text', 'group' => 'about'],
            ['key' => 'about_cta_text', 'value' => 'Konsultasi Sekarang', 'type' => 'text', 'group' => 'about'],

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
            ['key' => 'stat_patients', 'value' => '50000', 'type' => 'text', 'group' => 'stats'],
            ['key' => 'stat_years', 'value' => '10', 'type' => 'text', 'group' => 'stats'],
            ['key' => 'stat_rating', 'value' => '4.9', 'type' => 'text', 'group' => 'stats'],
            ['key' => 'stat_reviews', 'value' => '12500', 'type' => 'text', 'group' => 'stats'],

            // Testimonial Stats
            ['key' => 'testimonial_stat_patients', 'value' => '50000', 'type' => 'text', 'group' => 'testimonials'],
            ['key' => 'testimonial_stat_rating', 'value' => '4.9', 'type' => 'text', 'group' => 'testimonials'],
            ['key' => 'testimonial_stat_reviews', 'value' => '12500', 'type' => 'text', 'group' => 'testimonials'],

            // SEO
            ['key' => 'meta_keywords', 'value' => 'klinik gigi, ocean dental, dokter gigi jakarta, tambal gigi, behel, veneer, implant gigi, scaling, bleaching', 'type' => 'textarea', 'group' => 'seo'],
            ['key' => 'meta_author', 'value' => 'Ocean Dental', 'type' => 'text', 'group' => 'seo'],

            // Images
            ['key' => 'logo', 'value' => null, 'type' => 'image', 'group' => 'media'],
            ['key' => 'favicon', 'value' => null, 'type' => 'image', 'group' => 'media'],
            ['key' => 'og_image', 'value' => null, 'type' => 'image', 'group' => 'media'],

            // Results/Transformasi Section
            ['key' => 'results_section_title', 'value' => 'Hasil Perawatan Kami', 'type' => 'text', 'group' => 'results'],
            ['key' => 'results_section_description', 'value' => 'Lihat transformasi nyata dari pasien kami. Geser untuk melihat perbandingan sebelum dan sesudah perawatan.', 'type' => 'textarea', 'group' => 'results'],
            ['key' => 'results_cta_text', 'value' => 'Konsultasi Transformasi Senyum Anda', 'type' => 'text', 'group' => 'results'],
            ['key' => 'results_cta_message', 'value' => 'Saya ingin konsultasi untuk transformasi senyum', 'type' => 'text', 'group' => 'results'],

            // SocMed/Social Media Section
            ['key' => 'socmed_section_title', 'value' => 'Ikuti Kami di Media Sosial', 'type' => 'text', 'group' => 'socmed'],
            ['key' => 'socmed_section_description', 'value' => 'Dapatkan update terbaru, tips kesehatan gigi, dan promo menarik dari kami.', 'type' => 'textarea', 'group' => 'socmed'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                [
                    'value' => Setting::where('key', $setting['key'])->exists() ? Setting::where('key', $setting['key'])->first()->value : $setting['value'],
                    'type' => $setting['type'],
                    'group' => $setting['group'],
                ]
            );
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'key' => 'hero',
                'title' => 'Hero Section',
                'content' => [
                    'heading' => 'Senyum Sehat',
                    'subheading' => 'Bersama Ocean Dental',
                    'description' => 'Perawatan Gigi Profesional & Terjangkau',
                    'features' => [
                        '10+ Tahun Pengalaman',
                        '25+ Cabang di Jabodetabek',
                    ],
                    'badges' => [
                        ['icon' => 'fas fa-clock', 'text' => 'Daily 09:00-21:00'],
                        ['icon' => 'fas fa-award', 'text' => 'Dokter Berpengalaman'],
                        ['icon' => 'fas fa-shield-alt', 'text' => 'Alat Modern & Steril'],
                    ],
                ],
                'is_active' => true,
            ],
            [
                'key' => 'about',
                'title' => 'About Us',
                'content' => [
                    'heading' => 'Mengapa Memilih Ocean Dental?',
                    'description' => 'Lebih dari sekedar klinik gigi, kami adalah mitra kesehatan oral Anda',
                    'quote' => 'Senyum yang sehat adalah cerminan dari tubuh yang sehat. Di Ocean Dental, kami tidak hanya merawat gigi, tetapi juga membangun kepercayaan diri setiap pasien.',
                    'founder' => [
                        'name' => 'drg. Aersy Henny Paramitha',
                        'role' => 'Founder & Lead Dentist',
                        'description' => 'Mendirikan Ocean Dental pada tahun 2013 dengan visi menyediakan layanan kesehatan gigi berkualitas yang dapat diakses oleh semua kalangan. Kini telah berkembang menjadi jaringan 29 cabang di Jabodetabek.',
                        'education' => 'Universitas Trisakti',
                        'certification' => 'PDGI Certified',
                    ],
                ],
                'is_active' => true,
            ],
            [
                'key' => 'contact',
                'title' => 'Contact Information',
                'content' => [
                    'heading' => 'Hubungi Kami',
                    'description' => 'Kami siap melayani Anda dengan sepenuh hati',
                    'address' => 'Jl. Raya Bogor No. 123, Jakarta Timur 13810',
                    'phone' => '081234567890',
                    'email' => 'info@oceandental.co.id',
                    'whatsapp' => '6281234567890',
                ],
                'is_active' => true,
            ],
            [
                'key' => 'cta',
                'title' => 'Call to Action',
                'content' => [
                    'heading' => 'Siap Untuk Senyum Lebih Sehat?',
                    'description' => 'Konsultasi gratis dengan dokter gigi profesional kami sekarang',
                    'button_text' => 'Book Appointment Now',
                    'button_link' => 'https://wa.me/6281234567890',
                ],
                'is_active' => true,
            ],
        ];

        foreach ($pages as $page) {
            Page::create($page);
        }
    }
}

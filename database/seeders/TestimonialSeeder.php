<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Sarah Wijaya',
                'content' => 'Pelayanan di Ocean Dental sangat memuaskan! Dokternya ramah dan profesional. Hasil veneer saya sangat natural, seperti gigi asli. Highly recommended!',
                'rating' => 5,
                'position' => 'Marketing Manager',
                'order' => 1,
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Budi Santoso',
                'content' => 'Saya takut ke dokter gigi, tapi di Ocean Dental dokternya sangat sabar dan peralatannya modern. Proses cabut gigi hampir tidak terasa sakit. Terima kasih!',
                'rating' => 5,
                'position' => 'Entrepreneur',
                'order' => 2,
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Diana Putri',
                'content' => 'Hasil bleaching di Ocean Dental luar biasa! Gigi saya jadi putih bersih dalam 1 jam saja. Harganya juga terjangkau. Pasti balik lagi untuk perawatan lainnya.',
                'rating' => 5,
                'position' => 'Content Creator',
                'order' => 3,
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Ahmad Rizki',
                'content' => 'Pasang behel di Ocean Dental adalah keputusan terbaik! Dokter ortodonti-nya sangat kompeten dan hasilnya melampaui ekspektasi saya. Worth every penny!',
                'rating' => 5,
                'position' => 'Software Engineer',
                'order' => 4,
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Linda Kartika',
                'content' => 'Kliniknya bersih, nyaman, dan modern. Staffnya ramah-ramah. Saya rutin scaling di sini setiap 6 bulan. Highly satisfied with the service!',
                'rating' => 5,
                'position' => 'Teacher',
                'order' => 5,
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Michael Tan',
                'content' => 'Implant gigi saya di Ocean Dental hasilnya sempurna! Prosesnya profesional, tidak sakit, dan pemulihannya cepat. Terima kasih drg. Aersy dan tim!',
                'rating' => 5,
                'position' => 'Business Owner',
                'order' => 6,
                'is_active' => true,
                'is_featured' => true,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}

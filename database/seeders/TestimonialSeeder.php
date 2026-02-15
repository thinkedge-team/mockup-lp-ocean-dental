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
                'name' => 'Budi Santoso',
                'content' => 'Secara teknik dokter dan peralatan ok. Pelayanan ramah, tempat nyaman dan bersih. Harga terjangkau untuk kualitas yang didapat. Sudah 3 tahun jadi pasien tetap disini!',
                'rating' => 5,
                'position' => 'Pelanggan Setia',
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&h=150&fit=crop&crop=face',
                'location' => 'Jakarta Selatan',
                'service_type' => 'Scaling & Polishing',
                'platform' => 'google',
                'verified' => true,
                'review_date' => now()->subWeeks(2),
                'order' => 1,
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Siti Nurhaliza',
                'content' => 'Dokternya sabar banget, perawat juga ramah. Pas cabut gigi sama sekali gak sakit! Recommended banget untuk yang takut ke dokter gigi. Anak saya sekarang gak takut lagi.',
                'rating' => 5,
                'position' => 'Ibu Rumah Tangga',
                'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=150&h=150&fit=crop&crop=face',
                'location' => 'Bekasi',
                'service_type' => 'Cabut Gigi',
                'platform' => 'google',
                'verified' => true,
                'review_date' => now()->subMonth(),
                'order' => 2,
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Diana Putri',
                'content' => 'Hasil veneer saya memuaskan! Giginya kelihatan natural dan senyum jadi lebih percaya diri. Proses konsultasi detil banget, dokternya jelasin semua opsi dengan sabar.',
                'rating' => 5,
                'position' => 'Content Creator',
                'avatar' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=150&h=150&fit=crop&crop=face',
                'location' => 'Tangerang',
                'service_type' => 'Veneer',
                'platform' => 'instagram',
                'verified' => true,
                'review_date' => now()->subWeeks(3),
                'order' => 3,
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Ahmad Wijaya',
                'content' => 'Sudah langganan dari tahun 2015. Service konsisten bagus, dokternya profesional. Seluruh keluarga perawatan gigi disini. Cabang dimana-mana jadi gampang aksesnya.',
                'rating' => 5,
                'position' => 'Profesional',
                'avatar' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=150&h=150&fit=crop&crop=face',
                'location' => 'Jakarta Pusat',
                'service_type' => 'Perawatan Keluarga',
                'platform' => 'google',
                'verified' => true,
                'review_date' => now()->subWeek(),
                'order' => 4,
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Rina Anggraini',
                'content' => 'Behel saya sudah selesai setelah 2 tahun perawatan. Hasilnya luar biasa! Gigi rata sempurna. Dokter Michael sangat teliti dan profesional. Worth every penny!',
                'rating' => 5,
                'position' => 'Karyawan Swasta',
                'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150&h=150&fit=crop&crop=face',
                'location' => 'Kelapa Gading',
                'service_type' => 'Ortodonti / Behel',
                'platform' => 'google',
                'verified' => true,
                'review_date' => now()->subDays(2),
                'order' => 5,
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Hendro Kusuma',
                'content' => 'Implant gigi saya sukses tanpa komplikasi. Dokter David sangat ahli dan menjelaskan prosedur dengan detail. Recovery cepat dan sekarang bisa makan normal lagi.',
                'rating' => 4.5,
                'position' => 'Business Owner',
                'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=150&h=150&fit=crop&crop=face',
                'location' => 'PIK',
                'service_type' => 'Implant Gigi',
                'platform' => 'facebook',
                'verified' => true,
                'review_date' => now()->subMonth(),
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

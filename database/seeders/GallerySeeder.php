<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galleries = [
            [
                'title' => 'Ruang Perawatan Modern',
                'description' => 'Ruang perawatan kami dilengkapi dengan peralatan dental terkini dan suasana yang nyaman',
                'image' => 'gallery/placeholder-clinic-1.jpg',
                'category' => 'clinic',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Alat Dental Steril',
                'description' => 'Semua alat dental kami melalui proses sterilisasi standar internasional',
                'image' => 'gallery/placeholder-clinic-2.jpg',
                'category' => 'clinic',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Tim Dokter Profesional',
                'description' => 'Tim dokter gigi berpengalaman dan bersertifikat siap melayani Anda',
                'image' => 'gallery/placeholder-team-1.jpg',
                'category' => 'team',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Ruang Tunggu Nyaman',
                'description' => 'Ruang tunggu yang nyaman dengan fasilitas lengkap untuk kenyamanan pasien',
                'image' => 'gallery/placeholder-clinic-3.jpg',
                'category' => 'clinic',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Dental Check-up',
                'description' => 'Pemeriksaan gigi rutin dengan teknologi digital X-ray',
                'image' => 'gallery/placeholder-treatment-1.jpg',
                'category' => 'treatments',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'Pemasangan Behel',
                'description' => 'Hasil pemasangan behel dengan teknik ortodonti modern',
                'image' => 'gallery/placeholder-treatment-2.jpg',
                'category' => 'treatments',
                'order' => 6,
                'is_active' => true,
            ],
            [
                'title' => 'Veneer Gigi',
                'description' => 'Transformasi senyum dengan veneer gigi berkualitas tinggi',
                'image' => 'gallery/placeholder-treatment-3.jpg',
                'category' => 'treatments',
                'order' => 7,
                'is_active' => true,
            ],
            [
                'title' => 'Teeth Whitening',
                'description' => 'Hasil bleaching gigi dengan teknologi laser whitening',
                'image' => 'gallery/placeholder-treatment-4.jpg',
                'category' => 'treatments',
                'order' => 8,
                'is_active' => true,
            ],
            [
                'title' => 'Dental Implant',
                'description' => 'Pemasangan implant gigi dengan hasil natural dan tahan lama',
                'image' => 'gallery/placeholder-treatment-5.jpg',
                'category' => 'treatments',
                'order' => 9,
                'is_active' => true,
            ],
            [
                'title' => 'Konsultasi Gratis',
                'description' => 'Sesi konsultasi dengan dokter gigi untuk rencana perawatan terbaik',
                'image' => 'gallery/placeholder-event-1.jpg',
                'category' => 'events',
                'order' => 10,
                'is_active' => true,
            ],
        ];

        foreach ($galleries as $gallery) {
            Gallery::create($gallery);
        }
    }
}

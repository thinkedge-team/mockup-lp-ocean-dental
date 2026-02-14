<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Veneer Gigi',
                'slug' => 'veneer-gigi',
                'description' => '<p>Transformasi senyum dengan lapisan tipis yang mempercantik gigi dengan hasil natural dan tahan lama. Veneer adalah solusi sempurna untuk memperbaiki warna, bentuk, dan susunan gigi Anda.</p>
                <h3>Keuntungan Veneer:</h3>
                <ul>
                    <li>Hasil natural dan estetis</li>
                    <li>Tahan lama hingga 10-15 tahun</li>
                    <li>Minimal pengikisan gigi</li>
                    <li>Dapat memperbaiki warna gigi yang tidak bisa diputihkan</li>
                    <li>Memperbaiki bentuk dan ukuran gigi</li>
                </ul>',
                'icon' => 'fas fa-layer-group',
                'price_range' => 'Mulai Rp 1.5jt/gigi',
                'duration' => '1-2 Kunjungan',
                'order' => 1,
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Bleaching Gigi',
                'slug' => 'bleaching-gigi',
                'description' => '<p>Pemutihan gigi profesional untuk senyum lebih cerah hingga 8 tingkat dalam satu sesi. Menggunakan teknologi laser terbaru yang aman dan efektif.</p>
                <h3>Proses Bleaching:</h3>
                <ul>
                    <li>Konsultasi dan pemeriksaan awal</li>
                    <li>Pembersihan gigi (scaling)</li>
                    <li>Aplikasi gel pemutih khusus</li>
                    <li>Aktivasi dengan laser/LED light</li>
                    <li>Hasil langsung terlihat</li>
                </ul>',
                'icon' => 'fas fa-sun',
                'price_range' => 'Mulai Rp 800rb',
                'duration' => '1 Jam',
                'order' => 2,
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Scaling & Polishing',
                'slug' => 'scaling-polishing',
                'description' => '<p>Pembersihan karang gigi dan plak untuk menjaga kesehatan gusi dan mulut yang optimal. Direkomendasikan dilakukan setiap 6 bulan sekali.</p>
                <h3>Manfaat Scaling:</h3>
                <ul>
                    <li>Mencegah penyakit gusi</li>
                    <li>Menghilangkan bau mulut</li>
                    <li>Mencegah gigi berlubang</li>
                    <li>Gigi lebih bersih dan sehat</li>
                    <li>Mencegah kerusakan tulang pendukung gigi</li>
                </ul>',
                'icon' => 'fas fa-sparkles',
                'price_range' => 'Mulai Rp 250rb',
                'duration' => '30-45 Menit',
                'order' => 3,
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Behel / Kawat Gigi',
                'slug' => 'behel-kawat-gigi',
                'description' => '<p>Perbaiki susunan gigi untuk senyum lebih percaya diri. Tersedia berbagai jenis behel: metal, ceramic, self-ligating, dan Invisalign.</p>
                <h3>Jenis Behel:</h3>
                <ul>
                    <li>Metal Braces - Paling ekonomis dan efektif</li>
                    <li>Ceramic Braces - Lebih estetis, warna seperti gigi</li>
                    <li>Self-Ligating - Lebih nyaman, kontrol lebih jarang</li>
                    <li>Invisalign - Transparan, bisa dilepas pasang</li>
                </ul>',
                'icon' => 'fas fa-teeth',
                'price_range' => 'Mulai Rp 3jt',
                'duration' => '12-24 Bulan',
                'order' => 4,
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Implant Gigi',
                'slug' => 'implant-gigi',
                'description' => '<p>Solusi permanen untuk gigi yang hilang dengan hasil yang natural dan kuat. Implant gigi adalah pilihan terbaik untuk menggantikan gigi yang hilang.</p>
                <h3>Keunggulan Implant:</h3>
                <ul>
                    <li>Permanen dan tahan lama</li>
                    <li>Tidak merusak gigi sebelahnya</li>
                    <li>Terasa seperti gigi asli</li>
                    <li>Mencegah penyusutan tulang rahang</li>
                    <li>Fungsi mengunyah optimal</li>
                </ul>',
                'icon' => 'fas fa-tooth',
                'price_range' => 'Mulai Rp 8jt',
                'duration' => '3-6 Bulan',
                'order' => 5,
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Tambal Gigi',
                'slug' => 'tambal-gigi',
                'description' => '<p>Perbaikan gigi berlubang dengan bahan berkualitas tinggi. Menggunakan composite resin yang warnanya menyerupai gigi asli untuk hasil yang estetis.</p>',
                'icon' => 'fas fa-fill-drip',
                'price_range' => 'Mulai Rp 150rb',
                'duration' => '30 Menit',
                'order' => 6,
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Cabut Gigi',
                'slug' => 'cabut-gigi',
                'description' => '<p>Pencabutan gigi yang aman dan minim rasa sakit dengan teknik modern dan anastesi yang tepat.</p>',
                'icon' => 'fas fa-tooth',
                'price_range' => 'Mulai Rp 100rb',
                'duration' => '30 Menit',
                'order' => 7,
                'is_active' => true,
                'is_featured' => false,
            ],
            [
                'name' => 'Perawatan Saluran Akar',
                'slug' => 'perawatan-saluran-akar',
                'description' => '<p>Menyelamatkan gigi yang terinfeksi atau rusak parah dengan perawatan root canal yang presisi.</p>',
                'icon' => 'fas fa-tooth',
                'price_range' => 'Mulai Rp 500rb',
                'duration' => '1-3 Kunjungan',
                'order' => 8,
                'is_active' => true,
                'is_featured' => false,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}

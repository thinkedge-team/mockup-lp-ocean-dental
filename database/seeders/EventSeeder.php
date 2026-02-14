<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'title' => 'Free Dental Check-up Camp',
                'slug' => 'free-dental-check-up-camp',
                'description' => '<p>Ocean Dental dengan bangga mempersembahkan <strong>Free Dental Check-up Camp</strong>, sebuah program layanan kesehatan gigi gratis untuk masyarakat. Event ini merupakan bagian dari komitmen kami untuk meningkatkan kesadaran masyarakat akan pentingnya kesehatan gigi dan mulut.</p>
                <p>Dalam event ini, kami menawarkan pemeriksaan gigi lengkap secara GRATIS untuk <strong>100 peserta pertama</strong> yang mendaftar.</p>',
                'short_description' => 'Pemeriksaan gigi gratis untuk 100 peserta pertama. Dapatkan konsultasi kesehatan gigi Anda!',
                'category' => 'Community',
                'start_date' => Carbon::create(2026, 3, 15, 9, 0),
                'end_date' => Carbon::create(2026, 3, 15, 16, 0),
                'location' => 'Ocean Dental Kelapa Gading',
                'address' => 'Jl. Boulevard Raya No. 123, Kelapa Gading, Jakarta Utara',
                'price' => 0,
                'max_participants' => 100,
                'registered_participants' => 45,
                'benefits' => [
                    'Pemeriksaan gigi lengkap gratis',
                    'Konsultasi dengan dokter gigi berpengalaman',
                    'Goodie bag eksklusif',
                    'Diskon 20% untuk perawatan lanjutan',
                ],
                'requirements' => [
                    'Registrasi online wajib',
                    'Membawa KTP asli',
                    'Datang tepat waktu',
                ],
                'registration_url' => 'https://wa.me/6281234567890',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Webinar: Tips Perawatan Behel',
                'slug' => 'webinar-tips-perawatan-behel',
                'description' => '<p>Pelajari cara merawat behel dengan benar bersama drg. Michael Santoso, Sp.Ort. Gratis untuk umum! Termasuk sesi tanya jawab langsung.</p>',
                'short_description' => 'Webinar gratis tentang perawatan behel bersama ortodontis berpengalaman',
                'category' => 'Seminar',
                'start_date' => Carbon::create(2026, 3, 22, 19, 0),
                'end_date' => Carbon::create(2026, 3, 22, 20, 30),
                'location' => 'Zoom (Online)',
                'address' => 'Meeting Link akan dikirim via email setelah registrasi',
                'price' => 0,
                'max_participants' => 500,
                'registered_participants' => 234,
                'benefits' => [
                    'Panduan lengkap perawatan behel',
                    'Sesi tanya jawab langsung',
                    'E-certificate peserta',
                    'Tips dari ahli ortodonti',
                ],
                'registration_url' => 'https://wa.me/6281234567890',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Promo Ramadan: Paket Veneer Special',
                'slug' => 'promo-ramadan-paket-veneer-special',
                'description' => '<p>Diskon hingga 30% untuk pemasangan veneer! Cicilan 0% tersedia. Terbatas untuk 50 pasien pertama.</p>',
                'short_description' => 'Diskon 30% untuk veneer gigi, cicilan 0% tersedia untuk 50 pasien pertama',
                'category' => 'Promo',
                'start_date' => Carbon::create(2026, 3, 1, 0, 0),
                'end_date' => Carbon::create(2026, 3, 31, 23, 59),
                'location' => 'Semua Cabang',
                'address' => 'Berlaku di 29 cabang Ocean Dental se-Jabodetabek',
                'price' => 5250000, // After 30% discount from normal 7.5jt
                'max_participants' => 50,
                'registered_participants' => 12,
                'benefits' => [
                    'Diskon hingga 30%',
                    'Cicilan 0% hingga 6 bulan',
                    'Konsultasi gratis',
                    'Garansi 2 tahun',
                ],
                'registration_url' => 'https://wa.me/6281234567890',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Kids Dental Health Day',
                'slug' => 'kids-dental-health-day',
                'description' => '<p>Acara seru untuk anak-anak! Edukasi kesehatan gigi, games interaktif, face painting, dan pemeriksaan gigi gratis.</p>',
                'short_description' => 'Event edukatif dan menyenangkan untuk anak-anak dengan games dan pemeriksaan gigi gratis',
                'category' => 'Community',
                'start_date' => Carbon::create(2026, 4, 12, 10, 0),
                'end_date' => Carbon::create(2026, 4, 12, 15, 0),
                'location' => 'Ocean Dental Sunter',
                'address' => 'Jl. Danau Sunter Utara No. 456, Sunter, Jakarta Utara',
                'price' => 0,
                'max_participants' => 150,
                'registered_participants' => 67,
                'benefits' => [
                    'Pemeriksaan gigi gratis untuk anak',
                    'Face painting',
                    'Games interaktif',
                    'Hadiah menarik',
                    'Goodie bag untuk setiap anak',
                ],
                'requirements' => [
                    'Usia anak 3-12 tahun',
                    'Didampingi orang tua/wali',
                    'Registrasi online',
                ],
                'registration_url' => 'https://wa.me/6281234567890',
                'is_active' => true,
                'is_featured' => false,
            ],
            [
                'title' => 'Flash Sale: Scaling & Bleaching',
                'slug' => 'flash-sale-scaling-bleaching',
                'description' => '<p>Paket hemat scaling + bleaching hanya Rp 999rb (harga normal 1.5jt)! Dapatkan gigi bersih dan putih bersinar.</p>',
                'short_description' => 'Paket hemat scaling + bleaching dengan diskon 33%, hanya Rp 999.000',
                'category' => 'Promo',
                'start_date' => Carbon::create(2026, 4, 1, 0, 0),
                'end_date' => Carbon::create(2026, 4, 30, 23, 59),
                'location' => 'Cabang Pilihan',
                'address' => 'Berlaku di 15 cabang Ocean Dental terpilih',
                'price' => 999000,
                'max_participants' => null,
                'registered_participants' => 89,
                'benefits' => [
                    'Scaling pembersihan karang gigi',
                    'Bleaching untuk gigi lebih putih',
                    'Hemat Rp 501.000',
                    'Konsultasi gratis',
                ],
                'registration_url' => 'https://wa.me/6281234567890',
                'is_active' => true,
                'is_featured' => false,
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}

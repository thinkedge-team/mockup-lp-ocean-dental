<?php

namespace Database\Seeders;

use App\Models\Promo;
use Illuminate\Database\Seeder;

class PromoSeeder extends Seeder
{
    public function run(): void
    {
        $promos = [
            [
                'title'               => 'Paket Scaling + Bleaching',
                'price_highlight'     => 'Hemat s/d Rp 150.000',
                'description'         => 'Gigi bersih & cerah dalam 1 kunjungan. Berlaku di semua cabang.',
                'image'               => null,
                'badge_text'          => 'Promo Bulan Ini',
                'badge_icon'          => 'fas fa-fire',
                'badge_color'         => 'rgba(59,130,246,.9)',
                'category_tag'        => 'Scaling & Pemutihan',
                'category_icon'       => 'fas fa-tooth',
                'discount_value'      => '43%',
                'discount_label'      => 'OFF',
                'discount_color_from' => '#EF4444',
                'discount_color_to'   => '#DC2626',
                'price_from'          => 199000,
                'price_original'      => 350000,
                'price_suffix'        => null,
                'cta_text'            => 'Daftar',
                'whatsapp_message'    => 'Halo, saya tertarik dengan Promo Paket Scaling + Bleaching. Bisa info lebih lanjut?',
                'expires_at'          => '2025-07-31',
                'order'               => 0,
                'is_active'           => true,
            ],
            [
                'title'               => 'Behel Metal / Transparan',
                'price_highlight'     => 'Cicilan 0% — 24 Bulan',
                'description'         => 'Konsultasi gratis. Dikerjakan spesialis ortodonti berpengalaman.',
                'image'               => null,
                'badge_text'          => 'Promo Behel',
                'badge_icon'          => 'fas fa-star',
                'badge_color'         => 'rgba(124,58,237,.9)',
                'category_tag'        => 'Ortodonti',
                'category_icon'       => 'fas fa-teeth',
                'discount_value'      => '0%',
                'discount_label'      => 'cicilan',
                'discount_color_from' => '#7C3AED',
                'discount_color_to'   => '#5B21B6',
                'price_from'          => 750000,
                'price_original'      => null,
                'price_suffix'        => '/bln',
                'cta_text'            => 'Konsultasi',
                'whatsapp_message'    => 'Halo, saya ingin informasi promo Behel cicilan 0%. Bisa bantu?',
                'expires_at'          => '2025-08-31',
                'order'               => 1,
                'is_active'           => true,
            ],
            [
                'title'               => 'Veneer Porselen Premium',
                'price_highlight'     => 'Senyum Sempurna Instan',
                'description'         => 'Hasil natural, tahan lama 10+ tahun. Hanya 2 kali kunjungan.',
                'image'               => null,
                'badge_text'          => 'Promo Veneer',
                'badge_icon'          => 'fas fa-gem',
                'badge_color'         => 'rgba(5,150,105,.9)',
                'category_tag'        => 'Estetika',
                'category_icon'       => 'fas fa-smile',
                'discount_value'      => '20%',
                'discount_label'      => 'OFF',
                'discount_color_from' => '#059669',
                'discount_color_to'   => '#047857',
                'price_from'          => 1500000,
                'price_original'      => 1875000,
                'price_suffix'        => null,
                'cta_text'            => 'Tanya Harga',
                'whatsapp_message'    => 'Halo, saya tertarik dengan Promo Veneer Porselen Premium 20% OFF. Bisa info lebih lanjut?',
                'expires_at'          => '2025-09-30',
                'order'               => 2,
                'is_active'           => true,
            ],
            [
                'title'               => 'Implan Titanium Berkualitas',
                'price_highlight'     => 'Teknologi Digital 3D',
                'description'         => 'Presisi tinggi, pemasangan guided surgery. Garansi 5 tahun.',
                'image'               => null,
                'badge_text'          => 'Promo Implan',
                'badge_icon'          => 'fas fa-award',
                'badge_color'         => 'rgba(234,88,12,.9)',
                'category_tag'        => 'Implan Gigi',
                'category_icon'       => 'fas fa-syringe',
                'discount_value'      => '15%',
                'discount_label'      => 'OFF',
                'discount_color_from' => '#EA580C',
                'discount_color_to'   => '#C2410C',
                'price_from'          => 6800000,
                'price_original'      => 8000000,
                'price_suffix'        => null,
                'cta_text'            => 'Konsultasi',
                'whatsapp_message'    => 'Halo, saya ingin informasi promo Implan Titanium 15% OFF. Bisa bantu?',
                'expires_at'          => '2025-10-31',
                'order'               => 3,
                'is_active'           => true,
            ],
        ];

        foreach ($promos as $data) {
            Promo::updateOrCreate(
                ['title' => $data['title']],
                $data
            );
        }

        $this->command->info('✅ PromoSeeder: ' . count($promos) . ' promo berhasil ditambahkan.');
    }
}

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
                'title' => 'Ruang Perawatan',
                'description' => 'Modern & Nyaman',
                'image' => 'https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?w=600&h=400&fit=crop',
                'category' => 'klinik',
                'size' => 'normal',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Ruang Sterilisasi',
                'description' => 'Standar Internasional',
                'image' => 'https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?w=600&h=400&fit=crop',
                'category' => 'klinik',
                'size' => 'normal',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Dental Chair',
                'description' => 'Teknologi Terkini',
                'image' => 'https://images.unsplash.com/photo-1609840114035-3c981b782dfe?w=600&h=400&fit=crop',
                'category' => 'peralatan',
                'size' => 'normal',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Area Resepsionis',
                'description' => 'Pelayanan Ramah 24/7',
                'image' => 'https://images.unsplash.com/photo-1629909615184-74f495363b67?w=800&h=400&fit=crop',
                'category' => 'klinik',
                'size' => 'wide',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Tim Dokter',
                'description' => 'Profesional & Berpengalaman',
                'image' => 'https://images.unsplash.com/photo-1606811841689-23dfddce3e95?w=600&h=400&fit=crop',
                'category' => 'tim',
                'size' => 'normal',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'X-Ray Digital',
                'description' => 'Diagnosis Akurat',
                'image' => 'https://images.unsplash.com/photo-1598256989800-fe5f95da9787?w=600&h=400&fit=crop',
                'category' => 'peralatan',
                'size' => 'normal',
                'order' => 6,
                'is_active' => true,
            ],
            [
                'title' => 'Pasien Bahagia',
                'description' => 'Senyum Sehat & Percaya Diri',
                'image' => 'https://images.unsplash.com/photo-1606265752439-1f18756aa5fc?w=600&h=800&fit=crop',
                'category' => 'tim',
                'size' => 'tall',
                'order' => 7,
                'is_active' => true,
            ],
            [
                'title' => 'Ruang Tunggu',
                'description' => 'Nyaman & Bersih',
                'image' => 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?w=600&h=400&fit=crop',
                'category' => 'klinik',
                'size' => 'normal',
                'order' => 8,
                'is_active' => true,
            ],
            [
                'title' => 'Autoclave Sterilizer',
                'description' => 'Jaminan Kebersihan 100%',
                'image' => 'https://images.unsplash.com/photo-1629909615184-74f495363b67?w=800&h=400&fit=crop',
                'category' => 'peralatan',
                'size' => 'wide',
                'order' => 9,
                'is_active' => true,
            ],
        ];

        foreach ($galleries as $gallery) {
            Gallery::create($gallery);
        }
    }
}

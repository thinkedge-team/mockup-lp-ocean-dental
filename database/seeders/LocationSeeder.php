<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            [
                'name' => 'Ocean Dental Kelapa Gading',
                'slug' => 'ocean-dental-kelapa-gading',
                'address' => 'Mall Kelapa Gading 3, Lantai 2, Jl. Boulevard Barat Raya, Kelapa Gading, Jakarta Utara 14240',
                'phone' => '(021) 4587-1001',
                'whatsapp' => '628214871001',
                'email' => 'kelapagading@oceandental.id',
                'latitude' => -6.1584000,
                'longitude' => 106.9049000,
                'opening_hours' => [
                    'monday' => ['open' => '09:00', 'close' => '21:00'],
                    'tuesday' => ['open' => '09:00', 'close' => '21:00'],
                    'wednesday' => ['open' => '09:00', 'close' => '21:00'],
                    'thursday' => ['open' => '09:00', 'close' => '21:00'],
                    'friday' => ['open' => '09:00', 'close' => '21:00'],
                    'saturday' => ['open' => '09:00', 'close' => '21:00'],
                    'sunday' => ['open' => '09:00', 'close' => '21:00'],
                ],
                'maps_embed_url' => 'https://maps.google.com/?q=-6.1584,106.9049',
                'order' => 1,
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Ocean Dental Pondok Indah',
                'slug' => 'ocean-dental-pondok-indah',
                'address' => 'Pondok Indah Mall 2, Lantai 2, Jl. Metro Pondok Indah, Jakarta Selatan 12310',
                'phone' => '(021) 7592-3001',
                'whatsapp' => '628175923001',
                'email' => 'pondokindah@oceandental.id',
                'latitude' => -6.2659000,
                'longitude' => 106.7844000,
                'opening_hours' => [
                    'monday' => ['open' => '10:00', 'close' => '22:00'],
                    'tuesday' => ['open' => '10:00', 'close' => '22:00'],
                    'wednesday' => ['open' => '10:00', 'close' => '22:00'],
                    'thursday' => ['open' => '10:00', 'close' => '22:00'],
                    'friday' => ['open' => '10:00', 'close' => '22:00'],
                    'saturday' => ['open' => '10:00', 'close' => '22:00'],
                    'sunday' => ['open' => '10:00', 'close' => '22:00'],
                ],
                'maps_embed_url' => 'https://maps.google.com/?q=-6.2659,106.7844',
                'order' => 2,
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Ocean Dental Sunter',
                'slug' => 'ocean-dental-sunter',
                'address' => 'Sunter Mall, Lantai 1, Jl. Danau Sunter Utara, Sunter, Jakarta Utara 14350',
                'phone' => '(021) 6530-4001',
                'whatsapp' => '628165304001',
                'email' => 'sunter@oceandental.id',
                'latitude' => -6.1384000,
                'longitude' => 106.8656000,
                'opening_hours' => [
                    'monday' => ['open' => '09:00', 'close' => '21:00'],
                    'tuesday' => ['open' => '09:00', 'close' => '21:00'],
                    'wednesday' => ['open' => '09:00', 'close' => '21:00'],
                    'thursday' => ['open' => '09:00', 'close' => '21:00'],
                    'friday' => ['open' => '09:00', 'close' => '21:00'],
                    'saturday' => ['open' => '09:00', 'close' => '21:00'],
                    'sunday' => ['open' => '09:00', 'close' => '21:00'],
                ],
                'maps_embed_url' => 'https://maps.google.com/?q=-6.1384,106.8656',
                'order' => 3,
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Ocean Dental PIK',
                'slug' => 'ocean-dental-pik',
                'address' => 'PIK Avenue Mall, Lantai 3, Jl. Pantai Indah Kapuk, Jakarta Utara 14460',
                'phone' => '(021) 5088-7001',
                'whatsapp' => '628150887001',
                'email' => 'pik@oceandental.id',
                'latitude' => -6.1084000,
                'longitude' => 106.7429000,
                'opening_hours' => [
                    'monday' => ['open' => '10:00', 'close' => '22:00'],
                    'tuesday' => ['open' => '10:00', 'close' => '22:00'],
                    'wednesday' => ['open' => '10:00', 'close' => '22:00'],
                    'thursday' => ['open' => '10:00', 'close' => '22:00'],
                    'friday' => ['open' => '10:00', 'close' => '22:00'],
                    'saturday' => ['open' => '10:00', 'close' => '22:00'],
                    'sunday' => ['open' => '10:00', 'close' => '22:00'],
                ],
                'maps_embed_url' => 'https://maps.google.com/?q=-6.1084,106.7429',
                'order' => 4,
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Ocean Dental Senayan City',
                'slug' => 'ocean-dental-senayan-city',
                'address' => 'Senayan City Mall, Lantai UG, Jl. Asia Afrika, Jakarta Pusat 10270',
                'phone' => '(021) 7278-5001',
                'whatsapp' => '628172785001',
                'email' => 'senayan@oceandental.id',
                'latitude' => -6.2249000,
                'longitude' => 106.8011000,
                'opening_hours' => [
                    'monday' => ['open' => '10:00', 'close' => '22:00'],
                    'tuesday' => ['open' => '10:00', 'close' => '22:00'],
                    'wednesday' => ['open' => '10:00', 'close' => '22:00'],
                    'thursday' => ['open' => '10:00', 'close' => '22:00'],
                    'friday' => ['open' => '10:00', 'close' => '22:00'],
                    'saturday' => ['open' => '10:00', 'close' => '22:00'],
                    'sunday' => ['open' => '10:00', 'close' => '22:00'],
                ],
                'maps_embed_url' => 'https://maps.google.com/?q=-6.2249,106.8011',
                'order' => 5,
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Ocean Dental BSD',
                'slug' => 'ocean-dental-bsd',
                'address' => 'The Breeze BSD, Lantai 2, Jl. Grand Boulevard, BSD City, Tangerang 15345',
                'phone' => '(021) 5316-2001',
                'whatsapp' => '628153162001',
                'email' => 'bsd@oceandental.id',
                'latitude' => -6.3023000,
                'longitude' => 106.6520000,
                'opening_hours' => [
                    'monday' => ['open' => '09:00', 'close' => '21:00'],
                    'tuesday' => ['open' => '09:00', 'close' => '21:00'],
                    'wednesday' => ['open' => '09:00', 'close' => '21:00'],
                    'thursday' => ['open' => '09:00', 'close' => '21:00'],
                    'friday' => ['open' => '09:00', 'close' => '21:00'],
                    'saturday' => ['open' => '09:00', 'close' => '21:00'],
                    'sunday' => ['open' => '09:00', 'close' => '21:00'],
                ],
                'maps_embed_url' => 'https://maps.google.com/?q=-6.3023,106.6520',
                'order' => 6,
                'is_active' => true,
                'is_featured' => true,
            ],
        ];

        foreach ($locations as $location) {
            Location::create($location);
        }
    }
}

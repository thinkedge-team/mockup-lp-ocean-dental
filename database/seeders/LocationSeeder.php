<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regionNames = collect([
            'Jakarta Utara',
            'Jakarta Selatan',
            'Jakarta Barat',
            'Jakarta Timur',
            'Bekasi Barat',
            'Bekasi Utara',
            'Bekasi Timur',
        ]);
        $regionMap = $regionNames->mapWithKeys(function ($name) {
            return [strtolower($name) => \App\Models\Region::firstOrCreate(['name' => $name])->id];
        });

        $locations = [
            [
                'name' => 'Ocean Dental Kelapa Gading',
                'slug' => 'ocean-dental-kelapa-gading',
                'address' => 'Mall Kelapa Gading 3, Lantai 2, Jl. Boulevard Barat Raya, Kelapa Gading, Jakarta Utara 14240',
                'region_id' => $regionMap['jakarta utara'],
                'whatsapp' => '(021) 4587-1001 / 628214871001',
                'email' => 'kelapagading@oceandental.id',
                'latitude' => -6.1584000,
                'longitude' => 106.9049000,
                'schedule' => [
                    'monday' => ['open' => '09:00', 'close' => '21:00'],
                    'tuesday' => ['open' => '09:00', 'close' => '21:00'],
                    'wednesday' => ['open' => '09:00', 'close' => '21:00'],
                    'thursday' => ['open' => '09:00', 'close' => '21:00'],
                    'friday' => ['open' => '09:00', 'close' => '21:00'],
                    'saturday' => ['open' => '09:00', 'close' => '21:00'],
                    'sunday' => ['open' => '09:00', 'close' => '21:00'],
                ],
                'order' => 1,
            ],
            [
                'name' => 'Ocean Dental Pondok Indah',
                'slug' => 'ocean-dental-pondok-indah',
                'address' => 'Pondok Indah Mall 2, Lantai 2, Jl. Metro Pondok Indah, Jakarta Selatan 12310',
                'region_id' => $regionMap['jakarta selatan'],
                'whatsapp' => '(021) 7592-3001 / 628175923001',
                'email' => 'pondokindah@oceandental.id',
                'latitude' => -6.2659000,
                'longitude' => 106.7844000,
                'schedule' => [
                    'monday' => ['open' => '10:00', 'close' => '22:00'],
                    'tuesday' => ['open' => '10:00', 'close' => '22:00'],
                    'wednesday' => ['open' => '10:00', 'close' => '22:00'],
                    'thursday' => ['open' => '10:00', 'close' => '22:00'],
                    'friday' => ['open' => '10:00', 'close' => '22:00'],
                    'saturday' => ['open' => '10:00', 'close' => '22:00'],
                    'sunday' => ['open' => '10:00', 'close' => '22:00'],
                ],
                'order' => 2,
            ],
            [
                'name' => 'Ocean Dental Sunter',
                'slug' => 'ocean-dental-sunter',
                'address' => 'Sunter Mall, Lantai 1, Jl. Danau Sunter Utara, Sunter, Jakarta Utara 14350',
                'region_id' => $regionMap['jakarta utara'],
                'whatsapp' => '(021) 6530-4001 / 628165304001',
                'email' => 'sunter@oceandental.id',
                'latitude' => -6.1384000,
                'longitude' => 106.8656000,
                'schedule' => [
                    'monday' => ['open' => '09:00', 'close' => '21:00'],
                    'tuesday' => ['open' => '09:00', 'close' => '21:00'],
                    'wednesday' => ['open' => '09:00', 'close' => '21:00'],
                    'thursday' => ['open' => '09:00', 'close' => '21:00'],
                    'friday' => ['open' => '09:00', 'close' => '21:00'],
                    'saturday' => ['open' => '09:00', 'close' => '21:00'],
                    'sunday' => ['open' => '09:00', 'close' => '21:00'],
                ],
                'order' => 3,
            ],
            [
                'name' => 'Ocean Dental PIK',
                'slug' => 'ocean-dental-pik',
                'address' => 'PIK Avenue Mall, Lantai 3, Jl. Pantai Indah Kapuk, Jakarta Utara 14460',
                'region_id' => $regionMap['jakarta utara'],
                'whatsapp' => '(021) 5088-7001 / 628150887001',
                'email' => 'pik@oceandental.id',
                'latitude' => -6.1084000,
                'longitude' => 106.7429000,
                'schedule' => [
                    'monday' => ['open' => '10:00', 'close' => '22:00'],
                    'tuesday' => ['open' => '10:00', 'close' => '22:00'],
                    'wednesday' => ['open' => '10:00', 'close' => '22:00'],
                    'thursday' => ['open' => '10:00', 'close' => '22:00'],
                    'friday' => ['open' => '10:00', 'close' => '22:00'],
                    'saturday' => ['open' => '10:00', 'close' => '22:00'],
                    'sunday' => ['open' => '10:00', 'close' => '22:00'],
                ],
                'order' => 4,
            ],
            [
                'name' => 'Ocean Dental Senayan City',
                'slug' => 'ocean-dental-senayan-city',
                'address' => 'Senayan City Mall, Lantai UG, Jl. Asia Afrika, Jakarta Pusat 10270',
                'region_id' => $regionMap['jakarta selatan'],
                'whatsapp' => '(021) 7278-5001 / 628172785001',
                'email' => 'senayan@oceandental.id',
                'latitude' => -6.2249000,
                'longitude' => 106.8011000,
                'schedule' => [
                    'monday' => ['open' => '10:00', 'close' => '22:00'],
                    'tuesday' => ['open' => '10:00', 'close' => '22:00'],
                    'wednesday' => ['open' => '10:00', 'close' => '22:00'],
                    'thursday' => ['open' => '10:00', 'close' => '22:00'],
                    'friday' => ['open' => '10:00', 'close' => '22:00'],
                    'saturday' => ['open' => '10:00', 'close' => '22:00'],
                    'sunday' => ['open' => '10:00', 'close' => '22:00'],
                ],
                'order' => 5,
            ],
            [
                'name' => 'Ocean Dental BSD',
                'slug' => 'ocean-dental-bsd',
                'address' => 'The Breeze BSD, Lantai 2, Jl. Grand Boulevard, BSD City, Tangerang 15345',
                'region_id' => $regionMap['bekasi barat'],
                'whatsapp' => '(021) 5316-2001 / 628153162001',
                'email' => 'bsd@oceandental.id',
                'latitude' => -6.3023000,
                'longitude' => 106.6520000,
                'schedule' => [
                    'monday' => ['open' => '09:00', 'close' => '21:00'],
                    'tuesday' => ['open' => '09:00', 'close' => '21:00'],
                    'wednesday' => ['open' => '09:00', 'close' => '21:00'],
                    'thursday' => ['open' => '09:00', 'close' => '21:00'],
                    'friday' => ['open' => '09:00', 'close' => '21:00'],
                    'saturday' => ['open' => '09:00', 'close' => '21:00'],
                    'sunday' => ['open' => '09:00', 'close' => '21:00'],
                ],
                'order' => 6,
            ],
        ];

        foreach ($locations as $location) {
            foreach (
                [
                    'monday_open',
                    'monday_close',
                    'tuesday_open',
                    'tuesday_close',
                    'wednesday_open',
                    'wednesday_close',
                    'thursday_open',
                    'thursday_close',
                    'friday_open',
                    'friday_close',
                    'saturday_open',
                    'saturday_close',
                    'sunday_open',
                    'sunday_close',
                ] as $field
            ) {
                unset($location[$field]);
            }
            Location::create($location);
        }
    }
}

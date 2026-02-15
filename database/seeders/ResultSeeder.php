<?php

namespace Database\Seeders;

use App\Models\Result;
use Illuminate\Database\Seeder;

class ResultSeeder extends Seeder
{
    public function run(): void
    {
        $results = [
            [
                'title' => 'Pemasangan Veneer',
                'before_image' => 'https://images.unsplash.com/photo-1606811841689-23dfddce3e95?w=800&h=600&fit=crop',
                'after_image' => 'https://images.unsplash.com/photo-1598256989800-fe5f95da9787?w=800&h=600&fit=crop',
                'description' => 'Transformasi senyum dengan veneer porcelain premium',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Bleaching & Scaling',
                'before_image' => 'https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?w=800&h=600&fit=crop',
                'after_image' => 'https://images.unsplash.com/photo-1606265752439-1f18756aa5fc?w=800&h=600&fit=crop',
                'description' => 'Pemutihan gigi profesional hingga 8 tingkat lebih cerah',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Perawatan Behel',
                'before_image' => 'https://images.unsplash.com/photo-1598256989800-fe5f95da9787?w=800&h=600&fit=crop',
                'after_image' => 'https://images.unsplash.com/photo-1606811841689-23dfddce3e95?w=800&h=600&fit=crop',
                'description' => 'Hasil perawatan ortodonti selama 18 bulan',
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($results as $result) {
            Result::create($result);
        }
    }
}

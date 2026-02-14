<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call all seeders in the correct order
        // Settings and Pages first (no dependencies)
        $this->call([
            SettingSeeder::class,
            PageSeeder::class,
            ServiceSeeder::class,
            EventSeeder::class,
            TestimonialSeeder::class,
            TeamMemberSeeder::class,
            LocationSeeder::class,
            GallerySeeder::class,
        ]);

        $this->command->info('All seeders completed successfully!');
    }
}

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
        // User first (admin access)
        // Settings next (no dependencies)
        $this->call([
            UserSeeder::class,
            SettingSeeder::class,
            ServiceSeeder::class,
            EventSeeder::class,
            TestimonialSeeder::class,
            TeamMemberSeeder::class,
            LocationSeeder::class,
            GallerySeeder::class,
            FaqSeeder::class,
            SocMedPlatformSeeder::class,
        ]);

        $this->command->info('All seeders completed successfully!');
    }
}

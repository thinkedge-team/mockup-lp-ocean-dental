<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default admin user
        User::create([
            'name' => 'Admin Ocean Dental',
            'email' => 'admin@oceandental.id',
            'password' => bcrypt('admin123'),
            'email_verified_at' => now(),
        ]);
    }
}

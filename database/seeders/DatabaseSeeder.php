<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Mahmuddin Nurul Fajri',
            'email' => 'mahmuddin@gmail.com',
            'role' => 'super_admin',
            'password' => bcrypt('secret')
        ]);

        User::factory()->create([
            'name' => 'Support',
            'email' => 'support@gmail.com',
            'role' => 'support',
            'password' => bcrypt('secret')
        ]);
    }
}

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
        // User::factory()->count(60)->create();

        User::factory()->create([
            'name' => 'admin',
            'username' => 'admin123',
            'email' => 'admin@example.com',
            'phone_number' => '12345678',
            'role_name' => 'admin',
        ]);
    }
}

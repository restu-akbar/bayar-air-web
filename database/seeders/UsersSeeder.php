<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'id' => Str::uuid(),
            'name' => 'Admin User2',
            'username' => 'admin2',
            'email' => 'admin2@example.com',
            'password' => Hash::make('password123'),
            'phone_number' => '081234567890',
            'role_name' => 'admin',
        ]);

        User::create([
            'id' => Str::uuid(),
            'name' => 'Petugas Lapangan',
            'username' => 'petugas1',
            'email' => 'petugas1@example.com',
            'password' => Hash::make('password123'),
            'phone_number' => '081298765432',
            'role_name' => 'petugas',
        ]);
    }
}

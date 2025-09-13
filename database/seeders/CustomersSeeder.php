<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class CustomersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([
            'id' => Str::uuid(),
            'name' => 'Budi Santoso',
            'address' => 'Jl. Merdeka No. 10',
            'phone_number' => '081111111111',
            'rt' => '01',
            'rw' => '02',
        ]);

        Customer::create([
            'id' => Str::uuid(),
            'name' => 'Siti Aminah',
            'address' => 'Jl. Melati No. 22',
            'phone_number' => '082222222222',
            'rt' => '03',
            'rw' => '04',
        ]);
    }
}

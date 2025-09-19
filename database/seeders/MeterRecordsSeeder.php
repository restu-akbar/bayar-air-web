<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MeterRecord;
use App\Models\Customer;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class MeterRecordsSeeder extends Seeder
{
    public function run()
    {
        $user = User::where('username', 'petugas1')->first();
        $customer1 = Customer::where('name', 'Budi Santoso')->first();
        $customer2 = Customer::where('name', 'Siti Aminah')->first();

        MeterRecord::create([
            'id' => Str::uuid(),
            'customer_id' => $customer1->id,
            'user_id' => $user->id,
            'meter' => 1234,
            'evidence' => 'meter1.jpg',
            'total_amount' => 150000,
            'fine' => 0,
            'duty_stamp' => 6000,
            'retribution_fee' => 2000,
            'status' => 'Belum bayar',
            'receipt' => 'file.pdf'
        ]);

        MeterRecord::create([
            'id' => Str::uuid(),
            'customer_id' => $customer2->id,
            'user_id' => $user->id,
            'meter' => 2345,
            'evidence' => 'meter2.jpg',
            'total_amount' => 200000,
            'fine' => 5000,
            'duty_stamp' => 6000,
            'retribution_fee' => 3000,
            'status' => 'Sudah bayar',
            'receipt' => 'file.pdf'
        ]);
    }
}

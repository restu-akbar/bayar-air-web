<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class CustomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = Str::uuid();
        DB::table('users')->insert([
            'id' => $userId,
            'name' => 'Admin99',
            'username' => 'admin99',
            'email' => 'admin99@example.com',
            'password' => Hash::make('password'),
            'phone_number' => '081234512890',
            'role_name' => 'petugas',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Banyak customers
        for ($i = 1; $i <= 24; $i++) {
            $customerId = Str::uuid();
            DB::table('customers')->insert([
                'id' => $customerId,
                'name' => "Seeder $i",
                'address' => "Jl. Seeder No.$i",
                'phone_number' => "08123" . str_pad($i, 8, "0", STR_PAD_LEFT),
                'rt' => str_pad(rand(1, 20), 3, "0", STR_PAD_LEFT),
                'rw' => str_pad(rand(1, 20), 3, "0", STR_PAD_LEFT),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Buat meter record untuk 12 bulan (1 per bulan)
            $meter = 1000;
            $addition = 0;
            for ($month = 1; $month <= 12; $month++) {
                $addition += rand(10, 20);
                DB::table('meter_records')->insert([
                    'id' => Str::uuid(),
                    'customer_id' => $customerId,
                    'user_id' => $userId,
                    'meter' => $meter += $addition, // naik tiap bulan
                    'usage' =>$addition,
                    'evidence' => "evidence_{$i}_{$month}.jpg",
                    'receipt' => "receipt_{$i}_{$month}.pdf",
                    'total_amount' => collect([10000, 15000, 21000])->random(),
                    'fine' => 0,
                    'duty_stamp' => 0,
                    'retribution_fee' => 0,
                    'status' => collect(['belum_bayar', 'sudah_bayar'])->random(),
                    'created_at' => Carbon::create(2025, $month, rand(1, 28)),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}

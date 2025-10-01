<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Customer;
use App\Models\MeterRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CustomerImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // skip kalau header tidak sesuai
        if (!isset($row['nama']) || !isset($row['no_hp'])) {
            return null; 
        }

        $periodeDate = now()->setDate($row['tahun'], $row['bulan'], 1)->endOfMonth()->startOfDay();
        
        // cari customer, kalau tidak ada buat baru
        $customer = Customer::firstOrCreate(
            [
                'phone_number' => $row['no_hp'],
            ],
            [
                'id' => Str::uuid(),
                'name' => $row['nama'],
                'address' => $row['alamat_lengkap'],
                'rt' => $row['rt'],
                'rw' => $row['rw'],
                'created_at' => $periodeDate,
                'updated_at' => $periodeDate,
            ]
        );

        // bikin meter record
        return new MeterRecord([
            'id' => Str::uuid(),
            'customer_id' => $customer->id,
            'user_id' => Auth::id(), // should be the authenticated user
            'meter' => $row['meteran'],
            'evidence' => 'first_import',
            'receipt' => 'first_import',
            'total_amount' => $row['tagihan'],
            'fine' => 0,
            'duty_stamp' => 0,
            'retribution_fee' => 0,
            'status' => 'sudah_bayar', // override default
            'usage' => 0,
            'created_at' => $periodeDate,
            'updated_at' => $periodeDate,
        ]);
    }
}

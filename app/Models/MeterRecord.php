<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MeterRecord extends Model
{
    use HasUuids;

    protected $fillable = [
        'customer_id',
        'user_id',
        'meter',
        'evidence',
        'receipt',
        'total_amount',
        'fine',
        'duty_stamp',
        'retribution_fee',
        'status',
    ];

    public function getReceiptAttribute($value)
    {
        if (!$value) return null;

        if (Str::startsWith($value, ['http://', 'https://'])) {
            return $value;
        }

        return asset('storage/' . $value);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}

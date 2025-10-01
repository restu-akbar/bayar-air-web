<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Str;

class MeterRecord extends Model
{
    use HasUuids;

    protected $fillable = [
        'customer_id',
        'user_id',
        'meter',
        'usage',
        'evidence',
        'receipt',
        'total_amount',
        'fine',
        'duty_stamp',
        'retribution_fee',
        'status',
        'created_at',// untuk add pertama ya butuh gini...
        'update_at'
    ];

    public function getReceiptAttribute($value)
    {
        if (!$value) return null;

        if (request()->is('api/*')) {
            if (Str::startsWith($value, ['http://', 'https://'])) {
                return $value;
            }
            Log::info("cek mobile".$value);
            return asset('storage/' . $value);
        }
        Log::info("cek url web ".$value);

        return $value;
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

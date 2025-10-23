<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
        'address',
        'branch_id',
        'phone_number',
        'rt',
        'rw',
        'created_at',// untuk add pertama ya butuh gini...
        'update_at'
    ];

    public function meterRecords()
    {
        return $this->hasMany(MeterRecord::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}

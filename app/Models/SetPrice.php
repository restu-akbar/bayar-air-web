<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class SetPrice extends Model
{
    use HasUuids;

    protected $fillable = [
        'price',
        'admin_fee',
    ];
}

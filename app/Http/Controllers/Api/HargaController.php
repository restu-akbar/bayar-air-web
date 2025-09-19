<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SetPrice;

class HargaController extends Controller
{
    public function index()
    {
        $harga = SetPrice::first();

        if ($harga) {
            return successResponse("Data harga layanan air", ["air" => (int) $harga->price, "admin" => (int) $harga->admin_fee]);
        }

        return errorResponse("Harga per kubik dan biaya admin belum dibuat, silakan hubungi admin");
    }
}

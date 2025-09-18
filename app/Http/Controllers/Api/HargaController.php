<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SetPrice;

class HargaController extends Controller
{
    public function index()
    {
        $harga = SetPrice::query()
            ->selectRaw('COALESCE(price,0) + COALESCE(admin_fee,0) AS total')
            ->value('total');

        if ($harga) {
            return successResponse("Data harga air per kubik!", ["harga" => (int) $harga]);
        }

        return errorResponse("Harga per kubik dan biaya admin belum dibuat, silakan hubungi admin");
    }
}

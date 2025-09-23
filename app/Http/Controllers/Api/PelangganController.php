<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Services\PelangganService;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    protected $service;
    public function __construct()
    {
        $this->service = new PelangganService;
    }
    public function index(Request $request)
    {
        $pelanggan = $this->service->index($request);
        if ($pelanggan) {
            return successResponse("Daftar Pelanggan", $pelanggan, 201);
        }
        return errorResponse("Belum ada daftar pelanggan", 404);
    }

    public function count(Request $request)
    {
        $q = Customer::query();
        return successResponse('Total pelanggan', [
            'total' => $q->count(),
        ]);
    }
}

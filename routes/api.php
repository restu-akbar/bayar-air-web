<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PelangganController;
use App\Http\Controllers\Api\PencatatanController;
use App\Http\Controllers\Api\HargaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/pencatatan', PencatatanController::class)->only(['index', 'store', 'update']);
    Route::get('/pelanggan', [PelangganController::class, 'index']);
    Route::get('/harga', [HargaController::class, 'index']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

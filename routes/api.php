<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PelangganController;
use App\Http\Controllers\Api\PencatatanController;
use App\Http\Controllers\Api\HargaController;
use App\Http\Controllers\Api\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/pencatatan', PencatatanController::class)->only(['index', 'store', 'update']);
    Route::apiResource('/profile', ProfileController::class)->only(['index', 'update']);
    Route::prefix('pelanggan')->group(function () {
        Route::get('', [PelangganController::class, 'index']);
        Route::get('hitung', [PelangganController::class, 'count']);
    });
    Route::get('/harga', [HargaController::class, 'index']);
    Route::prefix('statistik')->group(function () {
        Route::get('pie-chart', [PencatatanController::class, 'getPieChart']);
        Route::get('bar-chart', [PencatatanController::class, 'getBarChart']);
    });
    Route::post('/logout', [AuthController::class, 'logout']);
});

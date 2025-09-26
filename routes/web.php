<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Master\PelangganController;
use App\Http\Controllers\Module\LaporanController;
use App\Http\Controllers\Master\SettingController;
use App\Http\Controllers\Master\UserController;

use App\Http\Controllers\ProfileController;



use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth','admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['verified'])->name('dashboard');

    // module/*
    Route::prefix('module')->group(function () {
        Route::prefix('laporan')->group(function () {
            Route::resource('laporan', LaporanController::class)->only(['index', 'update']);
            Route::get('/laporan/{id}', [LaporanController::class, 'detail_popup'])->name('laporan.detail');
            Route::get('/index/data', [LaporanController::class, 'getData'])->name('laporan.data');
        });
    });

    // master/*
    Route::prefix('master')->name('master.')->group(function () {
        Route::resource('user', UserController::class);
        Route::resource('pelanggan', PelangganController::class);
        Route::resource('setting', SettingController::class)->only(['index', 'store']);
    });

    // Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

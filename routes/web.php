<?php

use App\Http\Controllers\DashboardController;


use App\Http\Controllers\Module\LaporanController;
use App\Http\Controllers\Master\PelangganController;
use App\Http\Controllers\Master\SettingController;
use App\Http\Controllers\Master\UserController;

use App\Http\Controllers\ProfileController;



use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['verified'])->name('dashboard');

    // module/*
    Route::prefix('module')->group(function () {
        Route::prefix('user')->group(function () {
            Route::get('/index', [LaporanController::class, 'index'])->name('module.laporan.index');
        });
    });

    // master/*
    Route::prefix('master')->group(function () {
        Route::prefix('user')->group(function () {
            Route::resource('user', UserController::class);

            //extra ini untuk data pada tabel yajra
            Route::get('/index/data', [UserController::class, 'getData'])->name('master.user.data');
        });

        // pelanggan
        Route::prefix('pelanggan')->group(function () {
            Route::resource('pelanggan', PelangganController::class);

            Route::get('/index/data', [PelangganController::class, 'getData'])->name('master.pelanggan.data');
        });

        // setting
        Route::prefix('setting')->group(function () {
            Route::resource('setting', SettingController::class);

            // Route::get('/index/data', [SettingController::class, 'getData'])->name('master.setting.data');
        });
    });

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

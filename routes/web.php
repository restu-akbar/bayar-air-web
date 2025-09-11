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
            Route::get('/index', [UserController::class, 'index'])->name('master.user.index');
            // Route::get('/create', [UserController::class, 'create'])->name('master.user.create');
            // Route::post('/store', [UserController::class, 'store'])->name('master.user.store');
            // Route::get('/edit/{id}', [UserController::class, 'edit'])->name('master.user.edit');
            // Route::patch('/update/{id}', [UserController::class, 'update'])->name('master.user.update');
            // Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('master.user.delete');
        });

        // pelanggan
        Route::prefix('pelanggan')->group(function () {
            Route::get('/index', [PelangganController::class, 'index'])->name('master.pelanggan.index');
            // Route::get('/create', [PelangganController::class, 'create'])->name('master.pelanggan.create');
            // Route::post('/store', [PelangganController::class, 'store'])->name('master.pelanggan.store');
            // Route::get('/edit/{id}', [PelangganController::class, 'edit'])->name('master.pelanggan.edit');
            // Route::patch('/update/{id}', [PelangganController::class, 'update'])->name('master.pelanggan.update');
            // Route::delete('/delete/{id}', [PelangganController::class, 'destroy'])->name('master.pelanggan.delete');
        });

        // setting
        Route::prefix('setting')->group(function () {
            Route::get('/index', [SettingController::class, 'index'])->name('master.setting.index');
            // Route::get('/create', [SettingController::class, 'create'])->name('master.setting.create');
            // Route::post('/store', [SettingController::class, 'store'])->name('master.setting.store');
            // Route::get('/edit/{id}', [SettingController::class, 'edit'])->name('master.setting.edit');
            // Route::patch('/update/{id}', [SettingController::class, 'update'])->name('master.setting.update');
            // Route::delete('/delete/{id}', [SettingController::class, 'destroy'])->name('master.setting.delete');
        });
    });

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Master\PelangganController;
use App\Http\Controllers\Module\LaporanController;
use App\Http\Controllers\Master\SettingController;
use App\Http\Controllers\Master\UserController;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landingpage');
});

Route::get('/landingpage', function () {
    // kalau sudah login ke dashboard, kalau belum ke login (atur logika sesuai kebutuhan)
    return redirect()->route('dashboard'); 
})->name('landingpage.login');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['verified'])->name('dashboard');

    // module/*
    Route::prefix('module')->group(function () {
        Route::resource('laporan', LaporanController::class)->only(['index', 'update','edit']);

        //update untuk web
        Route::put('laporan/{id}/laporan_update', [LaporanController::class, 'update_laporan'])->name('laporan.update_laporan');
        Route::get('/laporan/{id}', [LaporanController::class, 'detail_popup'])->name('laporan.detail');
    });

    // master/*
    Route::prefix('master')->name('master.')->group(function () {
        Route::resource('user', UserController::class);
        Route::resource('pelanggan', PelangganController::class);
        Route::post('pelanggan/import', [PelangganController::class, 'import'])->name('pelanggan.import.process');
        Route::get('pelanggan/import/template', function () {
            return response()->download(public_path('template/import_pelanggan.xlsx'));
        })->name('pelanggan.import.template');
        Route::resource('setting', SettingController::class)->only(['index', 'store']);
    });

    // Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

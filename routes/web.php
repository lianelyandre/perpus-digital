<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\LaporanController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('user', \App\Http\Controllers\UserController::class);

    Route::resource('buku', BukuController::class);

    Route::post('/pinjam-buku', [PeminjamanController::class, 'store'])->name('pinjam.store');
    Route::put('/pinjam-konfirmasi/{id}', [PeminjamanController::class, 'konfirmasi'])->name('pinjam.konfirmasi');
    Route::get('/data-peminjaman', [PeminjamanController::class, 'index'])->name('pinjam.index');

    Route::get('/ulasan-list', [UlasanController::class, 'index'])->name('ulasan.index');
    Route::post('/ulasan', [UlasanController::class, 'store'])->name('ulasan.store');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::post('/laporan/cetak', [LaporanController::class, 'generate'])->name('laporan.generate');

    Route::put('/pinjam/kembalikan/{id}', [PeminjamanController::class, 'kembalikan'])->name('pinjam.kembalikan');

    Route::put('/pinjam/acc/{id}', [App\Http\Controllers\PeminjamanController::class, 'accPinjaman'])->name('pinjam.acc');
});

require __DIR__ . '/auth.php';

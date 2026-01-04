<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangVariantController;
use App\Http\Controllers\DataKategoriController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// AUTH 
Route::get('/', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate'])->middleware('guest');
Route::get('/register', [AuthController::class, 'registerView'])->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

// DASHBOARD 
Route::middleware(['auth'])->group(function () {
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('role:2')->name('dashboard.user');
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->middleware('role:1')->name('dashboard.admin');
});

// MASTER DATA
Route::middleware(['auth', 'approved'])->group(function () {
Route::resource('kategori', DataKategoriController::class);
Route::resource('barang', BarangController::class);
Route::resource('variant', BarangVariantController::class);
});

// TRANSAKSI 
Route::middleware(['auth'])->group(function () {
Route::get('/transaksi-masuk', [TransaksiController::class, 'index'])->name('transaksi.masuk');
Route::get('/transaksi-masuk/create', [TransaksiController::class, 'create']);
Route::get('/transaksi-keluar', [TransaksiController::class, 'index'])->name('transaksi.keluar');
Route::get('/transaksi-keluar/create', [TransaksiController::class, 'create']);
Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
Route::get('/transaksi/{id}', [TransaksiController::class, 'show'])->name('transaksi.show');
Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');
});

// Profile
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
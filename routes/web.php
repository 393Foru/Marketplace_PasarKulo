<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MyProductController;
use App\Http\Controllers\ProfileController; // <--- Pastikan baris ini tetap ada

// === HALAMAN PUBLIK (Bisa diakses siapa saja) ===
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/produk/{id}', [PublicController::class, 'showProduct'])->name('product.detail');
Route::get('/toko/{slug}', [PublicController::class, 'showShop'])->name('shop.detail');

// === HALAMAN TAMU (Hanya untuk yang BELUM Login) ===
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// === HALAMAN MEMBER (Hanya untuk yang SUDAH Login) ===
Route::middleware('auth')->group(function () {
    
    // Dashboard Utama
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Buka Toko
    Route::get('/buka-toko', [DashboardController::class, 'createShop'])->name('shop.create');
    Route::post('/buka-toko', [DashboardController::class, 'storeShop'])->name('shop.store');

    // CRUD Produk
    Route::resource('dashboard/my-products', MyProductController::class);
    
    // === PENGATURAN AKUN (Baru Ditambahkan) ===
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
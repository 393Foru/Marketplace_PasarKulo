<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AuthController; // <--- PASTIKAN BARIS INI ADA
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MyProductController;

// Halaman Publik (Home, Produk, Toko)
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/produk/{id}', [PublicController::class, 'showProduct'])->name('product.detail');
Route::get('/toko/{slug}', [PublicController::class, 'showShop'])->name('shop.detail');

// Halaman Auth (Login/Register) - Baru ditambahkan
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    // CRUD Produk (Route Resource otomatis membuat jalur create, store, edit, update, destroy)
    Route::resource('dashboard/my-products', MyProductController::class);
    
    });

// ROUTE KHUSUS MEMBER (Harus Login)
Route::middleware('auth')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Buka Toko
    Route::get('/buka-toko', [DashboardController::class, 'createShop'])->name('shop.create');
    Route::post('/buka-toko', [DashboardController::class, 'storeShop'])->name('shop.store');
    
    // Nanti kita tambah route "Tambah Produk" disini...
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
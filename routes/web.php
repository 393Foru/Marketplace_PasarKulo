<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AuthController; // <--- PASTIKAN BARIS INI ADA
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MyProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;

// Halaman Publik (Home, Produk, Toko)
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/bantuan', [PublicController::class, 'help'])->name('help');
Route::get('/produk/{id}', [PublicController::class, 'showProduct'])->name('product.detail');
Route::get('/toko/{slug}', [PublicController::class, 'showShop'])->name('shop.detail');

// Halaman Auth (Login/Register) - Baru ditambahkan
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    });

// ROUTE KHUSUS MEMBER (Harus Login)
Route::middleware('auth')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Buka Toko
    Route::get('/buka-toko', [DashboardController::class, 'createShop'])->name('shop.create');
    Route::post('/buka-toko', [DashboardController::class, 'storeShop'])->name('shop.store');

    // CRUD Produk (Route Resource otomatis membuat jalur create, store, edit, update, destroy)
    Route::resource('dashboard/my-products', MyProductController::class);

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index'); // Halaman Keranjang
    Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add'); // Tambah Item
    Route::delete('/cart/remove/{id}', [CartController::class, 'destroy'])->name('cart.remove');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');

    Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    
    // Nanti kita tambah route "Tambah Produk" disini...
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
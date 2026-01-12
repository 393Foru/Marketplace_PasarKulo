<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    // Halaman Depan (Menampilkan semua produk terbaru)
    public function index()
    {
        $products = Product::with('shop')->latest()->get();
        return view('home', compact('products'));
    }

    // Halaman Detail Produk
    public function showProduct($id)
    {
        $product = Product::with('shop')->findOrFail($id);
        return view('product-detail', compact('product'));
    }

    // Halaman Detail Toko
    public function showShop($slug)
    {
        $shop = Shop::with('products')->where('slug', $slug)->firstOrFail();
        return view('shop-detail', compact('shop'));
    }
}

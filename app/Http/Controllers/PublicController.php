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
    public function showShop(Request $request, $slug)
    {
        $shop = Shop::where('slug', $slug)->firstOrFail();
        
        // Ambil parameter 'tab' dari URL, default-nya 'produk'
        $tab = $request->query('tab', 'produk'); 

        // Siapkan variabel kosong
        $products = collect(); 
        $reviews = collect();

        if ($tab == 'ulasan') {
            // Jika tab ulasan, ambil data review
            $reviews = $shop->reviews()->with(['user', 'product'])->latest()->paginate(10);
        } 
        elseif ($tab == 'terlaris') {
            // Jika tab terlaris, urutkan berdasarkan sold_count tertinggi
            $products = $shop->products()->orderBy('sold_count', 'desc')->paginate(12);
        } 
        else {
            // Default: Semua produk (urut terbaru)
            $products = $shop->products()->latest()->paginate(12);
        }

        return view('shop-detail', compact('shop', 'products', 'reviews', 'tab'));
    }
}

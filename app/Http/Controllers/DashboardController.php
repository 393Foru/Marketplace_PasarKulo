<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str; // Untuk membuat slug otomatis
use App\Models\Shop;

class DashboardController extends Controller
{
    // Halaman Utama Dashboard
    public function index()
    {
        // Ambil data toko milik user yang sedang login
        $shop = Auth::user()->shop; 
        
        return view('dashboard.index', compact('shop'));
    }

    // Halaman Form Buka Toko
    public function createShop()
    {
        // Jika sudah punya toko, jangan kasih akses kesini lagi, tendang ke dashboard
        if (Auth::user()->shop) {
            return redirect()->route('dashboard');
        }

        return view('dashboard.create-shop');
    }

    // Proses Simpan Toko Baru
    public function storeShop(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:shops,name',
            'phone' => 'required|numeric',
            'address' => 'required|string',
            'description' => 'required|string',
        ]);

        Shop::create([
            'user_id' => Auth::id(), // ID user yang sedang login
            'name' => $request->name,
            'slug' => Str::slug($request->name), // "Toko Budi" -> "toko-budi"
            'phone' => $request->phone,
            'address' => $request->address,
            'description' => $request->description,
        ]);

        return redirect()->route('dashboard')->with('success', 'Selamat! Toko berhasil dibuat.');
    }
}
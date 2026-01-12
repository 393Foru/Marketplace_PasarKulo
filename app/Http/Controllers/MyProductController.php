<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;

class MyProductController extends Controller
{
    // 1. Tampilkan Daftar Produk Saya
    public function index()
    {
        $products = Auth::user()->shop->products()->latest()->get();
        return view('dashboard.products.index', compact('products'));
    }

    // 2. Form Tambah Produk
    public function create()
    {
        return view('dashboard.products.create');
    }

    // 3. Proses Simpan Produk (Upload Gambar)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            // Simpan gambar ke folder 'storage/app/public/products'
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'shop_id' => Auth::user()->shop->id, // Ambil ID toko user yg login
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . Str::random(5), // Slug unik
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('my-products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    // 4. Form Edit Produk
    public function edit($id)
    {
        $product = Product::where('id', $id)->where('shop_id', Auth::user()->shop->id)->firstOrFail();
        return view('dashboard.products.edit', compact('product'));
    }

    // 5. Proses Update Produk
    public function update(Request $request, $id)
    {
        $product = Product::where('id', $id)->where('shop_id', Auth::user()->shop->id)->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ];

        // Cek jika ada gambar baru yang diupload
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            // Upload gambar baru
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('my-products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    // 6. Hapus Produk
    public function destroy($id)
    {
        $product = Product::where('id', $id)->where('shop_id', Auth::user()->shop->id)->firstOrFail();
        
        // Hapus gambar dari penyimpanan
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('my-products.index')->with('success', 'Produk dihapus.');
    }
}
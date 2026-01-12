<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // 1. Menampilkan isi keranjang (Saat icon diklik)
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        
        // Hitung total harga
        $total = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        return view('cart.index', compact('cartItems', 'total'));
    }

    // 2. Menambah barang ke keranjang
    public function addToCart(Request $request, $productId)
    {
        $userId = Auth::id();

        // Cek apakah barang sudah ada di keranjang user tsb
        $cartItem = Cart::where('user_id', $userId)
                        ->where('product_id', $productId)
                        ->first();

        if($cartItem) {
            // Jika ada, tambah quantity
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            // Jika belum ada, buat baru
            Cart::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => 1
            ]);
        }

        return redirect()->back()->with('success', 'Produk masuk keranjang!');
    }

    // 3. Hapus item (Opsional)
    public function destroy($id)
    {
        Cart::destroy($id);
        return redirect()->back()->with('success', 'Item dihapus!');
    }

    public function update(Request $request, $id)
{
    // Cari item keranjang milik user
    $cart = Cart::where('id', $id)->where('user_id', Auth::id())->first();

    if(!$cart) {
        return redirect()->back()->with('error', 'Item tidak ditemukan!');
    }

    // Cek tombol mana yang ditekan berdasarkan value dari input 'type'
    if ($request->type == 'increase') {
        // Tambah quantity
        $cart->quantity += 1;
    } elseif ($request->type == 'decrease') {
        // Kurangi quantity, TAPI jangan sampai kurang dari 1
        if ($cart->quantity > 1) {
            $cart->quantity -= 1;
        }
    }

    $cart->save();
    return redirect()->back()->with('success', 'Keranjang diperbarui!');
}
}

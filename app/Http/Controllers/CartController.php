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
}

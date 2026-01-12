<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;

class CheckoutController extends Controller
{
    // 1. Tampilkan Halaman Form Checkout
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();
        
        // Jika keranjang kosong, tendang balik
        if($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang masih kosong!');
        }

        // Hitung total bayar
        $total = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        return view('checkout.index', compact('cartItems', 'total'));
    }

    // 2. Proses Simpan Order (Pindahkan dari Cart ke Order)
    public function process(Request $request)
    {
        // Validasi input
        $request->validate([
            'receiver_name' => 'required',
            'receiver_phone' => 'required',
            'receiver_address' => 'required',
        ]);

        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->get();

        // Hitung total lagi untuk keamanan
        $total = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        // A. Simpan data ke tabel Orders
        $order = Order::create([
            'user_id' => $user->id,
            'receiver_name' => $request->receiver_name,
            'receiver_phone' => $request->receiver_phone,
            'receiver_address' => $request->receiver_address,
            'total_price' => $total,
            'status' => 'pending', // Awalnya pending
        ]);

        // B. Pindahkan item Cart ke OrderDetail
        foreach ($cartItems as $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price, // Simpan harga saat ini
            ]);
        }

        // C. Kosongkan Keranjang
        Cart::where('user_id', $user->id)->delete();

        return redirect()->route('home')->with('success', 'Checkout berhasil! Pesanan sedang diproses.');
    }
}

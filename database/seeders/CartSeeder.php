<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;

class CartSeeder extends Seeder
{
    public function run()
    {
        // Pastikan ada user dan produk dulu untuk mencegah error
        $user = User::first(); // Mengambil user pertama
        $products = Product::take(3)->get(); // Mengambil 3 produk pertama

        if ($user && $products->count() >= 3) {
            $data = [
                [
                    'user_id' => $user->id,
                    'product_id' => $products[0]->id,
                    'quantity' => 2,
                ],
                [
                    'user_id' => $user->id,
                    'product_id' => $products[1]->id,
                    'quantity' => 1,
                ],
                [
                    'user_id' => $user->id,
                    'product_id' => $products[2]->id,
                    'quantity' => 5,
                ],
            ];

            foreach ($data as $item) {
                Cart::create($item);
            }
        } else {
            $this->command->info('Gagal seeding Cart: Pastikan tabel users dan products sudah ada datanya.');
        }
    }
}
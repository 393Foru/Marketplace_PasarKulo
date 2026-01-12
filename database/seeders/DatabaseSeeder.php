<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Shop;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. Buat User Pemilik Toko
        $user = User::create([
            'name' => 'Tama',
            'email' => 'tama@pasarkulo.com',
            'password' => bcrypt('rahasia123'),
        ]);

        // 2. Buat Toko
        $shop = Shop::create([
            'user_id' => $user->id,
            'name' => 'Toko Sembako Murah',
            'slug' => 'toko-sembako-murah',
            'description' => 'Menyediakan sembako lengkap harga mahasiswa.',
            'phone' => '62812345678', // Format 62 untuk WA
            'address' => 'Jl. Ringroad Utara, Jogja'
        ]);

        // 3. Buat Beberapa Produk
        Product::create([
            'shop_id' => $shop->id,
            'name' => 'Beras Rojo Lele 5kg',
            'slug' => 'beras-rojo-lele-5kg',
            'description' => 'Beras pulen enak wangi pandan.',
            'price' => 65000,
        ]);

        Product::create([
            'shop_id' => $shop->id,
            'name' => 'Minyak Goreng 2L',
            'slug' => 'minyak-goreng-2l',
            'description' => 'Minyak goreng jernih non kolesterol.',
            'price' => 38000,
        ]);
        
        Product::create([
            'shop_id' => $shop->id,
            'name' => 'Telur Ayam 1kg',
            'slug' => 'telur-ayam-1kg',
            'description' => 'Telur ayam negeri segar dari peternakan.',
            'price' => 28000,
        ]);

        // 1. Beras
        Product::create([
            'shop_id' => $shop->id,
            'name' => 'Beras Premium 5kg',
            'slug' => 'beras-premium-5kg',
            'description' => 'Beras putih pulen kualitas premium tanpa pemutih.',
            'price' => 65000,
        ]);

        // 2. Minyak Goreng
        Product::create([
            'shop_id' => $shop->id,
            'name' => 'Minyak Goreng 2 Liter',
            'slug' => 'minyak-goreng-2-liter',
            'description' => 'Minyak goreng kelapa sawit jernih, non-kolesterol.',
            'price' => 34000,
        ]);

        // 3. Gula Pasir
        Product::create([
            'shop_id' => $shop->id,
            'name' => 'Gula Pasir Putih 1kg',
            'slug' => 'gula-pasir-putih-1kg',
            'description' => 'Gula tebu murni, manis alami dan bersih.',
            'price' => 16000,
        ]);

        // 4. Tepung Terigu
        Product::create([
            'shop_id' => $shop->id,
            'name' => 'Tepung Terigu Serbaguna 1kg',
            'slug' => 'tepung-terigu-serbaguna-1kg',
            'description' => 'Tepung terigu protein sedang, cocok untuk aneka kue dan gorengan.',
            'price' => 12000,
        ]);

        // 5. Telur Bebek (Variasi dari contohmu)
        Product::create([
            'shop_id' => $shop->id,
            'name' => 'Telur Bebek Asin (6 Butir)',
            'slug' => 'telur-bebek-asin-6-butir',
            'description' => 'Telur bebek asin masir, siap santap, gurih dan bergizi.',
            'price' => 25000,
        ]);

        // 6. Kecap Manis
        Product::create([
            'shop_id' => $shop->id,
            'name' => 'Kecap Manis Refill 500ml',
            'slug' => 'kecap-manis-refill-500ml',
            'description' => 'Kecap manis kental terbuat dari kedelai hitam pilihan.',
            'price' => 21000,
        ]);

        // 7. Mie Instan
        Product::create([
            'shop_id' => $shop->id,
            'name' => 'Mie Instan Goreng (1 Dus)',
            'slug' => 'mie-instan-goreng-1-dus',
            'description' => 'Satu dus mie instan goreng favorit keluarga (isi 40 bungkus).',
            'price' => 115000,
        ]);

        // 8. Kopi Bubuk
        Product::create([
            'shop_id' => $shop->id,
            'name' => 'Kopi Bubuk Hitam 150g',
            'slug' => 'kopi-bubuk-hitam-150g',
            'description' => 'Kopi robusta murni dengan aroma yang kuat dan nikmat.',
            'price' => 14000,
        ]);

        // 9. Susu UHT
        Product::create([
            'shop_id' => $shop->id,
            'name' => 'Susu UHT Full Cream 1 Liter',
            'slug' => 'susu-uht-full-cream-1-liter',
            'description' => 'Susu sapi segar diproses UHT, sumber kalsium dan vitamin.',
            'price' => 19000,
        ]);

        // 10. Garam Dapur
        Product::create([
            'shop_id' => $shop->id,
            'name' => 'Garam Dapur Beriodium 500g',
            'slug' => 'garam-dapur-beriodium-500g',
            'description' => 'Garam masak halus beryodium untuk penyedap rasa.',
            'price' => 5000,
        ]);
    }
}
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // 1. Tambah kolom 'sold_count' di tabel products
        Schema::table('products', function (Blueprint $table) {
            $table->integer('sold_count')->default(0)->after('price'); // Jumlah terjual
        });

        // 2. Buat tabel reviews
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Pembeli
            $table->foreignId('product_id')->constrained()->cascadeOnDelete(); // Produk yg diulas
            $table->integer('rating'); // 1 sampai 5
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reviews');
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('sold_count');
        });
    }
};

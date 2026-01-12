<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained();
        $table->string('receiver_name'); // Nama penerima
        $table->text('receiver_address'); // Alamat pengiriman
        $table->string('receiver_phone'); // No HP
        $table->decimal('total_price', 15, 2); // Total belanja
        $table->string('status')->default('pending'); // Status: pending, paid, shipped
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

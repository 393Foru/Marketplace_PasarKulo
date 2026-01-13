<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    protected $fillable = [
    'shop_id', 'name', 'slug', 'description', 'price', 
    'image', 'sold_count' // <-- Tambahkan ini
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Tambahkan baris sakti ini bolo!
    protected $fillable = ['name'];

    // Relasi ke produk (pastikan ini juga ada)
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

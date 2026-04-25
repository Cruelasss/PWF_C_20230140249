<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi secara massal.
     * Sesuaikan dengan kolom di migrasi kamu!
     */
  protected $fillable = [
    'name',
    'qty',    // Pastikan ini 'qty' sesuai screenshot DB
    'price',
    'user_id',
    'category_id'
];
    // Jika kamu punya relasi ke User, biasanya ada di bawah sini
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category() {
    return $this->belongsTo(Category::class);
}
}
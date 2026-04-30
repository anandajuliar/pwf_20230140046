<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $fillable = ['name'];

    // Relasi: Satu Kategori punya Banyak Produk
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

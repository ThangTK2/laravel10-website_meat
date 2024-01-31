<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'status', 'price', 'sale_price', 'image', 'category_id', 'description'
    ];

    // 1-1
    public function cat(){
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    // 1-n
    public function images(){
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }
}

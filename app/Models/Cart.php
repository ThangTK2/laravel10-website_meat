<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id', 'product_id', 'price', 'quantity'
    ];

    // hasOne: mqh 1-1
    public function prod() {
        return $this->hasOne(Product::class, 'id', 'product_id'); //$this là model Cart
    }
}

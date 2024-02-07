<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'status'
    ];

    // hasMany: mqh 1-n
    public function products(){
        return $this->hasMany(Product::class, 'category_id', 'id')->orderBy('created_at', 'desc'); //'id' của Category
    }

}

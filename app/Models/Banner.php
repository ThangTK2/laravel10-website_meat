<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'status', 'link', 'image', 'description', 'priorty', 'position'
    ];

    // 1-n
    public function products(){
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}

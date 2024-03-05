<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $appends = ['favorited']; // chỉ định các trường mà mô hình sẽ "append" (nối thêm) vào data. Trong trường hợp này, 'favorited' là 1 trường ảo được tạo ra bằng cách sử dụng các phương thức getFavoritedAttribute().

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

    //hàm này là thêm thuộc tính ảo vào data (TênThuộcTính + Attribute) mà không cần thay đổi cấu trúc cơ bản của mô hình đó.
    //Phương thức getFavoritedAttribute(): Đây là một phương thức truy cập động (accessor) được sử dụng để tạo một thuộc tính ảo có tên là 'favorited'. Thực hiện một truy vấn để kiểm tra xem sản phẩm có id($this->id) đã được khách hàng có id (auth('cus')->id()) đăng nhập yêu thích hay chưa.
    public function getFavoritedAttribute(){
        $favorited = Favorite::where(['product_id'=> $this->id, 'customer_id'=> auth('cus')->id()])->first();
        return $favorited ? true : false;
    }
}

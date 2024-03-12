<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Favorite;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $topBanner = Banner::where('position', 'top-banner')->where('status', 1)->orderBy('prioty', 'asc')->first();
        $galleries = Banner::where('position', 'gallery')->where('status', 1)->orderBy('prioty', 'asc')->get();

        // show product
        $new_products = Product::orderBy('created_at', 'desc')->limit(2)->get();
        $sale_products = Product::orderBy('created_at', 'desc')->where('sale_price', '>', 0)->limit(3)->get(); // ('sale_price', '>', 0): có khuyến mãi
        $feature_products = Product::inRandomOrder()->limit(4)->get();

        return view('home.index', compact('topBanner', 'galleries', 'new_products', 'sale_products', 'feature_products'));
    }

    public function about() {
        return view('home.about');
    }

    public function category(Category $cat) {  //$cat: là tham số route trên đường dẫn bên web.php(line 23)
        $products = $cat->products()->paginate(9);
        $new_products = Product::orderBy('created_at', 'desc')->limit(3)->get();
        return view('home.category', compact('cat', 'products', 'new_products'));
    }

    public function product(Product $product) {  //$product: là tham số route trên đường dẫn bên web.php(line 24)
        $products = Product::where('category_id', $product->category_id)->limit(12)->get(); //sản phẩm liên quan(related)
        $feature_products = Product::inRandomOrder()->limit(4)->get();
        return view('home.product', compact('product', 'products', 'feature_products'));
    }

    public function favorite($product_id) {   //$product_id: là tham số route trên đường dẫn bên web.php(line 25) ta đặt tên lại product_id
        $data = [
            'product_id' => $product_id,
            'customer_id' => auth('cus')->id(),
        ];
        $favorited = Favorite::where(['product_id'=> $product_id, 'customer_id'=> auth('cus')->id()])->first();
        if ($favorited) {
            $favorited->delete();
            return redirect()->back()->with('success', 'Bạn đã không thích sản phẩm thành công');
        }else{
            Favorite::create($data);
            return redirect()->back()->with('success', 'Bạn đã thích sản phẩm thành công');
        }
    }
}

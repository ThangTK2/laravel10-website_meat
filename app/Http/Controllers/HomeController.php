<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $topBanner = Banner::where('position', 'top-banner')->where('status', 1)->orderBy('prioty', 'asc')->first();
        $galleries = Banner::where('position', 'gallery')->where('status', 1)->orderBy('prioty', 'asc')->get();
        $new_products = Product::orderBy('created_at', 'desc')->limit(2)->get();
        $sale_products = Product::orderBy('created_at', 'desc')->where('sale_price', '>', 0)->limit(3)->get();
        $feature_products = Product::inRandomOrder()->limit(4)->get();
        return view('home.index', compact('topBanner', 'galleries', 'new_products', 'sale_products', 'feature_products'));
    }

    public function about() {
        return view('home.about');
    }
}

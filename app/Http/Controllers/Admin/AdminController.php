<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminLoginRequest;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        $totalCategories = Category::count();
        $totalProducts = Product::count();
        $totalOrders = Order::where('status', 2)->count();

        return view('admin.index', compact('totalProducts', 'totalCategories', 'totalOrders'));
    }

    public function login(){
        // create sample data
        // User::create([
        //     'name' => 'Admin Bemet',
        //     'email' => 'admin@gmail.com',
        //     'password' => bcrypt(123456)
        // ]);
        return view('admin.login');
    }

    public function check_login(AdminLoginRequest $request){
        $data = $request->only('email', 'password');
        $check = auth()->attempt($data);  //attempt($data): xem thông tin đăng nhập có đúng với db không.
        if ($check) {
            return redirect()->route('admin.index')->with('success', 'Chào mừng bạn đến với trang admin');
        }
        return redirect()->back()->with('error', 'Email hoặc mật khẩu không chính xác, vui lòng thử lại');
    }

    public function logout(){
        auth()->logout();
        return redirect()->route('admin.login')->with('success', 'Bạn đã đăng xuất thành công');
    }
}

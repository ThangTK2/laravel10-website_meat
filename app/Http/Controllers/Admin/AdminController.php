<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('admin.index');
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
            return redirect()->route('admin.index')->with('success', 'Welcome to admin page');
        }
        return redirect()->back()->with('error', 'Incorrect email or password please try again');
    }

    public function logout(){
        auth()->logout();
        return redirect()->route('admin.login')->with('success', 'You logged in successfully');
    }
}

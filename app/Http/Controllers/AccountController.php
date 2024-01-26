<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Mail\ForgotPassword;
use App\Mail\VerifyAccount;
use App\Models\Customer;
use App\Models\CustomerResetToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AccountController extends Controller
{
    public function login(){
        return view('account.login');
    }

    public function check_login(LoginRequest $request){
        $data = $request->only('email', 'password');
        $check = auth('cus')->attempt($data);  //auth('cus') bên config.auth //attempt($data): xem thông tin đăng nhập có đúng không.
        if ($check) {
            if (auth('cus')->user()->email_verified_at == null) {  //auth()->user(): để lấy thông tin về người dùng hiện tại đang đăng nhập
                auth('cus')->logout();
                return redirect()->back()->with('error', 'You can verified your email to login');
            }
            return redirect()->route('home.index')->with('success', 'Welcome to our website');
        }
        return redirect()->back()->with('error', 'Incorrect email or password please try again');
    }

    public function logout(){
        auth('cus')->logout();
        return redirect()->route('account.login')->with('success', 'You logged in successfully');
    }

    public function register(){
        return view('account.register');
    }

    public function check_register(RegisterRequest $request){
        $data = $request->only('name', 'email', 'phone', 'address', 'gender');
        $data['password'] = bcrypt($request->password);

        if($acc = Customer::create($data)){
            Mail::to($acc->email)->send(new VerifyAccount($acc));
            return redirect()->route('account.login')->with('success', 'Register successfully, You can verified your email to login');
        }
        return redirect()->back()->with('error', 'Register failed!!!');
    }

    public function verify($email){
        $acc = Customer::where('email', $email)->whereNULL('email_verified_at')->firstOrFail(); //firstOrFail: khi ta nhấn verify email lần đầu thì sẽ được, lần thứ 2 trở đi sẽ không được(lỗi 404)(để tránh tình trạng spam email khi đã verify rồi)
        Customer::where('email', $email)->update(['email_verified_at' => date('Y-m-d')]);
        return redirect()->route('account.login')->with('success', 'Verify email successfully');
    }

    public function change_password(){
        return view('account.change_password');
    }

    public function check_change_password(ChangePasswordRequest $request){
        $auth = auth('cus')->user();
        $data['password'] = bcrypt($request->password);
        $check = $auth->update($data);
        if ($check){
            auth('cus')->logout();
            return redirect()->back()->with('success', 'Change password successfully');
        }
        return redirect()->back()->with('error', 'Change password failed');
    }

    public function forgot_password(){
        return view('account.forgot_password');
    }

    public function check_forgot_password(ForgotPasswordRequest $request){
        $customer = Customer::where('email', $request->email)->first();
        // echo $customer;die();
        $token = Str::random(40);
        $tokenData = [
            "email" => $request->email,
            "token" => $token
        ];
        if(CustomerResetToken::create($tokenData)){
            Mail::to($request->email)->send(new ForgotPassword($customer, $token));
            return redirect()->back()->with('success', 'Send email successfully, please check your email to reset your password');
        }
        return redirect()->back()->with('error', 'Send email failed');
    }

    public function profile(){
        $auth = auth('cus')->user();
        return view('account.profile', compact('auth'));
    }

    public function check_profile(ProfileRequest $request){
        $auth = auth('cus')->user();
        $data = $request->only('name', 'email', 'phone', 'address', 'gender');
        $check = $auth->update($data);
        if ($check){
            return redirect()->back()->with('success', 'Update profile successfully');
        }
        return redirect()->back()->with('error', 'Update profile failed');
    }

    public function reset_password($token){
        $tokenData = CustomerResetToken::where('token', $token)->firstOrFail();
        $customer = $tokenData->customer;
        return view('account.reset_password');
    }

    public function check_reset_password(ResetPasswordRequest $request, $token){
        $tokenData = CustomerResetToken::where('token', $token)->firstOrFail();
        $customer = $tokenData->customer;

        $data = [
            'password' => bcrypt(request(('password')))
        ];

        $check = $customer->update($data);
        if ($check){
            return redirect()->route('account.login')->with('success', 'Reset password successfully');
        }
        return redirect()->back()->with('error', 'Reset password failed');
    }
}

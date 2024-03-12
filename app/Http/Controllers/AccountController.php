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
use App\Models\Favorite;
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
                return redirect()->back()->with('error', 'Bạn cần xác minh email của mình để đăng nhập');
            }
            return redirect()->route('home.index')->with('success', 'Chào mừng bạn đến với trang web của chúng tôi');
        }
        return redirect()->back()->with('error', 'Email hoặc mật khẩu không chính xác. Vui lòng thử lại');
    }

    public function logout(){
        auth('cus')->logout();
        return redirect()->route('account.login')->with('success', 'Bạn đã đăng xuất thành công');
    }

    public function register(){
        return view('account.register');
    }

    public function check_register(RegisterRequest $request){
        $data = $request->only('name', 'email', 'phone', 'address', 'gender');
        $data['password'] = bcrypt($request->password);

        if($acc = Customer::create($data)){
            Mail::to($acc->email)->send(new VerifyAccount($acc));
            return redirect()->route('account.login')->with('success', 'Đăng ký thành công. Bạn cần xác minh email của mình để đăng nhập');
        }
        return redirect()->back()->with('error', 'Đăng ký không thành công');
    }

    public function verify($email){
        $acc = Customer::where('email', $email)->whereNULL('email_verified_at')->firstOrFail(); //firstOrFail: khi ta nhấn verify email lần đầu thì sẽ được, lần thứ 2 trở đi sẽ không được(lỗi 404)(để tránh tình trạng spam email khi đã verify rồi)
        Customer::where('email', $email)->update(['email_verified_at' => date('Y-m-d')]);
        return redirect()->route('account.login')->with('success', 'Xác minh email thành công');
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
            return redirect()->back()->with('success', 'Thay đổi mật khẩu thành công');
        }
        return redirect()->back()->with('error', 'Thay đổi mật khẩu không thành công');
    }

    public function forgot_password(){
        return view('account.forgot_password');
    }

    public function check_forgot_password(ForgotPasswordRequest $request){
        $customer = Customer::where('email', $request->email)->first(); //$request->email: cái mình nhập trong ô input
        $token = Str::random(40);
        $tokenData = [
            "email" => $request->email,
            "token" => $token
        ];
        if(CustomerResetToken::create($tokenData)){
            Mail::to($request->email)->send(new ForgotPassword($customer, $token));
            return redirect()->route('account.login')->with('success', 'Gửi email thành công, vui lòng kiểm tra email của bạn để đặt lại mật khẩu');
        }
        return redirect()->back()->with('error', 'Gửi email không thành công');
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
            return redirect()->back()->with('success', 'Cập nhật hồ sơ thành công');
        }
        return redirect()->back()->with('error', 'Cập nhật hồ sơ không thành công');
    }

    public function reset_password($token){
        $tokenData = CustomerResetToken::where('token', $token)->firstOrFail();
        $customer = Customer::where('email', $tokenData->email)->firstOrFail();
        return view('account.reset_password');
    }

    public function check_reset_password(ResetPasswordRequest $request, $token){
        $tokenData = CustomerResetToken::where('token', $token)->firstOrFail();
        $customer = Customer::where('email', $tokenData->email)->firstOrFail();
        $data = [
            'password' => bcrypt(request(('password')))
        ];
        $check = $customer->update($data);
        if ($check){
            return redirect()->route('account.login')->with('success', 'Đặt lại mật khẩu thành công');
        }
        return redirect()->back()->with('error', 'Đặt lại mật khẩu không thành công');
    }

    public function favorite() {
        $favorites = Favorite::where('customer_id', auth('cus')->user()->id)->get(); //người click yêu thích giống với người dùng đang đăng nhập hiện tại
        return view('account.favorite', compact('favorites'));
    }

}

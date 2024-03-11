<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Mail\OrderEmail;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use Mail;

class CheckoutController extends Controller
{
    public function checkout(){
        $auth = auth('cus')->user();
        return view('home.checkout', compact('auth'));
    }

    public function post_checkout(CheckoutRequest $request){
        $auth = auth('cus')->user();
        $data = $request->only('name', 'email', 'phone', 'address');
        $data['customer_id'] = $auth->id;
        if($order = Order::create($data)){
            $token = \Str::random(30);

            foreach($auth->carts as $cart){   //carts: bên Customer.js
                $data1[] = [
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'price' => $cart->price,
                    'quantity' => $cart->quantity,
                ];
            }
            OrderDetail::insert($data1);

            // Xoá giỏ hàng sau khi tạo đơn hàng thành công
            $auth->carts()->delete();

            $order->token = $token;
            $order->save();
            Mail::to($auth->email)->send(new OrderEmail($order, $token));
            return redirect()->route('home.index')->with('success', 'Order checkout successfully. Please check your email to verify your order.');
        }
        return redirect()->route('home.index')->with('error', 'Order checkout unsuccessfully');
    }

    public function verify($token){ //$token wec.php(line 69)
        $order = Order::where('token', $token)->first();
        if($order){
            $order->token = null;
            $order->status = 1;
            $order->save();
            return redirect()->route('home.index')->with('success', 'Order verify successfully. You have successfully placed your order <3');
        }

        return abort(404);
    }

    public function history(){
        $auth = auth('cus')->user();
        return view('home.history', compact('auth'));
    }

    public function detail(Order $order){
        $auth = auth('cus')->user();
        return view('home.order_detail', compact('auth', 'order'));
    }
}

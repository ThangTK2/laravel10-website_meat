<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Mail\OrderEmail;
use App\Models\Momo;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\PaymentMomo;
use Mail;

class CheckoutController extends Controller
{
    public function checkout(){
        if(isset($_GET['partnerCode'])){
            $data_momo =[
                'partnerCode' => $_GET['partnerCode'],
                'orderId' => $_GET['orderId'],
                'requestId' => $_GET['requestId'],
                'amount' => $_GET['amount'],
                'orderInfo' => $_GET['orderInfo'],
                'orderType' => $_GET['orderType'],
                'transId' => $_GET['transId'],
                'payType' => $_GET['payType'],
                'signature' => $_GET['signature'],
            ] ;
            Momo::insert($data_momo);
        }

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
            return redirect()->route('home.index')->with('success', 'Đặt hàng thành công. Vui lòng kiểm tra email của bạn để xác minh đơn đặt hàng của bạn.');
        }
        return redirect()->route('home.index')->with('error', 'Đặt hàng không thành công');
    }

    public function verify($token){ //$token wec.php(line 69)
        $order = Order::where('token', $token)->first();
        if($order){
            $order->token = null;
            $order->status = 1;
            $order->save();
            return redirect()->route('home.index')->with('success', 'Xác minh đơn hàng thành công. Bạn đã đặt hàng thành công <3');
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

    //momo
    public function execPostRequest($url, $data)
{
    // Khởi tạo một yêu cầu CURL mới
    $ch = curl_init($url);

    // Cài đặt các tùy chọn yêu cầu
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data))
    );
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

    // Thực hiện yêu cầu POST
    $result = curl_exec($ch);

    // Đóng kết nối CURL
    curl_close($ch);

    return $result;
}

    public function momo_payment(Request $request)
    {
        // Lấy tổng số tiền từ dữ liệu yêu cầu
        $totalMomo = $request->input('total_momo');

        // Kiểm tra xem tổng số tiền có nằm trong khoảng cho phép không
        if ($totalMomo < 10000 || $totalMomo > 50000000) {
            return redirect()->back()->with('error', 'Số tiền giao dịch không hợp lệ.');
        }

        // Thiết lập URL điểm cuối
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

        // Các thông tin xác thực MoMo
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

        // Các thông tin đơn hàng
        $orderInfo = "Thanh toán qua ATM MoMo";
        $amount = $totalMomo;
        $orderId = time() ."";
        $redirectUrl = "http://localhost:8000/order/checkout";
        $ipnUrl = "http://localhost:8000/order/checkout";
        $extraData = "";

        // Tạo requestId và requestType
        $requestId = time() . "";
        $requestType = "payWithATM";

        // Tính toán chữ ký HMAC SHA256
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        // Tạo mảng dữ liệu để gửi
        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );

        // Gửi yêu cầu POST và nhận kết quả
        $result = $this->execPostRequest($endpoint, json_encode($data));

        // Giải mã kết quả từ JSON
        $jsonResult = json_decode($result, true);

        $auth = auth('cus')->user();

        if (isset($jsonResult['payUrl'])) {
            // Tạo đơn hàng mới và cập nhật trạng thái của đơn hàng thành "đã giao hàng"
            $order = new Order();
            $order->name = $auth->name;
            $order->email = $auth->email;
            $order->phone = $auth->phone;
            $order->address = $auth->address;
            $order->customer_id = $auth->id; // Gán ID của khách hàng đăng nhập
            $order->status = 2; // Trạng thái đã giao hàng
            $order->save();

            $auth->carts()->delete();

            // Chuyển hướng người dùng đến trang thanh toán MoMo
            return redirect()->to($jsonResult['payUrl'])->with('success', 'Mua hàng thành công!');
        } else {
            return redirect()->back()->with('error', 'Không thể tạo đơn hàng vì số tiền quá thấp, vui lòng thử lại sau.');
        }


    }

}

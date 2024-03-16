<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use PDF;
class OrderController extends Controller
{
    public function index()
    {
        $status = request('status', 1);
        $orders = Order::orderBy('id', 'desc')->where('status', $status)->paginate();
        return view('admin.order.index', compact('orders'));
    }

    public function show(Order $order){
        $auth = $order->customer;  //customer -> Order.php
        return view('admin.order.order_detail', compact('auth', 'order'));  //order được sử dụng ở đây là biến $order
    }

    public function update(Order $order){
        $status = request('status', 1);
        if($order->status != 2){
            $order->update(['status' => $status]);
            return redirect()->route('order.index')->with('success', 'Cập nhật trạng thái thành công');
        }
        return redirect()->route('order.index')->with('error', 'Không thể cập nhật. Đơn hàng đã được giao');
    }

    public function print_order($id)
    {
        $order = Order::findOrFail($id);
        $total = 0;
        foreach ($order->details as $item) {   //details -> Order.php
            $total += $item->price * $item->quantity;
        }
        $order->total = $total;
        $pdf = PDF::loadView('admin.order.print_order', compact('order'));
        return $pdf->stream('Đơn hàng_'.$id.'.pdf'); // Trả về file PDF
    }

}


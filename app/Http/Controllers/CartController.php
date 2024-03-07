<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        $carts = Cart::where('customer_id', auth('cus')->id())->get();
        return view('home.cart', compact('carts'));
    }

    public function add(Product $product, Request $request) {  //$product: là tham số route trên đường dẫn bên web.php(line 58) được truyền vào phương thức thông qua đường dẫn URL, có thể truy cập thông tin của sản phẩm từ model Product mà không cần phải truy vấn lại từ cơ sở dữ liệu.
        $quantity = $request->quantity ? floor($request->quantity) : 1;
        $cartExits = Cart::where(['customer_id' => auth('cus')->id(), 'product_id' => $product->id])->first();
        if ($cartExits) {
            Cart::where(['customer_id' => auth('cus')->id(), 'product_id' => $product->id])->increment('quantity', $quantity); //'quantity' tên field csdl
            return redirect()->route('cart.index')->with('success', 'You updated your cart unsuccessfully');
        } else {
            $data = [
                'customer_id' => auth('cus')->id(),
                'product_id' => $product->id,
                'price' => $product->sale_price ? $product->sale_price : $product->price,
                'quantity' => $quantity
            ];
            if (Cart::create($data)){
                return redirect()->route('cart.index')->with('success', 'You have successfully added products to your cart');
            }
        }
        return redirect()->back()->with('error', 'You have added products to your cart unsuccessfully');
    }

    public function update(Product $product, Request $request) {
        $quantity = $request->quantity ? floor($request->quantity) : 1;
        $cartExits = Cart::where(['customer_id' => auth('cus')->id(), 'product_id' => $product->id])->first();
        if ($cartExits) {
            Cart::where(['customer_id' => auth('cus')->id(), 'product_id' => $product->id])->update(['quantity'=> $quantity]); //'quantity' tên input bên view
            return redirect()->route('cart.index')->with('success', 'You updated your cart successfully');
        }
        return redirect()->back()->with('error', 'You updated your cart unsuccessfully');
    }

    public function delete($product_id) {
        Cart::where(['customer_id' => auth('cus')->id(), 'product_id' => $product_id])->delete();
        return redirect()->back()->with('success', 'You have successfully removed the product in the cart');
    }

    public function clear() {
        Cart::where(['customer_id' => auth('cus')->id()])->delete();
        return redirect()->back()->with('success', 'You have successfully removed all products in the cart');
    }

}

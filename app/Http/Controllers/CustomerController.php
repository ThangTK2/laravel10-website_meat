<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('id', 'desc')->paginate(10);
        if($key = request()->keyword){
            $customers = Customer::orderBy('id', 'desc')->where('name','like','%'.$key.'%')->paginate(10);
        }
        return view('admin.customer.index', compact('customers'));
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Xóa người dùng thành công');
    }
}

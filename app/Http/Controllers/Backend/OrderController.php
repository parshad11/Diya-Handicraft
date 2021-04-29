<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends BackendController
{

    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->paginate(10);
        return view($this->_pages . 'order.orders', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        $products = json_decode($order->products);
        $billingdetails = json_decode($order->billing_details);
        $shippingdetails = json_decode($order->shipping_details);
        return view($this->_pages . 'order.show', compact('order', 'products', 'billingdetails', 'shippingdetails'));
    }

    public function delete($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect('@dashboard@/orders')->with('status', 'Order Deleted Successfully');
    }

    public function changestatus(Request $request, $id)
    {
        $data=$request->status;
        $order = Order::findOrFail($id);
        if ($order) {
            $order->status = $request->status;
            $order->save();
            $data = ['status' => 'success'];
            return response(json_encode($data));
        }
        return redirect()->back()->with('error', 'Something Went Wrong');
    }

    public function create()
    {
        $products = Product::where('status', 1)->get();
        return view($this->_pages . 'order.create', compact('products'));
    }

    public function store(Request $request)
    {

        $product = [];
        $request->validate([
            'total_price' => 'required|numeric',
            'email'=>'',
            'phone'=>'required',
        ]);
        $product = array_combine($request->product_id, $request->quantity);
        $order_no = mt_rand(10000000, 99999999);
        $order = Order::create([
            'order_no' => $order_no,
            'products' => json_encode($product),
            'total_price' => $request->total_price,
            'status' => $request->status,
            'shipping_details' => json_encode($request->shipping_details),
            'billing_details' => json_encode($request->billing_details),
            'user_name' => $request->user_name,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);
        return redirect()->back()->with('status', 'Order Created');
    }


}


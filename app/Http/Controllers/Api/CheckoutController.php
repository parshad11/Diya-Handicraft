<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
            $carts = $carts = Cart::where('user_id', auth()->user()->id)->get();
            $total = 0;
            foreach ($carts as $key => $item) {
                $total += $item['total_price'] * $item['quantity'];
            }
            $order_no = mt_rand(10000000, 99999999);

            $order = Order::create([
                'order_no' => $order_no,
                'products' => json_encode($carts),
                'total_price' => $total,
                'status' => 0,
                'shipping_details' => json_encode($request->address),
//                'billing_details' => json_encode($request->payment_method),
                'user_name' => auth::user()->name,
                'phone' => auth::user()->phone,
                'email' => auth::user()->email,
            ]);
            $carts = $carts = Cart::where('user_id', auth()->user()->id)->get();
            foreach ($carts as $carts) {
                $quantity = $carts['quantity'];
                $product = Product::where('id', $carts['product_id'])->get();
                foreach ($product as $product) {
                    $product_quantity = $product->quantity;
                    $product->update([
                        'quantity' => $product_quantity - $quantity
                    ]);
                }

            }
        return response()->json(['status' => 'success', 'msg' => 'Order Successfull']);
        }
}

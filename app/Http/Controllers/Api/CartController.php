<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart_items = Cart::with('products')->where('user_id', auth()->user()->id)->get();
        return response()->json([ $cart_items]);
    }

    public function store(Request $request){
        $user_id = auth()->user()->id;
        $cart_items=Cart::where('user_id',$user_id)->get();
        $product=Product::find($request->product_id);
        if(!$product){
            return response()->json(['status' => 'error', 'msg' => 'Product not found']);
        }
        if($request->quantity>$product->quantity){
            return response()->json(['status' => 'error', 'msg' => 'Quantity is not available']);
        }
        $data = array();
        $data['product_id'] = $product->id;
        $data['user_id'] = $user_id;
        $data['quantity'] = isset($request->quantity) ? $request->quantity : 1;
        $data['total_price'] = $data['quantity'] * $product->discount_price;
        if ($cart_items) {
            $foundInCart = false;
            $cart = collect();
            foreach ($cart_items as $key => $cartItem) {
                if ($cartItem['product_id'] == $product->id) {
                    $foundInCart = true;
                    if ($cartItem['quantity'] >= $product->quantity) {
                        return response()->json(['status' => 'error', 'msg' => 'Quantity is not available']);
                    }
                    // $cartItem['id'] += $variation_product->id;
                    $cartItem['quantity'] += ($request->quantity) ? $request->quantity : 1;
                    $cartItem['total_price'] = $cartItem['quantity'] * $product->discount_price;
                }
                $cart->push($cartItem);
            }

            if (!$foundInCart) {

                $cart->push($data);
            }
        } else {
            $cart = collect([$data]);
        }
        $cart_data = array();
        foreach ($cart as $key => $value) {
            $cart_db = Cart::updateOrCreate(
                [
                    'product_id' => $value['product_id'],
                    'user_id' => $value['user_id'],
                ],
                [
                    'product_id' => $value['product_id'],
                    'user_id' => $value['user_id'],
                    'quantity' => $value['quantity'],
                    'total_price' => $value['total_price']
                ]
            );
            array_push($cart_data, $cart_db);
        }
        return response()->json(['status' => 'success', 'msg' => 'Product Added to Cart Successfully', 'data' => $cart_data]);


    }

    public function delete($id){
        $cart=Cart::find($id);
        if(!$cart){
            return response()->json(['status'=>'error','msg'=>'Cart Not Found']);
        }
        $cart->delete();
        return response()->json(['status' => 'success', 'msg' => 'Cart Deleted Successfully']);
    }
}

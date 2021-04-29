<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontendController;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends FrontendController
{
    public function index()
    {
        $carts = (array)session()->get('carts');
        $total_price = (float)session()->get('total_price');

        return view($this->_pages . 'cart', compact('carts', 'total_price'));
    }


    public function login()
    {
        return view($this->_pages . 'login');
    }


    public function store(Request $request)
    {
//        dd($request->all());
        try {
            $carts = (array)session()->get('carts');
            $total_price = (float)session()->get('total_price');

            $product = Product::where('id', base64_decode($request->id))->first();
            $price = $product->discount_price != '' ? $product->discount_price : $product->price;
            $cart_item = $request->all();
            $cart_item['cart_id'] = $product->id;
            $cart_item['product_title'] = $product->title;
            $cart_item['sub_total'] = (int)$price * (int)$request->quantity;
//            dd($cart_item);


            $cart_total = 0;
            $cart_total += $price;
            $total_price = $total_price + $cart_total;

            session()->push('carts', $cart_item);

            session()->put('total_price', $total_price);

            $data = array('status' => 'success', 'totalQty' => count(session()->get('carts')), 'totalPrice' => $total_price);

            echo json_encode($data);
        } catch (\Exception $e) {
            return view($this->_pages . '404')->with('error', $e->getMessage());
        }

    }


    public function deleteCartItem(Request $request)
    {
        $cart = (array)session()->get("carts");
        $cartTotalPrice = (float)session()->get("total_price");

        if (@$request->action == 'delete') {
            $id = $request->id;

            $cartTotalPrice = $cartTotalPrice - $cart[$id]['sub_total'];

            unset($cart[$id]);
            $cart = array_values($cart);

            $data = array('status' => 'deleted', 'totalQty' => count($cart), 'totalPrice' => $cartTotalPrice);

            session()->put("carts", $cart);
            session()->put("total_price", $cartTotalPrice);
            session()->save();

            echo json_encode($data);
        }
    }


    public function updateCart(Request $request)
    {
        // dd($request);
        $cart = (array)session()->get("carts");
        $cartTotalPrice = (float)session()->get("total_price");

        $product = Product::where('id', $request->product_id)->first();
        $unitPrice = $product->getPrice();
        $updatedQuantity = $request->updatedQuantity;
        $updatedMessage['productName'] = array();
        $updatedMessage['quantity'] = array();
        for ($i = 0; $i < count($cart); $i++) {
            while ($cart[$i]['cart_id'] == $product->id) {

                $productName = $product->title;

                array_push($updatedMessage['quantity'], $updatedQuantity);
                array_push($updatedMessage['productName'], $productName);
                $cartTotalPrice = $cartTotalPrice - $cart[$i]["sub_total"];

                $cart[$i]["quantity"] = $updatedQuantity;

                $cart[$i]["sub_total"] = $updatedQuantity * $unitPrice;
                $cartTotalPrice = $cartTotalPrice + $cart[$i]["sub_total"];

                session()->put("carts", $cart);
                session()->put("total_price", $cartTotalPrice);
                session()->save();

                $message = array('status' => 'success', 'updatedmessage' => $updatedMessage);
                return response(json_encode($message));

            }
        }

    }
}

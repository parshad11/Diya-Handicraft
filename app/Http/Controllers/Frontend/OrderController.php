<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontendController;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends FrontendController
{
    //
    public function orderTracking(Request $request)
    {
        $request->validate(
            [
                'order_code' => 'required'
            ]
        );
       $order = Order::where('order_no',$request->order_code)->first();
       if($order)
       {
        $product = json_decode($order->products);
        $products = collect([]);
         foreach($product as $key=>$value)
         {
             $orderproducts = Product::find($key);
             $products->push($orderproducts);
         }
         return view($this->_pages.'ordertracking',compact('order','products'));
       }
       else
       {
        return redirect()->back()->with('error','Order iID Not Found');
       }
       
      
    }

    public function trackingIndex()
    {
        return view($this->_pages.'ordertracking');
    }
}

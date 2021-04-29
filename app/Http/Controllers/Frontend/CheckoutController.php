<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\FrontendController;
use Srmklive\PayPal\Services\ExpressCheckout;

class CheckoutController extends FrontendController
{
    //
    public function index()
    {
        $carts = session()->get('carts');
//        dd($carts);
        return view($this->_pages . 'checkout', compact('carts'));
    }

    public function getCheckoutDetails(Request $request)
    {
        if ($request->payment_method == 'paypal') {
            $link = $this->getExpressCheckout();
            return redirect($link);
        } else {
            $carts = session()->get('carts');
            $total = 0;
            foreach ($carts as $key => $item) {

                $total += $item['sub_total'] * $item['quantity'];

            }


            $order_no = mt_rand(10000000, 99999999);

            $order = Order::create([
                'order_no' => $order_no,
                'products' => json_encode($carts),
                'total_price' => $total,
                'status' => 0,
                'shipping_details' => json_encode($request->address),
                'billing_details' => json_encode($request->payment_method),
                'user_name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
            ]);
            $carts = session()->get('carts');
            foreach ($carts as $carts) {
                $quantity = $carts['quantity'];
                $product = Product::where('id', $carts['cart_id'])->get();
                foreach ($product as $product) {
                    $product_quantity = $product->quantity;
                }
                $product->update([
                    'quantity' => $product_quantity - $quantity
                ]);

            }
            return redirect()->back()->with('success_status', 'Ordered Successful');
        }

    }

    public function getExpressCheckout()
    {
        $data = $this->checkoutDetails();
        $provider = new ExpressCheckout();
        // $response = $provider->setExpressCheckout($checkoutData);
        $response = $provider->setExpressCheckout($data);
        return $response['paypal_link'];
    }

    private function checkoutDetails()
    {
        $data = [];
        $carts = session()->get('carts');
        foreach ($carts as $cart) {

            $data['items'][] = [

                'name' => $cart['product_title'],
                'price' => $cart['sub_total'],
                'qty' => $cart['quantity']

            ];
        }
        $data['invoice_id'] = 1;
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = url('/checkout/success');
        $data['cancel_url'] = url('/checkout');

        $total = 0;
        $count = 0;

        foreach ($data['items'] as $key => $item) {

            $total += $item['price'] * $item['qty'];
            $count++;
        }

        $data['total'] = $total;

        //give a discount of 10% of the order amount
        $data['shipping_discount'] = round((10 / 100) * $total, 2);
        return $data;

    }

    public function getExpressCheckoutSuccess(Request $request)
    {
        $token = $request->get('token');
        $payerId = $request->get('PayerID');
        $provider = new ExpressCheckout();
        $response = $provider->getExpressCheckoutDetails($token);
        $data = $this->checkoutDetails();

        return redirect()->back()->with('success_status', 'Payment Successful');
    }

    public function cancel()
    {
        return redirect()->back()->with('error', 'Payment Unsuccessfully');
    }
}

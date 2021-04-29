<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class ReportController extends BackendController
{
    public function inventory(Request $request)
    {
        $search = Product::orderBy('id', 'Desc')->get();
        if ($request->title) {
            $search = Product::where('title', 'like', $request->title . '%')->get();
        }
        $product = $search;

        return view($this->_pages . 'report.inventory', compact('product'));
    }

    public function sales(Request $request)
    {
        $search = Order::where('status', '2')->orderBy('id', 'Desc')->get();
        if ($request->order_no) {
            $search = Order::where('status', '2')->where('order_no', 'like', $request->order_no)->orderBy('id', 'Desc')->get();
        }
        if ($request->from || $request->to) {
            if (!$request->from) {
                return redirect()->back()->with('error', 'please enter Starting date ');
            }
            if (!$request->to) {
                return redirect()->back()->with('error', 'please enter end date ');
            }
            $search = Order::where('status', '2')->whereBetween('created_at', array($request->from, $request->to))->orderBy('id', 'Desc')->get();
        }
        $sales = $search;
        return view($this->_pages . 'report.sales', compact('sales'));
    }

}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\SearchCollection;
use App\Models\Product;
use Illuminate\Http\Request;


class SearchController extends Controller
{
    public function search(Request $request){
        $query=$request->q;
        if($request->q) {
            $query = Product::orderBy('id', 'desc')->where('status', 1)
                ->where('title', 'like', '%' . $query . '%')->get();
        }
        if($request->sort_by='high' || $request->sort_by='High')
        {
            $query = Product::orderBy('id', 'desc')
                ->orderBy('discount_price','desc')
                ->where('status', 1)
                ->get();
        }
        if($request->sort_by='low' || $request->sort_by='Low')
        {
            $query = Product::orderBy('id', 'desc')
                ->orderBy('discount_price','asc')
                ->where('status', 1)
                ->get();
        }
        if($request->min_price && $request->max_price)
        {
            $query = Product::orderBy('id', 'desc')
                ->where('discount_price', '>=', $request->min_price)
                ->where('discount_price', '<=', $request->max_price)
                ->where('status', 1)
                ->get();
        }
        $product=$query;
        return new ProductCollection($product);
    }
}

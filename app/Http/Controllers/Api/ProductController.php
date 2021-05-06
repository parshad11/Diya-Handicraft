<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function featuredproduct()
    {
        return new ProductCollection(Product::where('feature', 1)->where('status', 1)->get());
    }

    public function specialproduct()
    {
        return new ProductCollection(Product::where('special', 1)->where('status', 1)->get());
    }

    public function latestproduct()
    {
        return new ProductCollection(Product::orderBy('created_at', 'desc')->where('status', 1)->take(10)->get());
    }

    public function mostviewproduct()
    {
        return new ProductCollection(Product::orderBy('views', 'desc')->where('status', 1)->take(10)->get());
    }

    public function bestselledproduct()
    {
        return new ProductCollection(Product::orderBy('rate', 'desc')->where('status', 1)->take(10)->get());
    }

    public function ProductDetail($slug)
    {
        $product=Product::where('slug', $slug)->where('status', 1)->first();
        $oldView=$product->views;
        $product['views']=$oldView+1;
        $product->update();
        return new ProductCollection(Product::where('slug', $slug)->where('status', 1)->get());

    }
}
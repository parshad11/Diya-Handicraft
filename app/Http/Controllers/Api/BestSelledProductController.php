<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class BestSelledProductController extends Controller
{
    //
    public function bestselledproduct()
    {
        $path = asset('/storage/products/');
        $bestselledproduct = json_decode(strip_tags(Product::orderBy('rate','desc')->where('status',1)->take(10)->select(
            'products.id',
            DB::raw("CONCAT('$path/',products.image) as product_image"),
            'products.title',
            'products.price',
            'products.discount_price',
            'products.color',
            'products.size',
            'products.rate',
            'products.brand',
            'products.description',
            'products.excerpt_description',
            'products.slug',
        )->get()),true);
       
        return response()->json([
            'bestselledproduct' => [

                'bestselledproduct'=>$bestselledproduct,
            ]
        ]);
    }
}

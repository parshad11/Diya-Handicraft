<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class SpecialProductController extends Controller
{
    //
    public function specialproduct()
    {
        $path = asset('/storage/products/');
        $special_product = json_decode(strip_tags(Product::where('special',1)->where('status',1)->select(
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
            'special_product' => [

                'special_product'=>$special_product,
            ]
        ]);
    }

}

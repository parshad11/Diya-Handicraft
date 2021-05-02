<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function featuredproduct()
    {
        $path = asset('/storage/products/');
        $featured_product = json_decode(strip_tags(Product::where('feature',1)->where('status',1)->select(
            'products.id',
            'products.title',
            'products.price',
            'products.discount_price',
            'products.shipping_method',
            'products.shipping_charge',
            'products.tax',
            'products.brand',
            'products.quantity',
            'products.color',
            'products.size',
            'products.rate',
            'products.description',
            'products.excerpt_description',
            DB::raw("CONCAT('$path/',products.image) as product_image"),
            'products.slug'
        )->get()),true);

        return response()->json([
            'feature_product' =>$featured_product,
        ]);
    }

    public function specialproduct()
    {
        $path = asset('/storage/products/');
        $special_product = json_decode(strip_tags(Product::where('special',1)->where('status',1)->select(
            'products.id',
            'products.title',
            'products.price',
            'products.discount_price',
            'products.shipping_method',
            'products.shipping_charge',
            'products.tax',
            'products.brand',
            'products.quantity',
            'products.color',
            'products.size',
            'products.rate',
            'products.description',
            'products.excerpt_description',
            DB::raw("CONCAT('$path/',products.image) as product_image"),
            'products.slug'
        )->get()),true);

        return response()->json([
            'special_product' => [

                'special_product'=>$special_product,
            ]
        ]);
    }

    public function latestproduct()
    {
        $path = asset('/storage/products/');
        $latestproduct = json_decode(strip_tags(Product::orderBy('created_at','desc')->where('status',1)->take(10)->select(
            'products.id',
            'products.title',
            'products.price',
            'products.discount_price',
            'products.shipping_method',
            'products.shipping_charge',
            'products.tax',
            'products.brand',
            'products.quantity',
            'products.color',
            'products.size',
            'products.rate',
            'products.description',
            'products.excerpt_description',
            DB::raw("CONCAT('$path/',products.image) as product_image"),
            'products.slug'
        )->get()),true);

        return response()->json([
            'latestproduct' => [

                'latestproduct'=>$latestproduct,
            ]
        ]);
    }

    public function mostviewproduct()
    {
        $path = asset('/storage/products/');
        $mostviewproduct = json_decode(strip_tags(Product::orderBy('views','desc')->where('status',1)->take(10)->select(
            'products.id',
            'products.title',
            'products.price',
            'products.discount_price',
            'products.shipping_method',
            'products.shipping_charge',
            'products.tax',
            'products.brand',
            'products.quantity',
            'products.color',
            'products.size',
            'products.rate',
            'products.description',
            'products.excerpt_description',
            DB::raw("CONCAT('$path/',products.image) as product_image"),
            'products.slug'
        )->get()),true);

        return response()->json([
            'mostviewproduct' => [

                'mostviewproduct'=>$mostviewproduct,
            ]
        ]);
    }

    public function bestselledproduct()
    {
        $path = asset('/storage/products/');
        $bestselledproduct = json_decode(strip_tags(Product::orderBy('rate','desc')->where('status',1)->take(10)->select(
            'products.id',
            'products.title',
            'products.price',
            'products.discount_price',
            'products.shipping_method',
            'products.shipping_charge',
            'products.tax',
            'products.brand',
            'products.quantity',
            'products.color',
            'products.size',
            'products.rate',
            'products.description',
            'products.excerpt_description',
            DB::raw("CONCAT('$path/',products.image) as product_image"),
            'products.slug'
        )->get()),true);

        return response()->json([
            'bestselledproduct' => [

                'bestselledproduct'=>$bestselledproduct,
            ]
        ]);
    }
}

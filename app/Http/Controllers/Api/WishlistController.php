<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    //
    public function index()
    {
        $wishlist_items = Wishlist::with('products')->where('user_id', auth()->user()->id)->get();
        return response()->json([ $wishlist_items]);
    }

    public function store(Request $req){
        $user_id = auth()->user()->id;
        $wishlist_items=Wishlist::where('user_id',$user_id)->get();
        $product=Product::find($req->product_id);
        if(!$product){
            return response()->json(['status' => 'error', 'msg' => 'Product not found']);
        }

        if ($wishlist_items) {

                if ($cartItem['product_id'] == $product->id) {
                    return response()->json(['status' => 'error', 'msg' => 'Product exist in wishlist']);
                }
        } 
        else {
            $wishlist      =       array(
                "product_id"          =>      $product->id,
                "user_id"             =>      $user_id,
            );
            $wish_list           =       Wishlist::Create(
                $wishlist
            );
            return response()->json(['status' => 'success', 'msg' => 'Product Added to Wishlist Successfully', 'data' => $wish_list]);
        }
    }

    public function delete($id){
        $wish_list=Wishlist::find($id);
        if(!$wish_list){
            return response()->json(['status'=>'error','msg'=>'Wishlist Not Found']);
        }
        $wish_list->delete();
        return response()->json(['status' => 'success', 'msg' => 'Wishlist Deleted Successfully']);
    }
}

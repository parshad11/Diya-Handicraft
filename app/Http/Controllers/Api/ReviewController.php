<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index(){
        $review=Review::with('user')->with('products')->get();
        return response()->json(
            [
                'status' => $review
            ]
        );
    }

    public function store(Request $request){
        $data=$request->validate([
           'rating'=>'required|integer',
           'product_id'=>'required|integer',
           'comments'=>''
        ]);
        $data['user_id']=auth()->user()->id;
        $review=new Review();
        $review->fill($data);
        $review->save();
        return response()->json(['status' => 'success', 'msg' => 'Review Added Successfully']);
    }

    public function delete($id){
        $review=Review::where('user_id',auth()->user()->id)->find($id);
        if(!$review){
            return response()->json(['status' => 'error', 'msg' => 'Review Not Found']);
        }
        $review->delete();
        return response()->json(['status' => 'success', 'msg' => 'Review Deleted Successfully']);
    }
}

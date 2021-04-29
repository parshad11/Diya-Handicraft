<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    //
    public function create(Request $request)
    {
        $review = Review::where('user_id',auth()->user()->id)->where('product_id',$request->product_id)->first();
       
        if($review)
        {
            $review->update([
                'user_id'=> $request->user_id,
                'product_id'=> $request->product_id,
                'comments' => $request->comments,
                'rating' => $request->rating
            ]);
            if($review)
        {
            return redirect()->back()->with('success_status','Comment Added Successfully');
        }
        }
        else
        {  
             $comment = Review::create([
            'user_id'=> $request->user_id,
            'product_id'=> $request->product_id,
            'comments' => $request->comments,
            'rating' => $request->rating
        ]);
        if($comment)
        {
            return redirect()->back()->with('success_status','Comment Added Successfully');
        }

        }
     
        
        return redirect()->back()->with('error','Invalid Crediantials! please try again');
    }

    public function delete($id)
    {
        Review::findOrFail($id)->delete();
        return redirect()->back()->with('success_status','Successfully Deleted Comment');

    }
}

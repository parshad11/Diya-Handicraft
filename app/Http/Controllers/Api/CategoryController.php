<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function categories(){
        $categories = category::get();
		
		return response()->json([
			'categories' => $categories
			// 'special_category'=>$special_cat
		]);
	}

    public function latestcategory()
    {
        
        $latestcategory = category::orderBy('created_at', 'desc')->get();
            

        return response()->json([
            'latestcategory' => [

                'latestcategory'=>$latestcategory,
            ]
        ]);
    }
}

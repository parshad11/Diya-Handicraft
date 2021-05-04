<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function categories()
    {
        $category = category::with(['products' => function ($query) {
            $query->orderBy('products.id', 'desc');
        }])
            ->get();
        return new CategoryResource($category);
    }

    public function latestcategory()
    {

        $latestcategory = category::with(['products' => function ($query) {
            $query->orderBy('products.id', 'desc');
        }])
            ->orderByDesc('id')
            ->get();
        return new CategoryResource($latestcategory);
    }
}

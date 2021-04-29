<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontendController;
use App\Mail\QuickMsg;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class HomeController extends FrontendController
{
    public function index()
    {
		
    //    \Artisan::call('config:clear');
	// 	\Artisan::call('cache:clear');
	// 	\Artisan::call('storage:link');
        $banners = Banner::where([['status', 1]])->orderBy('order_item')->get();
        $horizontal = Banner::where([['status', 1]])->first();
        $horizontalBanner = Banner::where([['status', 1]])->skip(1)->first();
        $featured = Category::has('products')->where([['status', 1], ['feature', 1], ['parent_id', '==', 0]])->get();
        $cat_products = Category::with('products')->where([['status', 1], ['feature', 1], ['parent_id', '!=', 0], ['child', '==', 0]])->get();
        return view($this->_pages . 'index', array('banners' => $banners,
            'horizontal' => $horizontal,
            'horizontalBanner' => $horizontalBanner,
            'featured' => $featured,
            'cat_products' => $cat_products,
        ));
    }

    public function aboutus()
    {
        return view('frontend.about');
    }


    public function contactus()
    {
        return view('frontend.contact');
    }

    public function shop()
    {
        return view('frontend.shop');
    }

    public function shopSingle(String $slug)
    {
        $product = Product::where('slug', $slug)->first();
        $singleProducts = Category::where([['status', 1], ['feature', 1], ['parent_id', '!=', 0], ['child', '==', 0]])->get();
        return view('frontend.shop-single', compact('product', 'singleProducts'));
    }

    public function category(Category $category, $id)
    {
        $category = Category::all();
        $product = Product::where('category_id', $id)->paginate(6);
        $navtitle = Category::find($id);
        return view('frontend.category')->with('products', $product)->with('categories', $category)->with('navtitle',$navtitle);
    }

    public function searchinput(Request $request, Product $product)
    {
        $category = Category::all();
        $cat = Category::where("title", "LIKE", "%{$request->q}%")->get();

        $product = Product::where("title", "LIKE", "%{$request->q}%")
            ->get();


        return view('frontend.shop')->with('products', $product)->with('categories', $category)->with('q',$request->q);

    }


    public function quickMsg(Request $request)
    {
        $this->validate($request, [
            "name" => 'required|max:255',
            "email" => 'required|max:255|email',
            "phone" => 'required|max:255',
            'subject' => 'required|min:4',
            "message" => 'required'
        ]);


        $quickMsg = array(
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'subject' => $request->subject,
        );

        Mail::to(Setting::where('id', 1)->first()->site_email)->send(new QuickMsg($quickMsg));
        return redirect('contact')->with('status', 'Your Message Sent Successfully! We will Contact Within 24 hours.');

    }
    public function sorting(Request $request)
    {

        if($request->data == 'low_price')
        {

            $products = $request->product;

            $collection = collect($products);

            $sorted = $collection->sortBy('price');
            $view  = view('frontend.includes.sorting')->with('products', $sorted)->render();
            return response()->json(['success'=>true,'view'=>$view]);
        }
        if($request->data == 'high_price')
        {

            $products = $request->product;

            $collection = collect($products);

            $highprice = $collection->sortByDesc('price');

            $view  = view('frontend.includes.sorting')->with('products', $highprice)->render();
            return response()->json(['success'=>true,'view'=>$view]);
        }
        if($request->data == 'high_dis')
        {
            $products = $request->product;

            $collection = collect($products);

            $highprice = $collection->sortByDesc('discount');

            $view  = view('frontend.includes.sorting')->with('products', $highprice)->render();
            return response()->json(['success'=>true,'view'=>$view]);
        }
        if($request->data == 'new_product')
        {
            $products = $request->product;

            $collection = collect($products);

            $new_product = $collection->sortBy('created_at');

            $view  = view('frontend.includes.sorting')->with('products', $new_product)->render();
            return response()->json(['success'=>true,'view'=>$view]);
        }

        if($request->data == 'old_product')
        {
            $products = $request->product;

            $collection = collect($products);

            $old_product = $collection->sortByDesc('created_at');

            $view  = view('frontend.includes.sorting')->with('products', $old_product)->render();
            return response()->json(['success'=>true,'view'=>$view]);
        }
    }


}


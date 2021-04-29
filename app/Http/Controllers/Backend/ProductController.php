<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;

use App\Models\Category;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\Brand;
use Illuminate\Database\QueryException;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;


class ProductController extends BackendController
{
    public function index()
    {

        $products = Product::orderBy('id', 'desc')->paginate(10);
        return view($this->_pages . 'products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('order_no')->get();
        $brand = Brand::orderBy('id', 'Desc')->get();
        $attribute = Attribute::orderBy('id', 'ASC')->get();
        return view($this->_pages . 'products.create', compact('categories', 'brand', 'attribute'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:4',
            'price' => 'required',
            'description' => 'required',
            'excerpt_description' => 'required',
            'brand' => '',
            'color' => '',
            'size' => '',

        ]);
        try {
            $slug = Product::createSlug($request->title);
            $maxOrder = DB::table('products')->max('order_item');
            if ($request->hasFile('image')) {
                $this->validate($request, [
                    'image' => 'image|mimes:jpeg,Jpg,png,jfif|max:50000'
                ]);
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $folderPath = 'products/' . $slug . '/';
                $thumbPath = 'products/' . $slug . '/thumbs/';
                /* if (!file_exists($thumbPath)) {
                     Storage::makeDirectory($thumbPath, 077, true, true);
                 }*/
                Storage::putFileAs($folderPath, new File($image), $imageName);

                /*  Product::resize_crop_images(218, 250, $image, $thumbPath . 'thumb_' . $imageName);
                  Product::resize_crop_images(433, 474, $image, $thumbPath . 'big_' . $imageName);
                  Product::resize_crop_images(200, 200, $image, $thumbPath . 'small_' . $imageName);*/
                $fileName = $imageName;
            }


            if ($request->hasFile('featured_image')) {
                $this->validate($request, [
                    'image' => 'image|mimes:jpeg,Jpg,png,jfif|max:50000'
                ]);
                $feature = $request->file('featured_image');
                $featuredImage = time() . '.' . $image->getClientOriginalExtension();
                $folderPath = 'products/' . '/';
                $thumbPath = 'products/' . '/thumbs/';
                /*     if (!file_exists($thumbPath)) {
                         Storage::makeDirectory($thumbPath, 077, true, true);
                     }*/
                Storage::putFileAs($folderPath, new File($image), $featuredImage);
                /*     Product::resize_crop_images(218, 250, $image, $thumbPath . 'thumb_featured' . $featuredImage);
                     Product::resize_crop_images(433, 474, $image, $thumbPath . 'big_featured' . $featuredImage);
                     Product::resize_crop_images(200, 200, $image, $thumbPath . 'small_featured' . $featuredImage);*/
                $feature_image = $featuredImage;
            }
            $size = implode(',', $request->size);
            $product = Product::create([
                'title' => $request->title,
                'price' => $request->price,
                'discount_price' => $request->discount_price != '' ? $request->discount_price : Null,
                'shipping_method' => $request->shipping_method,
                'shipping_charge' => $request->shipping_charge != '' ? $request->shipping_charge : Null,
                'tax' => $request->tax != '' ? $request->tax : Null,
                'quantity' => $request->quantity,
                'color' => implode(',', $request->color),
                'description' => $request->description,
                'image' => $fileName,
                'order_item' => $maxOrder + 1,
                'feature_image' => $feature_image,
                'feature' => $request->feature,
                'slug' => $slug,
                'status' => $request->status,
                'category_id' => $request->category,
                'created_by' => Auth::user()->name,
                'updated_by' => '',
                'excerpt_description' => $request->excerpt_description
            ]);
            $product->size = implode(',', $request->size);
            $product->save();
            return redirect(url('@dashboard@/product'))->with('status', 'Product Added Succesfully !!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back();
    }


    public function addField()
    {
        return '<div class="col-06 body" id="row">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                   Enter Optional Title
                                </div>
                            </div>
                            <input type="text" name="option_name[]" class="form-control" required="">
                             <button type="button" name="remove" id="" class="btn btn-danger btn_remove">
                                    <i class=" fa fa-trash"></i>
                                </button>
                        </div>
                    </div>

                    <div class="body">
                        <textarea class="form-control summernote" name="option_value[]"></textarea>
                    </div>';
    }

    public function edit($id)
    {
        try {
            $id = base64_decode($id);
            $product = Product::where('id', $id)->firstOrFail();
            $categories = Category::orderBy('id', 'asc')->where('status', 1)->get();
            $selectedCategory = $product->category_id;

            return view($this->_pages . 'products.edit', compact('product', 'categories', 'selectedCategory'));
        } catch (QueryException $q) {
            return $q->getMessage();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:4',
            'price' => 'required',
            'description' => 'required',
            'excerpt_description' => 'required',
            'brand' => '',
            'color' => '',
            'size' => '',

        ]);
        try {
        $unit = $request->unit;
        $product = Product::find(base64_decode($request->id));
        $slug = Str::slug($request->title);
        $path = public_path() . '/storage/products/' . $product->slug;


        if ($product->slug != $slug) {
            if (file_exists($path)) {
                Storage::move('public/products/' . $product->slug, 'public/products/' . $slug);

            }
            $product->slug = Product::createSlug($slug, $request['id']);
            $slug = $product->slug;

        }

        $imageName = $product->image;

        if ($request->hasFile('image')) {
            $this->validate($request, [
                'image' => 'image|mimes:jpeg,Jpg,png,JFIF|max:50000'
            ]);

            $folderPath = 'products/' . $slug;
//            dd($folderPath);

            if (!file_exists($path)) {

                Storage::makeDirectory($folderPath, 0777, true, true);
                if (!is_dir($path . "/thumbs")) {
                    Storage::makeDirectory($folderPath . '/thumbs', 0777, true, true);
                }

            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            Storage::putFileAs($folderPath, new File($image), $imageName);
            /* Product::resize_crop_images(218, 250, $image, $folderPath . '/thumbs/thumb_' . $imageName);
             Product::resize_crop_images(433, 474, $image, $folderPath . '/thumbs/big_' . $imageName);
             Product::resize_crop_images(200, 200, $image, $folderPath . '/thumbs/small_' . $imageName);*/

            $oldImage = $product->image;
            Storage::delete($folderPath . '/' . $oldImage);
        }



        $product->update([
            'title' => $request->title,
            'price' => $request->price,
            'discount_price' => $request
                ->discount_price,
            'shipping_method' => $request->shipping_method,
            'shipping_charge' => $request->shipping_charge != '' ? $request->shipping_charge : Null,
            'tax' => $request->tax != '' ? $request->tax : Null,
            'color' => implode(',', $request->color),
            'size' => @implode(',', $request->size),
            'description' => $request->description,
            'excerpt_description' => $request->excerpt_description,
            'option' => $request->option,
            'slug' => $slug,
            'image' => $imageName,
            'feature' => $request->feature,
            'status' => $request->status,
            'category_id' => $request->category,
            'quantity' => $request->quantity,
            'updated_by' => Auth::user()->name,
            'created_by' => $product->created_by,
        ]);

        return redirect(route('products.list'))->with('status', 'Product Updated Successfully !!');
        } catch (QueryException $q) {
            return $q->getMessage();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($id)
    {

        $product = Product::findOrFail(base64_decode($id));
        $folderPath = 'products/' . $product->slug;
        $oldImage = $product->image;
        Storage::delete($folderPath . '/' . $oldImage);
        $product->delete();
        return back()->with('status', 'Product Deleted Successfully !!');
    }


}



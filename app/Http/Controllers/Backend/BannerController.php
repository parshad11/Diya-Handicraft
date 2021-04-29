<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BannerController extends BackendController
{
    public function index()
    {
        $banners = Banner::orderBy('created_at', 'desc')->paginate(10);
        return view($this->_pages . 'banner.index', compact('banners'));
    }

    public function create()
    {
        return view($this->_pages . 'banner.create');
    }

    public function store(Request $request)
    {
//        dd($request->all());
        $this->validate($request, [
            'image' => 'image|mimes:jpeg,png,jpg|max:50000',
            'position'=>'required'
        ]);

        $banner = new Banner();
        $max_order = DB::table('banners')->max('order_item');
        $banner->order_item = $max_order + 1;
        try
        {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $folderPath = 'banners/images';
            if (!file_exists($folderPath)) 
            {
                Storage::makeDirectory($folderPath, 077, true, true);
            }
            Storage::putFileAs($folderPath, new File($image), $imageName);
            $banner->image = $imageName;

            $banner->url = $request->url;

            if ($request->status) {
                $banner->status = $request->status;
            }

            $banner->position = $request->position;

            $banner->save();
            return redirect(url('@dashboard@/banner'))->with('status', 'Banner Added Successfully !!');
        } 
        catch (\Exception $e) 
        {

            dd($e->getMessage());
        }
    }

    public function edit($id)
    {
        $banner = Banner::findOrfail(base64_decode($id));
        return view($this->_pages . 'banner.create', compact('banner'));
    }   

    public function update($id,Request $request)
    {
       
        $this->validate($request, [
            'page' => 'required',
            'type' => 'required',
            'url' => 'required|url',
        ]);
        $banner = Banner::findOrFail($id);
        
        if($request->hasFile('image'))
        {
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg|max:50000'
            ]);
            $oldImage = $banner->image;
            $type = $banner->type;
            $thumb = 'public/banners/images/' . $type . '_' . $oldImage;
            $small = 'public/banners/images/' . $type . '_small' . $oldImage;
            Storage::delete($thumb);
            Storage::delete($small);
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $folderPath = 'public/banners/images';
            if (!file_exists($folderPath)) 
            {
                Storage::makeDirectory($folderPath, 077, true, true);
            }
            Storage::putFileAs($folderPath, new File($image), $imageName);
            switch ($request->type) 
            {
                case 'vertical':
                    Banner::resize_crop_images(1349, 250, $image, $folderPath . '/vertical_' . $imageName);
                    Banner::resize_crop_images(200, 200, $image, $folderPath . '/vertical_small_' . $imageName);
                    $request->image = $imageName;
                    break;
                default:
                    Banner::resize_crop_images(187, 305, $image, $folderPath . '/horizontal_' . $imageName);
                    Banner::resize_crop_images(200, 200, $image, $folderPath . '/horizontal_small_' . $imageName);
                    $request->image = $imageName;
                break;

            }

        }
        $update = Banner::where('id',$id)->update([
            'type' => $request->type,
            'status' => $request->status,
            'featured' =>$request->featured,
            'image' => $request->image,
            'url' => $request->url, 
            'position'=>$request->position,
            'page'=>$request->page

        ]);
        if($update)
        {
            return redirect()->route('banners.list')->with('status','Successfully Updated');
        }
        return redirect()->back()->with('error','Something went wrong!');
        
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail(base64_decode($id));
        $oldImage = $banner->image;
        $type = $banner->type;
        $thumb = 'public/banners/images/' . $type . '_' . $oldImage;
        $small = 'public/banners/images/' . $type . '_small' . $oldImage;
        $banner->delete();
        Storage::delete($thumb);
        Storage::delete($small);
        return redirect()->back()->with('status', 'Banner Deleted Successfully !!');
    }
}

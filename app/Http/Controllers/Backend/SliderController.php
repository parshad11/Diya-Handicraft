<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = DB::table('sliders')->orderBy('order_item')->get();
        return view('admin.sliders', array('sliders' => $sliders, 'id' => '0'));
    }

    public function resize_crop_images($max_width, $max_height, $image, $filename)
    {
        $imgSize = getimagesize($image);
        $width = $imgSize[0];
        $height = $imgSize[1];

        $width_new = round($height * $max_width / $max_height);
        $height_new = round($width * $max_height / $max_width);

        if ($width_new > $width) {
            //cut point by height
            $h_point = round(($height - $height_new) / 2);

            $cover = storage_path('app/' . $filename);
            Image::make($image)->crop($width, $height_new, 0, $h_point)->resize($max_width, $max_height)->save($cover);
        } else {
            //cut point by width
            $w_point = round(($width - $width_new) / 2);
            $cover = storage_path('app/' . $filename);
            Image::make($image)->crop($width_new, $height, $w_point, 0)->resize($max_width, $max_height)->save($cover);
        }

    }

    public function createslide(Request $request)
    {
        $slider = new Slider();
        $max_order = DB::table('sliders')->max('order_item');
        $max_order = $max_order == '' ? 0 : $max_order;
        if (!$request->slide_status) {
            $request->slide_status = 0;
        }
        $validatedData = $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg|max:50000',
        ]);
        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $validatedData = $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg|max:50000',
            ]);

            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $folderPath = "public/slider";
            $thumbPath = "public/slider/thumbs";
            if (!file_exists($thumbPath)) {
                Storage::makeDirectory($thumbPath, 0777, true, true);
            }
            Storage::putFileAs($folderPath, new File($image), $filename);
            $this->resize_crop_images(1440, 810, $image, $thumbPath . "/slide_" . $filename);
            $this->resize_crop_images(144, 81, $image, $thumbPath . "/small_" . $filename);
            $slider->image = $filename;
        }
        $request['status'] = isset($request['status']) ? $request['status'] : '0';
        $slider->title = $request->input('title');
        $slider->subtitle = $request->input('subtitle');
        $slider->buttonName = $request->input('buttonName');
        $slider->link = $request->input('link');
        $slider->status = $request->input('status');
        $slider->order_item = $max_order + 1;
        $slider->save();
        return redirect()->to('/admin/sliders')->with('status', 'Slider added Successfully!');
    }

    public function editslide($id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.editslide', array('slider' => $slider));
    }

    public function set_order(Request $request)
    {
        $list_order = [];
        $slider = new Slider;
        $list_order = $request['list_order'];
        $i = 1;
        foreach ($list_order as $id) {
            $updateData = array("order_item" => $i);
            Slider::where('id', $id)->update($updateData);
            $i++;
        }
        $data = array('status' => 'success');
        echo json_encode($data);
    }

    public function updateslide(Request $request)
    {

        $slide = Slider::findOrFail($request->id);


        if ($request['status'] == '') {
            $request['status'] = 0;
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $validatedData = $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg|max:50000',
            ]);

            $oldslide = $slide->image;

            $filename = time() . '.' . $image->getClientOriginalExtension();
            $folderPath = "public/slider";

            Storage::putFileAs($folderPath, new File($image), $filename);

            $this->resize_crop_images(1440, 810, $image, $folderPath . "/thumbs/slide_" . $filename);
            $this->resize_crop_images(144, 81, $image, $folderPath . "/thumbs/small_" . $filename);

            Storage::delete($folderPath . '/' . $oldslide);
            Storage::delete($folderPath . '/thumbs/slide_' . $oldslide);
            Storage::delete($folderPath . '/thumbs/small_' . $oldslide);

            $slide->image = $filename;
        }
        $slide->title = $request->input('title');
        $slide->subtitle = $request->input('subtitle');
        $slide->buttonName = $request->input('buttonName');
        $slide->link = $request->input('link');
        $slide->status = $request->input('status');
        $slide->save();
        return redirect()->to('admin/sliders')->with('status', 'Slide Update Successfully!');

    }

    public function delete($id)
    {
        $slide = Slider::findOrFail($id);

        $oldslide = $slide->image;

        if ($slide) {
            $slide->delete();
            $folderPath = "public/slider";
            Storage::delete($folderPath . '/' . $oldslide);
            Storage::delete($folderPath . '/thumbs/slide_' . $oldslide);
            Storage::delete($folderPath . '/thumbs/small_' . $oldslide);

            return redirect()->to('/admin/sliders')->with('status', 'Slide Deleted Successfully!');
        }
        return redirect()->to('/admin/sliders')->with('error', 'Something Went Wrong!');

    }
}


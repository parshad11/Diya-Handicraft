<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use App\Models\Setting;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SettingController extends BackendController
{
    public function index()
    {
        $setting = Setting::findOrFail(1);
        return view($this->_pages . 'site.view', compact('setting'));
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



    public function update(Request $request)
    {
//        dd($request);
        $setting = Setting::find('1');
        $validatedData = $request->validate([
            'sitetitle' => 'required|max:255',
            'siteemail' => 'required|max:225|email',
        ]);
        $setting->site_title = $request->sitetitle;
        $setting->site_email = $request->siteemail;
        $setting->site_phone = $request->phone;
        $setting->site_mobile = $request->mobile;
       /* $setting->fax = $request->fax;
       */ $setting->site_address = $request->address;
        $setting->about = $request->site_about;
      /*  $setting->currency = $request->currency;*/
        $setting->social_links = json_encode([
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'google' => $request->google,
        ]);

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $filename = time() . '.' . $logo->getClientOriginalExtension();
            $oldlogo = $setting->logo;
            $validatedData = $request->validate([
                'logo' => 'image|mimes:jpeg,png,jpg|max:1000',
            ]);
            Storage::putFileAs('setting/logo', new File($logo), $filename);
//            dd('sad');
            $setting->logo = $filename;

            $this->resize_crop_images(200, 200, $logo, "public/setting/logo/" . $filename);
            if ($oldlogo != null) {
                //deleting exiting logo
                Storage::delete('public/setting/logo/' . $oldlogo);
                Storage::delete('public/setting/logo/thumb_' . $oldlogo);
            }
        }
        if ($request->hasFile('favicon')) {
            $logo = $request->file('favicon');
            $filename = time() . '.' . $logo->getClientOriginalExtension();
            $oldfavicon = $setting->favicon;
            $validatedData = $request->validate([
                'favicon' => 'image|mimes:jpeg,png,jpg|max:1000',
            ]);

            Storage::putFileAs('setting/favicon', new File($logo), $filename);

            $setting->favicon = $filename;

            $this->resize_crop_images(200, 200, $logo, "public/setting/favicon/". $filename);
            if ($oldfavicon != null) {
                //deleting exiting logo
                Storage::delete('public/setting/favicon/' . $oldfavicon);
                Storage::delete('public/setting/favicon/thumb_' . $oldfavicon);
            }
        }
        $setting->save();

        return redirect(route('admin-site'))->with('status', 'Setting Update Successfully.');

    }


}

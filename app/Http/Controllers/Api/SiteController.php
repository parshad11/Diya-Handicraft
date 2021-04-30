<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;


class SiteController extends Controller
{
    public function index(){
        $site_setting=Setting::first();

        return response()->json([
            'site_setting'=>[
                'id'=>$site_setting->id,
                'logo'=>'http://diya.loc/storage/setting/logo/'.$site_setting->logo,
                'favicon'=>'http://diya.loc/storage/setting/favicon/'.$site_setting->favicon,
                'site_title'=>$site_setting->site_title,
                'site_address'=>$site_setting->site_address,
                'site_phone'=>$site_setting->site_phone,
                'site_mobile'=>$site_setting->site_mobile,
                'site_email'=>$site_setting->site_email,
                'social_links'=>json_decode($site_setting->social_links),
                'long'=>$site_setting->long,
                'lat'=>$site_setting->lat,
                'about'=>$site_setting->about,
            ]
        ]);
    }
}

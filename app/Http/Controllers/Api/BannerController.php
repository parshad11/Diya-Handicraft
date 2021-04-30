<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\Banner;
use Illuminate\Support\Facades\DB;

class BannerController extends Controller
{
    //
    public function banner()
    {
        $path = asset('/storage/banners/images/');
        $banner = Banner::where('status', 1)
            ->select(
                'banners.id',
                DB::raw("CONCAT('$path/',banners.image) as banner_image"),
                'banners.url'
            )
            ->get();
        return response()->json([
            'data' => [
                'banner' => $banner,
            ]
        ]);
    }
}

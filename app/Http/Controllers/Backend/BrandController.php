<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class BrandController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brand = Brand::all();
        return view($this->_pages . 'brand.index', compact('brand'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view($this->_pages . 'brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'title' => 'required',
                'logo' => '',
                'meta_title' => '',
                'description' => ''
            ]
        );
        if ($request->hasFile('logo')) {
            $this->validate($request, [
                'logo' => 'image|mimes:jpeg,Jpg,png,jfif|max:50000'
            ]);
            $image = $request->file('logo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $folderPath = 'brands/images';
            if (!file_exists($folderPath))
            {
                Storage::makeDirectory($folderPath, 077, true, true);
            }
            Storage::putFileAs($folderPath, new File($image), $imageName);
            $data['logo'] = $imageName;
//            dd($imageName);
        }

        $brand = new Brand();
        $brand->fill($data);
        $success = $brand->save();
        if ($success) {
            return redirect()->route('brands.list')->with('status', 'Brand added successfully');
        } else {
            return redirect()->route('brands.list')->with('status', 'Sorry! there is an error adding Brand');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::findorfail($id);
        return view($this->_pages . 'brand.edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate(
            [
                'title' => 'required',
                'logo' => '',
                'meta_title' => '',
                'description' => ''
            ]
        );
        if ($request->hasFile('logo')) {
            $this->validate($request, [
                'logo' => 'image|mimes:jpeg,Jpg,png,jfif|max:50000'
            ]);
            $image = $request->file('logo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $folderPath = 'brands/images';
            if (!file_exists($folderPath))
            {
                Storage::makeDirectory($folderPath, 077, true, true);
            }
            Storage::putFileAs($folderPath, new File($image), $imageName);
            $data['logo'] = $imageName;
        }
        $brand = Brand::findorfail($id);
        $logo = $brand->logo;
        $folderPath = asset('storage/brands/images/'.$brand->logo);
//        dd($folderPath);
        if($folderPath){
            Storage::deleteDirectory($folderPath);
        }
        $brand->fill($data);
        $success = $brand->save();
        if ($success) {
            return redirect()->route('brands.list')->with('status', 'Brand updated successfully');
        } else {
            return redirect()->route('brands.list')->with('status', 'Sorry! there is an error updating Brand');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::findorfail($id);
        $logo = $brand->logo;
        $folderPath = asset('storage/brands/images/'.$brand->logo);
//        dd($folderPath);
        if($folderPath){
            Storage::deleteDirectory($folderPath);
        }
        $success=$brand->delete();
        if ($success) {
            return redirect()->route('brands.list')->with('status', 'Brand deleted successfully');
        } else {
            return redirect()->route('brands.list')->with('status', 'Sorry! there is an error deleting Brand');
        }
    }
}

<?php

namespace App\Http\Controllers\Backend;
use App\Models\Contact;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends BackendController
{
    //
    public function index()
    {
        $coupons = Coupon::orderBy('created_at', 'desc')->get();
        return view($this->_pages . 'coupon.index', compact('coupons'));
    }
    public function create()
    {
       
        return view($this->_pages . 'coupon.create');
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required',
                'description' => 'required',
                'coupon_code' => 'required',
                'type' => 'required',
                'price' => 'required',
                'expiry_date'=> 'required|after:today',
            ]
        );
        $create = Coupon::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'coupon_code' => $request->coupon_code,
            'type'=>$request->type,
            'price' => $request->price,
            'expiry_date'=>$request->expiry_date,
            'status'=>$request->status
        ]);
        if($create){
            return redirect()->route('coupons.list')->with('status','Successfully Added');
        }
        return redirect()->back()->with('error','Something Went Wrong');
    }
    public function edit($id)
    {
        $coupon_edit = Coupon::findOrFail($id);
        return view($this->_pages.'coupon.create',compact('coupon_edit'));
    }
    public function update(Request $request,$id)
    {
        $request->validate(
            [
                'title' => 'required',
                'description' => 'required',
                'coupon_code' => 'required',
                'type' => 'required',
                'price' => 'required',
                'expiry_date'=> 'required|after:today',
            ]
        );
        $update = Coupon::where('id',$id)->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'coupon_code' => $request->coupon_code,
            'type'=>$request->type,
            'price' => $request->price,
            'expiry_date'=>$request->expiry_date,
            'status'=>$request->status
        ]);
        if($update){
            return redirect()->route('coupons.list')->with('status','Successfully Updated');
        }
        return redirect()->back()->with('error','Something Went Wrong');
    }
    public function delete($id)
    {
        $id=base64_decode($id);
        $delete = Coupon::where('id',$id)->delete();
        if($delete)
        {
            return redirect()->route('coupons.list')->with('status','Delete Successfully');
        }
        return redirect()->back()->with('error','Something went wrong');

    }
}

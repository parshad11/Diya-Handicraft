<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;
use App\Models\Attribute;

class AttributeController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attribute=Attribute::all();
        return view($this->_pages.'attribute.index',compact('attribute'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->_pages.'attribute.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'name'=>'required|unique:attributes'
        ]);
        $attribute=new Attribute();
        $attribute->fill($data);
        $success=$attribute->save();
        if($success){
            return redirect()->route('attributes.list')->with('status','Attribute added Successfully');
        }
        else{
            return redirect()->route('attributes.list')->with('status','sorry! There is an error adding attribute');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $attribute=Attribute::findorfail($id);
        return view($this->_pages.'attribute.edit',compact('attribute'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=$request->all();
        $attribute=Attribute::findorfail($id);
        $attribute->fill($data);
        $success=$attribute->save();
        if($success){
            return redirect()->route('attributes.list')->with('status','Attribute updated Successfully');
        }
        else{
            return redirect()->route('attributes.list')->with('status','sorry! There is an error updating attribute');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attribute=Attribute::findorfail($id);
        $success=$attribute->delete();
        if($success){
            return redirect()->route('attributes.list')->with('status','Attribute deleteed Successfully');
        }
        else{
            return redirect()->route('attributes.list')->with('status','sorry! There is an error deleting attribute');
        }

    }
}

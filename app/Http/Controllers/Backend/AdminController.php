<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Og;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class AdminController extends BackendController
{
    public function index(Request $request)
    {
        $data = Admin::orderBy('id', 'DESC')->where('id', '!=',auth()->user()->id)->get();
        $user = User::orderBy('id','DESC')->get();
        foreach($user as $item)
        {
            $data->push($item);
        }
        return view($this->_pages . 'users.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view($this->_pages . 'users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'role' => 'required'
        ]);


        $input = $request->all();

        $input['password'] = Hash::make($input['password']);
        $message = '';
        if ($input['role'] == 1) {
            $admin = new Admin();
            $admin->name = $input['name'];
            $admin->email = $input['email'];
            $admin->password = $input['password'];
            $admin->gender = 'male';
            $admin->is_admin =1;
            $admin->save();
            $message = 'Admin';
        } else {
            $user = new User();
            $user->name =$input['name'];
            $user->email = $input['email'];
            $user->password = $input['password'];
            $user->gender = 'male';
            $user->save();
            $message = 'User';
        }
        return redirect()->route('admins.list')
            ->with('status', $message . ' created successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Admin::find($id);

        return view($this->_pages . 'users.show', compact('user'));
    }
    public function userShow($id)
    {
        $user = User::find($id);

        return view($this->_pages . 'users.show', compact('user'));
    }
    public function userEdit($id)
    {
        $user = User::find($id);
        return view($this->_pages . 'users.user_edit', compact('user'));
    }
    public function userUpdate(Request $request,$id)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'role' => 'required',
            'gender'=>'required',
        ]);

        $input = $request->all();
        $user = User::findOrFail($id);
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
//            $input = Arr::except($input, ['password']);

            $input['password'] = $user['password'];
        }
        if($request->role = 0)
        {
            $user = User::find($id);
            $user->update($input);
        }
        else{
            $admin = Admin::where('email', '=', $input['email'])->first();
            if ($admin === null)
            {
                $admin = new Admin();
                $admin->name =$input['name'];
                $admin->email = $input['email'];
                $admin->password = $input['password'];
                $admin->gender = 'male';
                $admin->is_admin = 1;
                $admin->save();
                $user->delete();
            }
            else{
                $admin = Admin::find($admin->id);
                $admin->update($input);
                $user->delete();
            }
        }


        return redirect()->route('admins.list')
            ->with('status', 'User updated successfully');

    }
    public function userDestroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admins.list')
            ->with('status', 'User Deleted successfully');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Admin::find($id);
        return view($this->_pages . 'users.edit', compact('user'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'role' => 'required'
        ]);
        $admin = Admin::find($id);
        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
//            $input = Arr::except($input, ['password']);
            $input['password'] = $admin['password'];
        }
        if($request->role == 1)
        {
            $admin->update($input);
        }
        else{
            $user = User::where('email', '=', $input['email'])->first();
            if ($user === null)
            {
                $user = new User();
                $user->name =$input['name'];
                $user->email = $input['email'];
                $user->password = $input['password'];
                $user->gender = 'male';
                $user->save();
                $admin->delete();
            }
            else{
                $user = User::find($user->id);
                $user->update($input);
                $admin->delete();
            }

        }

        return redirect()->route('admins.list')
            ->with('status', 'User updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Admin::find($id)->delete();
        return redirect()->route('admins.list')
            ->with('status', 'User deleted successfully');
    }
    public function ogCreate()
    {
        $image = Og::first();
        return view($this->_pages . 'og.create',compact('image'));
    }
    public function ogStore(Request $request)
    {
        if ($request->hasFile('image')) {
            $this->validate($request, [
                'image' => 'image|mimes:jpeg,Jpg,png,jfif|max:50000'
            ]);
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $folderPath = 'public/og/' .  '/';
            $thumbPath = 'public/og/' .  '/thumbs/';
            if (!file_exists($thumbPath)) {
                Storage::makeDirectory($thumbPath, 077, true, true);
            }
            Storage::putFileAs($folderPath, new File($image), $imageName);

            Og::resize_crop_images(218, 250, $image, $thumbPath . 'thumb_' . $imageName);
            Og::resize_crop_images(433, 474, $image, $thumbPath . 'big_' . $imageName);
            Og::resize_crop_images(200, 200, $image, $thumbPath . 'small_' . $imageName);
            $fileName = $imageName;
            $user = Og::first();
            if($user == null)
            {
                Og::create([
                    'image' => $fileName,
                ]);
            }
            else
            {
                $oldImage = $user->image;
                Storage::delete($folderPath . '/' . $oldImage);
                Storage::delete($folderPath . '/thumbs/thumb_' . $oldImage);
                Storage::delete($folderPath . '/thumbs/small_' . $oldImage);
                Storage::delete($folderPath . '/thumbs/big_' . $oldImage);
                $user->update([
                    'image' => $fileName,
                ]);
            }

            return redirect()->back()->with('status','Succesfully Added');
        }

        return redirect()->back();
    }
}

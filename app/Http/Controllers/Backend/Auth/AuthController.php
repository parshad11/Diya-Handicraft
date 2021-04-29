<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends BackendController
{
    public function index()
    {
        return view($this->_pages . 'auth.login');
    }

    protected function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        $remember = False;
        if ($request->remember_me) {
            $remember = True;
        }
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            return redirect()->intended(route('admin-dashboard'));
        }
        return redirect()->route('login')->with('error', 'Invalid Username/Password.. Please try again !!');
    }

    protected function guard()
    {
        return $this->guard();
    }

    protected function logout(Request $request)
    {

        $request->session()->invalidate();

        return redirect('@dashboard@');
    }
}

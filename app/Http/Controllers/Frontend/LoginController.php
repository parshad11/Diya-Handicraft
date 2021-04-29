<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //  
    
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $crediantials = $request->except('_token');
       if(Auth::attempt($crediantials)){
           $message = "Welcome,"." ".auth()->user()->name;
           return redirect('/')->with('success_status',$message);
       }
        return redirect()->back()->with('error','Invalid Crediantials! please try again');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->back()->with('success_status','Logout Successfully');
    }
}

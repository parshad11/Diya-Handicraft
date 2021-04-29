<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontendController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends FrontendController
{

    public function __construct()
    {
        $this->middleware(['auth:web', 'verified']);
    }

    public function account()
    {
        return view($this->_pages . 'account');
    }

  
  
  
}

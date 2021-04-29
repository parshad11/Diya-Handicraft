<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends BackendController
{
    public function index()
    {
        return view($this->_pages . 'dashboard.view');
    }
}

<?php

namespace Skoro\AdminPack\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends AdminController
{

    public function index()
    {
        return view('admin::index');
    }
}
<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function getHome()
    {
        $title = 'Dashboard';

        return view('admin.pages.home')->with(compact('title'));
    }

}

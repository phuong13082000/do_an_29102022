<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;

class AdminController extends Controller
{
    public function getHome()
    {
        $title = 'Dashboard';
        $message = Comment::where('comment_parent_id', '><', 'id')->where('comment_parent_id', NULL)->count();

        return view('admin.pages.home')->with(compact('title', 'message'));
    }

}

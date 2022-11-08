<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Comment;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;

class AdminController extends Controller
{
    public function getHome()
    {
        $title = 'Dashboard';
        $count_message_db = Comment::where('admin_id', NULL)->count();
        $count_order = Order::count();
        $count_customer = Customer::count();
        $count_product = Product::where('status', 0)->where('number', '>', 2)->count();
        $count_message = Comment::where('status', 1)->where('admin_id', NULL)->count();
        $messages = Comment::with('reCustomer')->where('status', 1)->where('comment_parent_id', NULL)->get();

        return view('admin.pages.home')->with(compact('title', 'count_message', 'messages', 'count_order', 'count_customer', 'count_product', 'count_message_db'));
    }

    public function profile_admin()
    {
        $title = 'Profile';
        $count_message = Comment::where('status', 1)->where('comment_parent_id', NULL)->count();
        $messages = Comment::with('reCustomer')->where('status', 1)->where('comment_parent_id', NULL)->get();

        $admin_detail = Admin::where('name', 'Admin')->first();
        return view('admin.pages.profile')->with(compact('title', 'count_message', 'messages', 'admin_detail'));
    }

}

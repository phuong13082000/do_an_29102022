<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Comment;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

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

    public function change_password_admin(Request $request, $id)
    {
        $password_new_1 = md5($request['password_new']);
        $password_new_2 = md5($request['re_password_new']);

        $admin = Admin::find($id);
        $check_password = md5($request['password']) == $admin->password;

        if($check_password && $password_new_1 == $password_new_2){
            $admin->password = $password_new_1;
            $admin->save();
            return redirect()->back()->with('success','Change password success');
        }
        return redirect()->back()->with('error','Change password error');
    }

}

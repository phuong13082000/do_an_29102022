<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Comment;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getHome()
    {
        $title = 'Dashboard';
        $data['count_message_db'] = Comment::where('admin_id', NULL)->count();
        $data['count_order'] = Order::count();
        $data['count_customer'] = Customer::count();
        $data['count_product'] = Product::count();

        $data_order = Order::where('status', 2)->get();
        $data_orderDetail = OrderDetail::all();

        $data['count_priceShip'] = 0;
        $data['count_priceOrder'] = 0;
        foreach ($data_order as $order) {
            $data['count_priceShip'] += $order->price_ship;

            foreach ($data_orderDetail as $orderDetail) {
                if ($orderDetail->order_id == $order->id) {
                    $data['count_priceOrder'] += $orderDetail->price;

                }
            }
        }
        $data['from_month'] = Carbon::now('Asia/Ho_Chi_Minh')->month;

        $data_order = Order::where('created_at', '>=', Carbon::now('Asia/Ho_Chi_Minh')->firstOfMonth()->toDateTimeString())->where('status', 2)->get();
        $data['count_priceShip_month'] = 0;
        $data['count_priceOrder_month'] = 0;
        foreach ($data_order as $order) {
            $data['count_priceShip_month'] += $order->price_ship;

            foreach ($data_orderDetail as $orderDetail) {
                if ($orderDetail->order_id == $order->id) {
                    $data['count_priceOrder_month'] += $orderDetail->price;

                }
            }
        }

        $data['count_message'] = Comment::where('status', 1)
            ->where('comment_parent_id', NULL)->count();

        $messages = Comment::with('reCustomer')
            ->where('status', 1)
            ->where('comment_parent_id', NULL)->get();

        return view('admin.pages.home', $data)
            ->with(compact('title', 'messages'));
    }

    public function profile_admin()
    {
        $title = 'Profile';
        $count_message = Comment::where('status', 1)
            ->where('comment_parent_id', NULL)->count();

        $messages = Comment::with('reCustomer')
            ->where('status', 1)
            ->where('comment_parent_id', NULL)->get();

        $admin_detail = Admin::where('name', 'Admin')->first();
        return view('admin.pages.profile')->with(compact('title', 'count_message', 'messages', 'admin_detail'));
    }

    public function change_password_admin(Request $request, $id)
    {
        $password_new_1 = md5($request['password_new']);
        $password_new_2 = md5($request['re_password_new']);

        $admin = Admin::find($id);
        $check_password = md5($request['password']) == $admin->password;

        if ($check_password && $password_new_1 == $password_new_2) {
            $admin->password = $password_new_1;
            $admin->save();
            return redirect()->back()->with('success', 'Đổi mật khẩu thành công');
        }
        return redirect()->back()->with('error', 'Đổi mật khẩu không thành công');
    }

}

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Comment;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class CustomerController extends Controller
{
    //admin
    public function show_customer()
    {
        $title = 'Customer';

        $count_message = Comment::where('status', 1)
            ->where('comment_parent_id', NULL)->count();

        $messages = Comment::with('reCustomer')
            ->where('status', 1)
            ->where('comment_parent_id', NULL)->get();

        $listCustomer = Customer::all();

        return view('admin.pages.customer.index')->with(compact('title', 'listCustomer', 'count_message', 'messages'));
    }

    //user
    public function login_facebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function login_google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function dangnhap()
    {
        $title = 'Login';
        $list_brand = Brand::where('status', 0)->take(5)->get();

        return view('frontend.pages.login')->with(compact('title', 'list_brand'));
    }

    public function dangki()
    {
        $title = 'Register';
        $list_brand = Brand::where('status', 0)->take(5)->get();

        return view('frontend.pages.register')->with(compact('title', 'list_brand'));
    }

    public function profile()
    {
        $title = 'Profile';
        $list_brand = Brand::where('status', 0)->take(5)->get();

        $customer = Customer::find(Session::get('id'));

        $history_orders_status1 = Order::where('customer_id', Session::get('id'))->where('status', 1)->orderBy('created_at', 'DESC')->get();
        $history_orders_status2 = Order::where('customer_id', Session::get('id'))->where('status', 2)->orderBy('created_at', 'DESC')->get();
        $history_orders_status3 = Order::where('customer_id', Session::get('id'))->where('status', 3)->orderBy('created_at', 'DESC')->get();

        return view('frontend.pages.profile')->with(compact('title', 'list_brand', 'customer', 'history_orders_status1', 'history_orders_status2', 'history_orders_status3'));
    }

    public function profile_order_detail(Request $request)
    {
        $order = Order::where('id', $request['order_id'])->first();
        $order_details = OrderDetail::with('reProduct')->where('order_id', $request['order_id'])->get();

        $output = '
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">Thông tin vận chuyển hàng</div>
                <div class="table-responsive">
                    <table class="table table-striped b-t b-light">
                        <thead>
                        <tr>
                            <th>Tên người nhận</th>
                            <th>Địa chỉ</th>
                            <th>Số điện thoại</th>
                            <th>Ghi chú</th>
                            <th>Phí ship</th>
                            <th>Hình thức thanh toán</th>
                            <th style="width:30px;"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>' . $order->name_nguoinhan . '</td>
                            <td>' . $order->address_nguoinhan . '</td>
                            <td>' . $order->phone_nguoinhan . '</td>
                            <td>' . $order->note . '</td>
                            <td>' . number_format($order->price_ship, 0, ',', ' . ') . 'đ</td>
                            <td>' . $order->payment_method . '</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br><br>

        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">Liệt kê chi tiết đơn hàng</div>
                <div class="table-responsive">
                    <table class="table table-striped b-t b-light">
                        <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng kho còn</th>
                            <th>Số lượng</th>
                            <th>Giá sản phẩm</th>
                            <th>Tổng tiền</th>
                            <th style="width:30px;"></th>
                        </tr>
                        </thead>
                        <tbody>';

        $total = 0;
        foreach ($order_details as $order_detail) {
            $subtotal = $order_detail->price * $order_detail->number;
            $total += $subtotal;

            $output .= '
                    <tr>
                        <td>' . $order_detail->reProduct->title . '</td>
                        <td>' . $order_detail->reProduct->number . '</td>
                        <td>' . $order_detail->number . '</td>
                        <td>' . number_format($order_detail->price, 0, ',', ' . ') . 'đ</td>
                        <td>' . number_format($subtotal + $order->price_ship, 0, ',', ' . ') . 'đ</td>
                    </tr>';
        }
        $output .= '
                    <tr>
                        <td colspan="2">';

        $output .= '
                            Tổng : ' . number_format($total, 0, ',', ' . ') . 'đ <br>
                            Phí ship : ' . number_format($order->price_ship, 0, ',', ' . ') . 'đ <br>
                            Thanh toán: ' . number_format($total + $order->price_ship, 0, ',', ' . ') . 'đ
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
        ';
        echo $output;
    }

    public function cancel_order(Request $request)
    {
        $order = Order::where('id', $request['order_id'])->first();
        $order_details = OrderDetail::with('reProduct')->where('order_id', $request['order_id'])->get();
        $status = $order->status;

        switch ($status) {
            case 1:
                $order->status = 3;
                $order->save();

                foreach ($order_details as $order_detail) {
                    $id_product = $order_detail->product_id;
                    $product = Product::find($id_product);
                    $product->number = $product->number + $order_detail->number;
                    $product->save();
                }
                echo 'Đơn hàng đã hủy';
                break;
            case 2:
                echo 'Đơn hàng đang được giao, liên hệ với quản trị viên để hủy';
                break;

            default:
                echo 'Đơn hàng đã hủy';
                break;

        }
    }

    public function change_password_user(Request $request)
    {
        $password_new_1 = $request['password_new'];
        $password_new_2 = $request['re_password_new'];

        $customer = Customer::find(Session::get('id'));
        $check_password = Hash::check($request['password'], $customer->password ?? '');

        if ($check_password && $password_new_1 == $password_new_2) {
            $customer->password = Hash::make($password_new_1);
            $customer->save();
            return redirect()->back()->with('success', 'Đổi mật khẩu thành công');
        }
        return redirect()->back()->with('error', 'Đổi mật khẩu không thành công');
    }

    public function update_profile(Request $request)
    {
        $validated = Validator::make($request->all(), ['name' => ['max:255'], 'phone' => ['max:10'], 'address' => ['string', 'max:255'],]);
        if ($validated->fails()) {
            return redirect()->back()->with('error', 'Cập nhật thông tin cá nhân không thành công');
        }

        $customer = Customer::find(Session::get('id'));
        $customer->fullname = $request['name'];
        $customer->phone = $request['phone'];
        $customer->email = $request['email'];
        $customer->address = $request['address'];
        $customer->save();

        $user = Customer::where('email', $request['email'])->first();

        Session::put('id', $user->id);
        Session::put('name', $user->fullname);
        Session::put('email', $user->email);
        Session::put('phone', $user->phone);
        Session::put('address', $user->address);

        return redirect()->back()->with('success', 'Cập nhật thông tin cá nhân thành công');
    }

    public function login_customer(Request $request)
    {
        $customer = Customer::where('email', $request['email_login'])->first();
        $check_password = Hash::check($request['password_login'], $customer->password ?? '');

        if ($customer && $check_password) {
            Session::put('id', $customer->id);
            Session::put('name', $customer->fullname);
            Session::put('email', $customer->email);
            Session::put('address', $customer->address);
            Session::put('phone', $customer->phone);
            return redirect('/')->with('success', 'Đăng nhập thành công');
        } else {
            return redirect('/dang-nhap')->with('error', 'Đăng nhập không thành công');
        }
    }

    public function add_customer(Request $request)
    {
        $customer = new Customer();
        $customer->fullname = $request['fullname'] ?? NULL;
        $customer->phone = $request['phone'] ?? NULL;
        $customer->email = $request['email'] ?? NULL;
        $customer->address = $request['address'] ?? NULL;
        $customer->password = Hash::make($request['password']);
        $customer->save();

        $user = Customer::where('email', $request['email'])->first();

        Session::put('id', $user->id);
        Session::put('name', $user->fullname);
        Session::put('email', $user->email);
        Session::put('phone', $user->phone);
        Session::put('address', $user->phone);

        return redirect('/')->with('success', 'Đăng kí thành công');
    }

    public function logout()
    {
        Session::forget('id');
        Session::forget('name');
        Session::forget('email');
        Session::forget('phone');
        Session::forget('address');
        return redirect('/');
    }

    public function callback_facebook()
    {
        $provider = Socialite::driver('facebook')->user();

        $account_before = Customer::where('provider', 'facebook')
            ->where('facebook_id', $provider->getId())->first();

        if (!$account_before) {
            Customer::create([
                'fullname' => $provider->name,
                'email' => $provider->email,
                'provider' => 'facebook',
                'facebook_id' => $provider->id
            ]);
        }
        $account_after = Customer::where('provider', 'facebook')
            ->where('facebook_id', $provider->getId())->first();

        $account_name = Customer::where('facebook_id', $account_after->facebook_id)
            ->first();

        Session::put('id', $account_name->id);
        Session::put('name', $account_name->fullname);
        return redirect('/')->with('success', 'Đăng nhập thành công');
    }

    public function callback_google()
    {
        $provider = Socialite::driver('google')->stateless()->user();

        $account_before = Customer::where('provider', 'google')
            ->where('google_id', $provider->getId())->first();

        if (!$account_before) {
            Customer::create([
                'fullname' => $provider->name,
                'email' => $provider->email,
                'provider' => 'google',
                'google_id' => $provider->id
            ]);
        }
        $account_after = Customer::where('provider', 'google')
            ->where('google_id', $provider->getId())->first();

        $account_name = Customer::where('google_id', $account_after->google_id)->first();

        Session::put('id', $account_name->id);
        Session::put('name', $account_name->fullname);
        return redirect('/')->with('success', 'Đăng nhập thành công');
    }

}

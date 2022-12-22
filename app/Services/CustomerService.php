<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CustomerService
{
    public function orderProfileDetail($request)
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
        foreach($order_details as $order_detail) {
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

    public function cancelOrderUser($request)
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

    public function changePasswordUser($request, $id)
    {
        $password_new_1 = $request['password_new'];
        $password_new_2 = $request['re_password_new'];

        $customer = Customer::find($id);
        $check_password = Hash::check($request['password'], $customer->password ?? '');

        if ($check_password && $password_new_1 == $password_new_2) {
            $customer->password = Hash::make($password_new_1);
            $customer->save();
            return true;
        }
        return false;
    }

    public function updateProfile($request, $id)
    {
        $validated = Validator::make($request->all(), ['name' => ['max:255'], 'phone' => ['max:10'], 'address' => ['string', 'max:255'],]);
        if ($validated->fails()) {
            return false;
        }

        $customer = Customer::find($id);
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
        return true;
    }

    public function loginCustomer($request)
    {
        $customer = Customer::where('email', $request['email_login'])->first();
        $check_password = Hash::check($request['password_login'], $customer->password ?? '');

        if ($customer && $check_password) {
            Session::put('id', $customer->id);
            Session::put('name', $customer->fullname);
            Session::put('email', $customer->email);
            Session::put('address', $customer->address);
            Session::put('phone', $customer->phone);
            return true;
        } else {
            return false;
        }
    }

    public function createCustomer($request)
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
    }
}

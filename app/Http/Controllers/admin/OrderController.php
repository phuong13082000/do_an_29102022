<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class OrderController extends Controller
{
    public function view_order()
    {
        $title = 'Order';
        $orders = Order::with('reCustomer')->orderBy('created_at', 'DESC')->get();

        return view('admin.pages.order.index')->with(compact('title', 'orders'));
    }

    public function view_order_detail($id)
    {
        $title = 'Order Detail';
        $order_details = OrderDetail::with('reProduct')->where('order_id', $id)->get();

        $order = Order::where('id', $id)->first();

        $customer_id = $order->customer_id;
        $order_status = $order->status;

        $customer = Customer::where('id', $customer_id)->first();

        return view('admin.pages.order.show')->with(compact('order_details', 'customer', 'order_details', 'order_status', 'order', 'title'));
    }

    public function update_status_order(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        $status = $data['status'];

        $order = Order::find($id);
        if ($status > $order->status) {
            $order->status = $status;
            $order->save();
            $msg = "Thanh cong";
        } elseif ($status < $order->status || $status == '') {
            $msg = "That bai";
        }
        return response()->json(array('msg' => $msg), 200);
    }

    public function print_order($id)
    {
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($id));
        return $pdf->stream();
    }

    public function print_order_convert($id)
    {
        $order = Order::where('id', $id)->first();
        $customer_id = $order->customer_id;

        $customer = Customer::where('id', $customer_id)->first();

        $order_details = OrderDetail::with('reProduct')->where('order_id', $id)->get();

        $output = '
        <style>
            body{
                font-family: DejaVu Sans, serif;
            }
            .table-styling{
                border:1px solid #000;
            }
            .table-styling tbody tr td{
                border:1px solid #000;
            }
		</style>
		<h1><center>Hoá đơn</center></h1>
		<p>Người đặt</p>
		<table class="table-styling">
            <thead>
                <tr>
                    <th>Tên khách đặt</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>' . $customer->fullname . '</td>
                    <td>' . $customer->phone . '</td>
                    <td>' . $customer->address . '</td>
                </tr>
            </tbody>
		</table>

		<p>Ship hàng tới</p>
			<table class="table-styling">
				<thead>
					<tr>
						<th>Tên người nhận</th>
						<th>Địa chỉ</th>
						<th>Sdt</th>
						<th>Ghi chú</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>' . $order->name_nguoinhan . '</td>
						<td>' . $order->address_nguoinhan . '</td>
						<td>' . $order->phone_nguoinhan . '</td>
						<td>' . $order->notes . '</td>
					</tr>
				</tbody>
		    </table>

		<p>Đơn hàng đặt</p>
			<table class="table-styling">
				<thead>
					<tr>
						<th>Tên sản phẩm</th>
						<th>Số lượng</th>
						<th>Giá sản phẩm</th>
						<th>Thành tiền</th>
					</tr>
				</thead>
				<tbody>';

        $total = 0;
        foreach ($order_details as $product) {
            $subtotal = $product->price * $product->num;
            $total += $subtotal;

            $output .= '
					<tr>
						<td>' . $product->reProduct->title . '</td>
						<td>' . $product->num . '</td>
						<td>' . number_format($product->price, 0, ',', '.') . 'đ' . '</td>
						<td>' . number_format($subtotal, 0, ',', '.') . 'đ' . '</td>
                    </tr>';
        }
        $output .= '
					<tr>
                        <td colspan="2">
                            <p>Phí ship: 50,000 đ</p>
                            <p>Thanh toán : ' . number_format($total + 50000, 0, ',', '.') . 'đ' . '</p>
                        </td>
		            </tr>
				</tbody>
		    </table>

		    <p>Ký tên</p>
			<table>
				<thead>
					<tr>
						<th width="200px">Người lập phiếu</th>
						<th width="800px">Người nhận</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
		</table>
		';
        return $output;
    }
}

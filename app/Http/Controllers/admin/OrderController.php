<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class OrderController extends Controller
{
    public function view_order()
    {
        $title = 'Order';
        $count_message = Comment::where('status', 1)
            ->where('comment_parent_id', NULL)->count();

        $messages = Comment::with('reCustomer')
            ->where('status', 1)
            ->where('comment_parent_id', NULL)->get();

        $orders_chuaXuLy = Order::with('reCustomer')
            ->where('status',1)->orderBy('created_at', 'DESC')->get();
        $orders_XuLy = Order::with('reCustomer')
            ->where('status',2)->orderBy('created_at', 'DESC')->get();
        $orders_huy = Order::with('reCustomer')
            ->where('status',3)->orderBy('created_at', 'DESC')->get();

        return view('admin.pages.order.index')->with(compact('title', 'orders_chuaXuLy', 'orders_XuLy', 'orders_huy', 'count_message', 'messages'));
    }

    public function view_order_detail($id)
    {
        $title = 'Order Detail';
        $count_message = Comment::where('status', 1)
            ->where('comment_parent_id', NULL)->count();

        $messages = Comment::with('reCustomer')
            ->where('status', 1)
            ->where('comment_parent_id', NULL)->get();

        $order_details = OrderDetail::with('reProduct')
            ->where('order_id', $id)->get();

        $order = Order::find($id);
        $customer_id = $order->customer_id;
        $order_status = $order->status;

        $customer = Customer::find($customer_id);

        return view('admin.pages.order.show')->with(compact('order_details', 'customer', 'order_details', 'order_status', 'order', 'title', 'count_message', 'messages'));
    }

    public function update_status_order(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        $status = $data['status'];
        $order = Order::find($id);
        $order_details = OrderDetail::with('reProduct')
            ->where('order_id', $id)
            ->get();

        if ($order->status == 1 && $status == 2) {
            $order->status = $status;
            $order->save();
            return response()->json(['message' => 'Cập nhật thành công.']);

        } elseif ($order->status == 2 && $status == 3) {
            $order->status = $status;
            $order->save();

            foreach ($order_details as $order_detail) {
                $id_product = $order_detail->product_id;
                $product = Product::find($id_product);
                $product->number = $product->number + $order_detail->number;
                $product->save();
            }
            return response()->json(['message' => 'Cập nhật thành công.']);

        } elseif ($order->status == 1 && $status == 3) {
            $order->status = $status;
            $order->save();

            foreach ($order_details as $order_detail) {
                $id_product = $order_detail->product_id;
                $product = Product::find($id_product);
                $product->number = $product->number + $order_detail->number;
                $product->save();
            }
            return response()->json(['message' => 'Cập nhật thành công.']);
        } else {
            return response()->json(['message' => 'Cập nhật thất bại.']);
        }
    }

    public function print_order($id)
    {
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($this->printOrderConvert($id));
        return $pdf->stream();
    }

    public function printOrderConvert($id)
    {
        $order = Order::find($id);
        $customer_id = $order->customer_id;

        $customer = Customer::find($customer_id);
        $order_details = OrderDetail::with('reProduct')
            ->where('order_id', $id)
            ->get();

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
                    <th>Địa chỉ</th>
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
						<td>' . $order->note . '</td>
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
            $subtotal = $product->price * $product->number;
            $total += $subtotal;

            $output .= '
					<tr>
						<td>' . $product->reProduct->title . '</td>
						<td>' . $product->number . '</td>
						<td>' . number_format($product->price, 0, ',', '.') . 'đ' . '</td>
						<td>' . number_format($subtotal, 0, ',', '.') . 'đ' . '</td>
                    </tr>';
        }
        $output .= '
					<tr>
                        <td colspan="4">
                            <p>Phí ship: ' . number_format($order->price_ship, 0, ',', '.') . 'đ' . '</p>
                            <p>Thanh toán : ' . number_format($total + $order->price_ship, 0, ',', '.') . 'đ' . '</p>
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

<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;

class OrderService
{
    public function updateStatusOrder($request)
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
            return true;

        } elseif ($order->status == 2 && $status == 3) {
            $order->status = $status;
            $order->save();

            foreach ($order_details as $order_detail) {
                $id_product = $order_detail->product_id;
                $product = Product::find($id_product);
                $product->number = $product->number + $order_detail->number;
                $product->save();
            }
            return true;

        }elseif ($order->status == 1 && $status == 3) {
            $order->status = $status;
            $order->save();

            foreach ($order_details as $order_detail) {
                $id_product = $order_detail->product_id;
                $product = Product::find($id_product);
                $product->number = $product->number + $order_detail->number;
                $product->save();
            }
            return true;
        } else {
            return false;
        }
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
		<h1><center>Ho?? ????n</center></h1>
		<p>Ng?????i ?????t</p>
		<table class="table-styling">
            <thead>
                <tr>
                    <th>T??n kh??ch ?????t</th>
                    <th>S??? ??i???n tho???i</th>
                    <th>?????a ch???</th>
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

		<p>Ship h??ng t???i</p>
			<table class="table-styling">
				<thead>
					<tr>
						<th>T??n ng?????i nh???n</th>
						<th>?????a ch???</th>
						<th>Sdt</th>
						<th>Ghi ch??</th>
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

		<p>????n h??ng ?????t</p>
			<table class="table-styling">
				<thead>
					<tr>
						<th>T??n s???n ph???m</th>
						<th>S??? l?????ng</th>
						<th>Gi?? s???n ph???m</th>
						<th>Th??nh ti???n</th>
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
						<td>' . number_format($product->price, 0, ',', '.') . '??' . '</td>
						<td>' . number_format($subtotal, 0, ',', '.') . '??' . '</td>
                    </tr>';
        }
        $output .= '
					<tr>
                        <td colspan="4">
                            <p>Ph?? ship: ' . number_format($order->price_ship, 0, ',', '.') . '??' . '</p>
                            <p>Thanh to??n : ' . number_format($total + $order->price_ship, 0, ',', '.') . '??' . '</p>
                        </td>
		            </tr>
				</tbody>
		    </table>

		    <p>K?? t??n</p>
			<table>
				<thead>
					<tr>
						<th width="200px">Ng?????i l???p phi???u</th>
						<th width="800px">Ng?????i nh???n</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
		</table>
		';
        return $output;
    }
}

<?php

namespace App\Services;

use App\Repositories\CustomerRepository;
use App\Repositories\OrderDetailRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class OrderService
{
    public function __construct(
        OrderRepository       $orderRepository,
        CustomerRepository    $customerRepository,
        OrderDetailRepository $orderDetailRepository,
        ProductRepository     $productRepository,
    )
    {
        $this->orderRepository = $orderRepository;
        $this->customerRepository = $customerRepository;
        $this->orderDetailRepository = $orderDetailRepository;
        $this->productRepository = $productRepository;
    }

    public function updateStatusOrder(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        $status = $data['status'];
        $order = $this->orderRepository->findID($id);
        $order_details = $this->orderDetailRepository->getOrderDetailWithProduct($id);
        if ($order->status == 1 && $status == 2) {
            $order->status = $status;
            $order->save();
            return true;
        } elseif ($order->status == 2 && $status == 3) {
            $order->status = $status;
            $order->save();

            foreach ($order_details as $order_detail) {
                $id_product = $order_detail->product_id;
                $product = $this->productRepository->findID($id_product);
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
        $order = $this->orderRepository->findID($id);
        $customer_id = $order->customer_id;

        $customer = $this->customerRepository->findID($customer_id);
        $order_details = $this->orderDetailRepository->getOrderDetailWithProduct($id);

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

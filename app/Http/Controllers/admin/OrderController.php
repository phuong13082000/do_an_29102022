<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function view_order()
    {
        $title = 'Order';
        $count_message = Comment::where('status', 1)
            ->where('comment_parent_id', NULL)->count();

        $messages = Comment::with('reCustomer')
            ->where('status', 1)
            ->where('comment_parent_id', NULL)->get();

        $orders_chuaXuLy = Order::with('reCustomer')->where('status',1)->orderBy('created_at', 'DESC')->get();
        $orders_XuLy = Order::with('reCustomer')->where('status',2)->orderBy('created_at', 'DESC')->get();
        $orders_huy = Order::with('reCustomer')->where('status',3)->orderBy('created_at', 'DESC')->get();

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
        $update = $this->orderService->updateStatusOrder($request);
        if ($update) {
            return response()->json(['message' => 'C???p nh???t th??nh c??ng.']);
        } else {
            return response()->json(['message' => 'C???p nh???t th???t b???i.']);
        }
    }

    public function print_order($id)
    {
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($this->orderService->printOrderConvert($id));
        return $pdf->stream();
    }

}

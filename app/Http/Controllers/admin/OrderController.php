<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Repositories\CommentRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\OrderDetailRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class OrderController extends Controller
{
    protected $commentRepository, $orderService, $orderRepository, $orderDetailRepository, $customerRepository;

    public function __construct(
        CommentRepository     $commentRepository,
        OrderRepository       $orderRepository,
        OrderService          $orderService,
        OrderDetailRepository $orderDetailRepository,
        CustomerRepository    $customerRepository,
    )
    {
        $this->commentRepository = $commentRepository;
        $this->orderRepository = $orderRepository;
        $this->orderService = $orderService;
        $this->orderDetailRepository = $orderDetailRepository;
        $this->customerRepository = $customerRepository;
    }

    public function view_order()
    {
        $title = 'Order';
        $count_message = $this->commentRepository->countComment();
        $messages = $this->commentRepository->getMessage();

        $orders = $this->orderRepository->getOrderWithCustomer();

        return view('admin.pages.order.index')->with(compact('title', 'orders', 'count_message', 'messages'));
    }

    public function view_order_detail($id)
    {
        $title = 'Order Detail';
        $count_message = $this->commentRepository->countComment();
        $messages = $this->commentRepository->getMessage();

        $order_details = $this->orderDetailRepository->getOrderDetailWithProduct($id);

        $order = $this->orderRepository->findID($id);
        $customer_id = $order->customer_id;
        $order_status = $order->status;

        $customer = $this->customerRepository->findID($customer_id);

        return view('admin.pages.order.show')->with(compact('order_details', 'customer', 'order_details', 'order_status', 'order', 'title', 'count_message', 'messages'));
    }

    public function update_status_order(Request $request)
    {
        $update = $this->orderService->updateStatusOrder($request);
        if ($update) {
            return response()->json(['message' => 'Cập nhật thành công.']);
        } else {
            return response()->json(['message' => 'Cập nhật thất bại.']);
        }
    }

    public function print_order($id)
    {
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($this->orderService->printOrderConvert($id));
        return $pdf->stream();
    }

}

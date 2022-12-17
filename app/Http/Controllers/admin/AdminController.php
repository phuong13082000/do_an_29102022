<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Repositories\CommentRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\OrderDetailRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $commentRepository, $productRepository, $orderRepository, $orderDetailRepository, $customerRepository;

    public function __construct(
        CommentRepository     $commentRepository,
        ProductRepository     $productRepository,
        OrderDetailRepository $orderDetailRepository,
        OrderRepository       $orderRepository,
        CustomerRepository    $customerRepository
    )
    {
        $this->commentRepository = $commentRepository;
        $this->productRepository = $productRepository;
        $this->orderDetailRepository = $orderDetailRepository;
        $this->orderRepository = $orderRepository;
        $this->customerRepository = $customerRepository;
    }

    public function getHome()
    {
        $title = 'Dashboard';
        $count_message_db = $this->commentRepository->countCommentAdmin();
        $count_order = $this->orderRepository->countOrder();
        $count_customer = $this->customerRepository->countCustomer();
        $count_product = $this->productRepository->countProduct();

        $data_order = $this->orderRepository->findOrderStatus2();
        $data_orderDetail = $this->orderDetailRepository->getAll();
        $count_priceShip = 0;
        $count_priceOrder = 0;
        foreach ($data_order as $order) {
            $count_priceShip += $order->price_ship;

            foreach ($data_orderDetail as $orderDetail) {
                if ($orderDetail->order_id == $order->id) {
                    $count_priceOrder += $orderDetail->price;

                }
            }
        }

        $count_message = $this->commentRepository->countComment();
        $messages = $this->commentRepository->getMessage();

        return view('admin.pages.home')
            ->with(compact('count_priceOrder', 'count_priceShip', 'title', 'count_message', 'messages', 'count_order', 'count_customer', 'count_product', 'count_message_db'));
    }

    public function profile_admin()
    {
        $title = 'Profile';
        $count_message = $this->commentRepository->countComment();
        $messages = $this->commentRepository->getMessage();

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

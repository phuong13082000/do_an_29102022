<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository
{
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function getAll()
    {
        return Order::all();
    }

    public function findID($id)
    {
        return Order::find($id);
    }

    public function findIDWhereCustomerId($id)
    {
        return Order::where('customer_id', $id)
            ->where('status', 1)
            ->where('payment_method', 'Trả bằng thẻ ngân hàng')
            ->orderBy('created_at', 'DESC')
            ->first();
    }

    public function getOrderWithCustomer()
    {
        return Order::with('reCustomer')
            ->orderBy('created_at', 'DESC')
            ->get();
    }
}

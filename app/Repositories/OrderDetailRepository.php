<?php

namespace App\Repositories;

use App\Models\OrderDetail;

class OrderDetailRepository
{
    protected $orderDetail;

    public function __construct(OrderDetail $orderDetail)
    {
        $this->orderDetail = $orderDetail;
    }

    public function getAll()
    {
        return OrderDetail::all();
    }

    public function findID($id)
    {
        return OrderDetail::find($id);
    }

    public function getOrderDetailWithProduct($orderId)
    {
        return OrderDetail::with('reProduct')->where('order_id', $orderId)->get();
    }
}

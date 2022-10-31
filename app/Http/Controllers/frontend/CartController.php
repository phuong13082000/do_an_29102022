<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function show_cart()
    {
        $title = 'Cart';
        $list_brand = Brand::take(5)->get();

        return view('frontend.pages.cart')->with(compact('title', 'list_brand'));
    }

    public function save_cart(Request $request)
    {
        $title = 'Cart';
        $list_brand = Brand::take(5)->get();

        $sanpham_id = $request->productid_hidden;
        $chitiet_sanpham = Product::where('id', $sanpham_id)->first();
        $soluong = $request->qty;

        $data['id'] = $sanpham_id;
        $data['qty'] = $soluong; //số lượng chọn
        $data['name'] = $chitiet_sanpham->title;
        $data['price'] = $chitiet_sanpham->price_sale ?: $chitiet_sanpham->price;
        $data['weight'] = $chitiet_sanpham->number; //soluong tổng
        $data['options']['image'] = $chitiet_sanpham->image;

        Cart::add($data);

        return view('frontend.pages.cart')->with(compact('title', 'list_brand'));
    }

    public function delete_to_cart($rowId)
    {
        Cart::update($rowId, 0);

        return redirect('/show-cart');
    }

    public function update_cart_quantity(Request $request)
    {
        $rowId = $request->rowId_cart;
        $qty = $request->cart_quantity;

        Cart::update($rowId, $qty);

        return redirect('/show-cart');
    }

    public function confirm_order(Request $request)
    {
        $data = $request->all();
        $order_id = substr(md5(microtime()), rand(0, 26), 5);

        //order
        $order = new Order();
        $order->id = $order_id;
        $order->price_ship = '';
        $order->note = $data['note'] ?? '';
        $order->status = 1;
        $order->payment_method = $data['payment_method'];
        $order->customer_id = Session::get('id');

        $order->name_nguoinhan = $data['name_nguoinhan'] ?? '';
        $order->phone_nguoinhan = $data['name_nguoinhan'] ?? '';
        $order->address_nguoinhan = $data['address_nguoinhan'] ?? '';

        $order->save();

        //order_details
        $content = Cart::content();

        foreach ($content as $cart) {
            $order_details = new OrderDetail();
            $order_details->num = $cart->qty;
            $order_details->price = $cart->price;
            $order_details->status = 1;
            $order_details->order_id = $order_id;
            $order_details->product_id = $cart->id;

            $order_details->save();
        }

        Cart::destroy();
        return redirect('/');
    }
}

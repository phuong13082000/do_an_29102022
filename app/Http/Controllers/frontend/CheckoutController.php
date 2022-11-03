<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Order;
use App\Models\OrderDetail;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $title = 'Checkout';
        $list_brand = Brand::take(5)->get();

        return view('frontend.pages.checkout')->with(compact('title', 'list_brand'));
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

        $order->name_nguoinhan = $data['name_nguoinhan'];
        $order->phone_nguoinhan = $data['name_nguoinhan'];
        $order->address_nguoinhan = $data['address_nguoinhan'];

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
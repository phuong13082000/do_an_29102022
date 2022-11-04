<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
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

    public function data_province(Request $request)
    {
        $data = $request->all();
        $output = '<option selected >Thành Phố</option>';
        for ($i = 0; $i < $data['length_province']; $i++) {
            $output .= '
            <option id="id_province" value="' . $data['data_province'][$i]['ProvinceID'] . '">
            ' . $data['data_province'][$i]['ProvinceName'] . '
            </option>
            ';
        }
        echo $output;
    }

    public function data_district(Request $request)
    {
        $data = $request->all();
        $output = '<option selected >Quận Huyện</option>';
        for ($i = 0; $i < $data['length_district']; $i++) {
            $output .= '
            <option id="id_district" value="' . $data['data_district'][$i]['DistrictID'] . '">
            ' . $data['data_district'][$i]['DistrictName'] . '
            </option>
            ';
        }
        echo $output;
    }

    public function data_ward(Request $request)
    {
        $data = $request->all();
        $output = '<option selected >Phường Xã</option>';
        for ($i = 0; $i < $data['length_ward']; $i++) {
            $output .= '
            <option id="id_ward" value="' . $data['data_ward'][$i]['WardCode'] . '">
            ' . $data['data_ward'][$i]['WardName'] . '
            </option>
            ';
        }
        echo $output;
    }

    public function confirm_order(Request $request)
    {
        $data = $request->all();
        $order_id = substr(md5(microtime()), rand(0, 26), 5);
        $address = $data['name_province'].'-'.$data['name_district'].'-'.$data['name_ward'];

        //order
        $order = new Order();
        $order->id = $order_id;
        $order->price_ship = $data['price_ship'] ?? '';
        $order->note = $data['note'] ?? '';
        $order->status = 1;
        $order->payment_method = $data['payment_method'];
        $order->customer_id = Session::get('id');

        $order->name_nguoinhan = $data['name_nguoinhan'] ?? Session::get('phone');
        $order->phone_nguoinhan = $data['phone_nguoinhan'] ?? Session::get('name');
        $order->address_nguoinhan = $address ?? Session::get('address');

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

            $product = Product::find($cart->id);
            $product->number = $product->number-$cart->qty;
            $product->save();
        }

        Cart::destroy();
    }
}

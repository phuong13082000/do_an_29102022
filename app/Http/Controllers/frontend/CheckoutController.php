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
        $province = '<option selected >Thành Phố</option>';
        // 64 tinh thanh
        for ($i = 0; $i < 63; $i++) {
            $province .= '<option id="id_province_' . $request['data_province'][$i]['ProvinceID'] . '" value="' . $request['data_province'][$i]['ProvinceID'] . '">
            ' . $request['data_province'][$i]['ProvinceName'] . '</option>';
        }
        echo $province;
    }

    public function data_district(Request $request)
    {
        $length = $request['length_district'];

        $district = '<option selected >Quận Huyện</option>';
        for ($i = 0; $i < $length; $i++) {
            $district .= '<option id="id_district_' . $request['data_district'][$i]['DistrictID'] . '" value="' . $request['data_district'][$i]['DistrictID'] . '">
            ' . $request['data_district'][$i]['DistrictName'] . '</option>';
        }
        echo $district;
    }

    public function data_ward(Request $request)
    {
        $length = $request['length_ward'];

        $ward = '<option selected >Phường Xã</option>';
        for ($i = 0; $i < $length; $i++) {
            $ward .= '<option id="id_ward_' . $request['data_ward'][$i]['WardCode'] . '" value="' . $request['data_ward'][$i]['WardCode'] . '">
            ' . $request['data_ward'][$i]['WardName'] . '</option>';
        }
        echo $ward;
    }

    public function confirm_order(Request $request)
    {
        $data = $request->all();
        $order_id = substr(md5(microtime()), rand(0, 26), 5);

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
        $order->address_nguoinhan = $data['name_address'] ?? Session::get('address') ?? '';

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

            //tru san pham
            $product = Product::find($cart->id);
            $product->number = $product->number-$cart->qty;
            $product->save();
        }

        Cart::destroy();
    }
}

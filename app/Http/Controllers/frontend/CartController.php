<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\BrandRepository;
use Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $brandRepository;

    public function __construct(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function show_cart()
    {
        $title = 'Giỏ hàng';
        $list_brand = $this->brandRepository->getListBrandIndex();
        return view('frontend.pages.cart')->with(compact('title', 'list_brand'));
    }

    public function save_cart(Request $request)
    {
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

        return redirect()->back();
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

}

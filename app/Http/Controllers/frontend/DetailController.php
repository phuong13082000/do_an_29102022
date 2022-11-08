<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Gallery;
use App\Models\Product;

class DetailController extends Controller
{
    public function index($id)
    {
        $product = Product::find($id);
        $title = $product->title;
        $list_brand = Brand::take(5)->get();
        $list_recommend = Product::where('brand_id', '=', $product->brand_id)->get();
        $list_gallery = Gallery::where('product_id', $id)->get();

        return view('frontend.pages.detail')->with(compact('title', 'list_brand', 'product', 'list_recommend', 'list_gallery'));
    }


}

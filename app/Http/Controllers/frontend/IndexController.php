<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;

class IndexController extends Controller
{
    public function index()
    {
        $title = 'HomePage';
        $list_brand = Brand::take(5)->get();
        $list_category = Category::all();
        $list_product_new = Product::orderBy('created_at', 'DESC')->take(4)->get();
        $list_product_sale = Product::where('price_sale', '!=', '0')->orderBy('price_sale', 'ASC')->take(4)->get();
        $list_recommend = Product::orderBy('updated_at', 'DESC')->get();

        $first_slider = Slider::orderBy('id', 'ASC')->first();
        $list_slider = Slider::where('id', '>', $first_slider->id)->take(2)->get();

        return view('frontend.pages.index')
            ->with(compact('title', 'list_brand', 'list_product_new', 'list_product_sale', 'list_slider', 'first_slider', 'list_recommend', 'list_category'));
    }

    public function brand($id)
    {
        $title = 'Brand';
        $list_brand = Brand::take(5)->get();

        $list_product = Product::where('brand_id', '=', $id)->get();

        return view('frontend.pages.brand')->with(compact('title', 'list_brand', 'list_product'));
    }

    public function category($id)
    {
        $title = 'Category';
        $list_brand = Brand::take(5)->get();

        $list_product = Product::where('category_id', '=', $id)->get();

        return view('frontend.pages.category')->with(compact('title', 'list_brand', 'list_product'));
    }
}

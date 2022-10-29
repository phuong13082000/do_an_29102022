<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;

class AdminController extends Controller
{
    public function getHome()
    {
        $title = 'Dashboard';
        $count_brand = Brand::count();
        $count_category = Category::count();
        $count_slider = Slider::count();
        $count_product = Product::count();

        return view('admin.pages.home')->with(compact('title', 'count_brand', 'count_category', 'count_slider', 'count_product'));
    }
}

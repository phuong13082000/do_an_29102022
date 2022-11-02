<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $title = 'Product';
        $list_Product = Product::with('reBrand', 'reCategory')->get();

        return view('admin.pages.product.index')->with(compact('title', 'list_Product'));
    }

    public function create()
    {
        $title = 'Create Product';
        $list_brand = Brand::pluck('title', 'id');
        $list_category = Category::pluck('title', 'id');

        return view('admin.pages.product.form')->with(compact('title', 'list_brand', 'list_category'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $product = new Product();
        $product->title = $data['title'];
        $product->number = $data['number'];
        $product->price = $data['price'];
        $product->price_sale = $data['price_sale'];
        $product->manhinh = $data['manhinh'];
        $product->mausac = $data['mausac'];
        $product->camera_sau = $data['camera_sau'];
        $product->camera_truoc = $data['camera_truoc'];
        $product->cpu = $data['cpu'];
        $product->bonho = $data['bonho'];
        $product->ram = $data['ram'];
        $product->ketnoi = $data['ketnoi'];
        $product->pin_sac = $data['pin_sac'];
        $product->tienich = $data['tienich'];
        $product->thongtin_chung = $data['thongtin_chung'];
        $product->status = $data['status'];
        $product->brand_id = $data['brand_id'];
        $product->category_id = $data['category_id'];

        $get_image = $request->file('image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('uploads/product/', $new_image);
            $product->image = $new_image;
        }

        $product->save();

        return redirect()->route('product.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $title = 'Edit Product';

        $list_brand = Brand::pluck('title', 'id');
        $list_category = Category::pluck('title', 'id');

        $product = Product::find($id)->first();

        return view('admin.pages.product.form')->with(compact('title', 'product', 'list_brand', 'list_category'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $product = Product::find($id);
        $product->title = $data['title'];
        $product->number = $data['number'];
        $product->price = $data['price'];
        $product->price_sale = $data['price_sale'];
        $product->manhinh = $data['manhinh'];
        $product->mausac = $data['mausac'];
        $product->camera_sau = $data['camera_sau'];
        $product->camera_truoc = $data['camera_truoc'];
        $product->cpu = $data['cpu'];
        $product->bonho = $data['bonho'];
        $product->ram = $data['ram'];
        $product->ketnoi = $data['ketnoi'];
        $product->pin_sac = $data['pin_sac'];
        $product->tienich = $data['tienich'];
        $product->thongtin_chung = $data['thongtin_chung'];
        $product->status = $data['status'];
        $product->brand_id = $data['brand_id'];
        $product->category_id = $data['category_id'];

        $get_image = $request->file('image');
        if ($get_image) {
            if (file_exists('uploads/product/' . $product->image)) {
                unlink('uploads/product/' . $product->image);
            } else {
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move('uploads/product/', $new_image);
                $product->image = $new_image;
            }
        }

        $product->save();

        return redirect()->route('product.index');
    }


    public function destroy($id)
    {
        $product = Product::find($id);
        if (file_exists('uploads/product/' . $product->image)) {
            unlink('uploads/product/' . $product->image);
        }

        $product->delete();
        return redirect()->route('product.index');
    }
}

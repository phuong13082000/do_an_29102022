<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $title = 'Brand';
        $list_Brand = Brand::all();

        return view('admin.pages.brand.index')->with(compact('title', 'list_Brand'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        Brand::create($request->all());

        return redirect()->route('brand.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $title = 'Edit Brand';
        $brand = Brand::find($id);

        return view('admin.pages.brand.form')->with(compact('title', 'brand'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $brand = Brand::find($id);
        $brand->title = $data['title'];
        $brand->status = $data['status'];
        $brand->save();

        return redirect()->route('brand.index');
    }


    public function destroy($id)
    {
        $brand_id = Brand::find($id);
        $check_brand = Product::where('brand_id', '=', $id)->first();

        if ($check_brand) {
            return redirect()->route('brand.index')->with('error', 'Brand đang có sản phẩm');;
        } else {
            $brand_id->delete();
            return redirect()->route('brand.index')->with('success', 'Xóa brand thành công');;
        }
    }

    public function update_Status_Brand(Request $request)
    {
        $data = $request->all();

        $brand = Brand::find($data['id']);
        $brand->status = $data['status'];

        $brand->save();
    }
}

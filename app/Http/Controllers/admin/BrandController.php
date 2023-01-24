<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $title = 'Brand';

        $count_message = Comment::where('status', 1)
            ->where('comment_parent_id', NULL)->count();

        $messages = Comment::with('reCustomer')
            ->where('status', 1)
            ->where('comment_parent_id', NULL)->get();

        $listBrand = Brand::all();

        return view('admin.pages.brand.index')->with(compact('title', 'listBrand', 'count_message', 'messages'));
    }

    public function create()
    {
        //
    }

    public function store(BrandRequest $request)
    {
        $data = $request->all();

        $brandName = $request['title'];
        $brands = Brand::where('title', $brandName)->get();
        $count = count($brands);
        if ($count > 0) {
            return false;
        } else {
            Brand::create($data);
        }

        return redirect()->route('brand.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $title = 'Edit Brand';

        $count_message = Comment::where('status', 1)
            ->where('comment_parent_id', NULL)->count();

        $messages = Comment::with('reCustomer')
            ->where('status', 1)
            ->where('comment_parent_id', NULL)->get();

        $brand = Brand::findOrFail($id);

        return view('admin.pages.brand.form')->with(compact('title', 'brand', 'count_message', 'messages'));
    }

    public function update(Request $request, $id)
    {
        $brandId = Brand::find($id);
        $brandId->title = $request['title'];
        $brandId->status = $request['status'];
        $brandId->save();

        return redirect()->route('brand.index');
    }


    public function destroy($id)
    {
        $brand = Brand::find($id);
        $check_brand = Product::where('brand_id', $id)->first();

        if ($check_brand) {
            return redirect()->route('brand.index')->with('error', 'Brand đang có sản phẩm');
        } else {
            $brand->delete();
            return redirect()->route('brand.index')->with('success', 'Xóa brand thành công');
        }
    }

    public function updateStatusBrand(Request $request)
    {
        $brand = Brand::find($request['id']);
        $brand->status = $request['status'];
        $brand->save();
    }
}

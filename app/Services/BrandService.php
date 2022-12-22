<?php

namespace App\Services;

use App\Models\Brand;
use App\Models\Product;

class BrandService
{
    public function create($request)
    {
        $data = $request->all();

        $brandName = $request['title'];
        $brands = Brand::where('title', $brandName)->get();
        $count = count($brands);
        if ($count > 0) {
            return false;
        } else {
            return Brand::create($data);
        }
    }

    public function update($request, $id)
    {
        $brandId = Brand::find($id);
        $brandId->title = $request['title'];
        $brandId->status = $request['status'];
        $brandId->save();

    }

    public function updateStatus($request)
    {
        $brand = Brand::find($request['id']);
        $brand->status = $request['status'];
        $brand->save();
    }

    public function checkProductBrand($id)
    {
        $brand = Brand::find($id);
        $check_brand = Product::where('brand_id', $id)->first();

        if ($check_brand) {
            return true;
        } else {
            $brand->delete();
            return false;
        }
    }
}

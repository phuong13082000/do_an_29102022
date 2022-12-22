<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function create($request)
    {
        $data = $request->all();

        $categoryName = $request['title'];
        $categories = Category::where('title', $categoryName)->get();
        $count = count($categories);
        if ($count > 0) {
            return false;
        } else {
            return Category::create($data);
        }
    }

    public function update($request, $id)
    {
        $categoryId = Category::find($id);
        $categoryId->title = $request['title'];
        $categoryId->status = $request['status'];
        $categoryId->save();
    }

    public function updateStatus($request)
    {
        $brand = Category::find($request['id']);
        $brand->status = $request['status'];
        $brand->save();
    }

}

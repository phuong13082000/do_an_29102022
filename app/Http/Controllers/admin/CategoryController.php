<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $title = 'Category';
        $list_Category = Category::all();

        return view('admin.pages.category.index')->with(compact('title', 'list_Category'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        Category::create($request->all());

        return redirect()->route('category.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $title = 'Edit Category';
        $category = Category::find($id);

        return view('admin.pages.category.form')->with(compact('title', 'category'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $category = Category::find($id);
        $category->title = $data['title'];
        $category->status = $data['status'];
        $category->save();

        return redirect()->route('category.index');
    }


    public function destroy($id)
    {
        $category_id = Category::find($id);
        $check_category = Product::where('category_id', '=', $id)->first();

        if ($check_category) {
            return redirect()->route('category.index')->with('error', 'Category đang có sản phẩm');
        } else {
            $category_id->delete();
            return redirect()->route('category.index')->with('success', 'Xóa category thành công');
        }
    }
}

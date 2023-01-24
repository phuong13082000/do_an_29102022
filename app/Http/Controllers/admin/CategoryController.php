<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $title = 'Category';
        $count_message = Comment::where('status', 1)
            ->where('comment_parent_id', NULL)->count();

        $messages = Comment::with('reCustomer')
            ->where('status', 1)
            ->where('comment_parent_id', NULL)->get();

        $listCategory = Category::all();

        return view('admin.pages.category.index')->with(compact('title', 'listCategory', 'count_message', 'messages'));
    }

    public function create()
    {
        //
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->all();

        $categoryName = $request['title'];
        $categories = Category::where('title', $categoryName)->get();
        $count = count($categories);
        if ($count > 0) {
            return false;
        } else {
            Category::create($data);
        }
        return redirect()->route('category.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $title = 'Edit Category';
        $count_message = Comment::where('status', 1)
            ->where('comment_parent_id', NULL)->count();

        $messages = Comment::with('reCustomer')
            ->where('status', 1)
            ->where('comment_parent_id', NULL)->get();

        $category = Category::find($id);

        return view('admin.pages.category.form')->with(compact('title', 'category', 'count_message', 'messages'));
    }

    public function update(Request $request, $id)
    {
        $categoryId = Category::find($id);
        $categoryId->title = $request['title'];
        $categoryId->status = $request['status'];
        $categoryId->save();

        return redirect()->route('category.index');
    }

    public function destroy($id)
    {
        $categoryId = Category::find($id);
        $checkCategory = Product::where('category_id', $id)->first();

        if ($checkCategory) {
            return redirect()->route('category.index')->with('error', 'Category đang có sản phẩm');
        } else {
            $categoryId->delete();
            return redirect()->route('category.index')->with('success', 'Xóa category thành công');
        }
    }

    public function update_Status_Category(Request $request)
    {
        $brand = Category::find($request['id']);
        $brand->status = $request['status'];
        $brand->save();
    }
}

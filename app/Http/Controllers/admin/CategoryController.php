<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $title = 'Category';
        $list_Category = Category::all();
        $count_message = Comment::where('status', 1)->where('comment_parent_id', NULL)->count();
        $messages = Comment::with('reCustomer')->where('status', 1)->where('comment_parent_id', NULL)->get();

        return view('admin.pages.category.index')->with(compact('title', 'list_Category', 'count_message', 'messages'));
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
        $count_message = Comment::where('status', 1)->where('comment_parent_id', NULL)->count();
        $messages = Comment::with('reCustomer')->where('status', 1)->where('comment_parent_id', NULL)->get();

        return view('admin.pages.category.form')->with(compact('title', 'category', 'count_message', 'messages'));
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

    public function update_Status_Category(Request $request)
    {
        $data = $request->all();

        $category = Category::find($data['id']);
        $category->status = $data['status'];

        $category->save();
    }
}

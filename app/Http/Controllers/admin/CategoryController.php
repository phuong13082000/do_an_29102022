<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $title = 'Category';
        $count_message = Comment::where('status', 1)
            ->where('comment_parent_id', NULL)
            ->count();

        $messages = Comment::with('reCustomer')
            ->where('status', 1)
            ->where('comment_parent_id', NULL)
            ->get();

        $listCategory = Category::all();

        return view('admin.pages.category.index')->with(compact('title', 'listCategory', 'count_message', 'messages'));
    }

    public function create()
    {
        //
    }

    public function store(CategoryRequest $request)
    {
        $this->categoryService->create($request);

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
            ->where('comment_parent_id', NULL)
            ->count();

        $messages = Comment::with('reCustomer')
            ->where('status', 1)
            ->where('comment_parent_id', NULL)
            ->get();

        $category = Category::find($id);

        return view('admin.pages.category.form')->with(compact('title', 'category', 'count_message', 'messages'));
    }

    public function update(Request $request, $id)
    {
        $this->categoryService->update($request, $id);

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
        $this->categoryService->updateStatus($request);
    }
}

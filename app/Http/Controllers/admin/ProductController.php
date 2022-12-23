<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $title = 'Product';
        $count_message = Comment::where('status', 1)
            ->where('comment_parent_id', NULL)->count();

        $messages = Comment::with('reCustomer')
            ->where('status', 1)
            ->where('comment_parent_id', NULL)->get();

        $listProduct = Product::with('reBrand', 'reCategory')->get();

        return view('admin.pages.product.index')->with(compact('title', 'listProduct', 'count_message', 'messages'));
    }

    public function create()
    {
        $title = 'Create Product';
        $count_message = Comment::where('status', 1)
            ->where('comment_parent_id', NULL)->count();

        $messages = Comment::with('reCustomer')
            ->where('status', 1)
            ->where('comment_parent_id', NULL)->get();

        $list_brand = Brand::pluck('title', 'id');
        $list_category = Category::pluck('title', 'id');

        return view('admin.pages.product.form')->with(compact('title', 'list_brand', 'list_category', 'count_message', 'messages'));
    }

    public function store(ProductRequest $request)
    {
        $this->productService->create($request);

        return redirect()->route('product.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $title = 'Edit Product';
        $count_message = Comment::where('status', 1)
            ->where('comment_parent_id', NULL)->count();

        $messages = Comment::with('reCustomer')
            ->where('status', 1)
            ->where('comment_parent_id', NULL)->get();

        $list_brand = Brand::pluck('title', 'id');
        $list_category = Category::pluck('title', 'id');

        $product = Product::find($id);

        return view('admin.pages.product.form')->with(compact('title', 'product', 'list_brand', 'list_category', 'count_message', 'messages'));
    }

    public function update(ProductRequest $request, $id)
    {
        $this->productService->update($request, $id);

        return redirect()->route('product.index');
    }

    public function destroy($id)
    {
        $this->productService->delete($id);

        return redirect()->route('product.index');
    }

    public function update_Status_Product(Request $request)
    {
        $this->productService->updateStatus($request);

    }
}

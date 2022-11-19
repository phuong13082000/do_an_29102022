<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Repositories\CommentRepository;
use App\Repositories\ProductRepository;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productRepository;
    protected $productService;
    protected $commentRepository;

    public function __construct(ProductRepository $productRepository, ProductService $productService, CommentRepository $commentRepository)
    {
        $this->productRepository = $productRepository;
        $this->productService = $productService;
        $this->commentRepository = $commentRepository;
    }

    public function index()
    {
        $title = 'Product';
        $count_message = $this->commentRepository->countComment();
        $messages = $this->commentRepository->getMessage();

        $listProduct = $this->productRepository->getAll();

        return view('admin.pages.product.index')->with(compact('title', 'listProduct', 'count_message', 'messages'));
    }

    public function create()
    {
        $title = 'Create Product';
        $count_message = $this->commentRepository->countComment();
        $messages = $this->commentRepository->getMessage();

        $list_brand = Brand::pluck('title', 'id');
        $list_category = Category::pluck('title', 'id');

        return view('admin.pages.product.form')->with(compact('title', 'list_brand', 'list_category', 'count_message', 'messages'));
    }

    public function store(Request $request)
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
        $count_message = $this->commentRepository->countComment();
        $messages = $this->commentRepository->getMessage();

        $list_brand = Brand::pluck('title', 'id');
        $list_category = Category::pluck('title', 'id');

        $product = $this->productRepository->findID($id);

        return view('admin.pages.product.form')->with(compact('title', 'product', 'list_brand', 'list_category', 'count_message', 'messages'));
    }

    public function update(Request $request, $id)
    {
        $this->productService->update($request, $id);

        return redirect()->route('product.index');
    }


    public function destroy($id)
    {
        $this->productService->delete($id);

        return redirect()->route('product.index');
    }

}

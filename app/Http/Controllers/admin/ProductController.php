<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\CommentRepository;
use App\Repositories\ProductRepository;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productRepository, $productService, $commentRepository, $categoryRepository, $brandRepository;

    public function __construct(
        ProductRepository  $productRepository, ProductService $productService,
        CommentRepository  $commentRepository,
        BrandRepository    $brandRepository,
        CategoryRepository $categoryRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->productService = $productService;
        $this->commentRepository = $commentRepository;
        $this->brandRepository = $brandRepository;
        $this->categoryRepository = $categoryRepository;
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

        $list_brand = $this->brandRepository->getBrandProduct();
        $list_category = $this->categoryRepository->getCategoryProduct();

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

        $list_brand = $this->brandRepository->getBrandProduct();
        $list_category = $this->categoryRepository->getCategoryProduct();

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

    public function update_Status_Product(Request $request)
    {
        $this->productService->updateStatus($request);

    }
}

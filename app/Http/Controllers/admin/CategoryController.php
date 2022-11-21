<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use App\Repositories\CommentRepository;
use App\Repositories\ProductRepository;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $commentRepository, $categoryRepository, $categoryService, $productRepository;

    public function __construct(
        CommentRepository  $commentRepository,
        CategoryRepository $categoryRepository,
        CategoryService    $categoryService,
        ProductRepository  $productRepository,
    )
    {
        $this->commentRepository = $commentRepository;
        $this->categoryRepository = $categoryRepository;
        $this->categoryService = $categoryService;
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $title = 'Category';
        $count_message = $this->commentRepository->countComment();
        $messages = $this->commentRepository->getMessage();

        $listCategory = $this->categoryRepository->getAll();

        return view('admin.pages.category.index')->with(compact('title', 'listCategory', 'count_message', 'messages'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
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
        $count_message = $this->commentRepository->countComment();
        $messages = $this->commentRepository->getMessage();

        $category = $this->categoryRepository->findID($id);

        return view('admin.pages.category.form')->with(compact('title', 'category', 'count_message', 'messages'));
    }

    public function update(Request $request, $id)
    {
        $this->categoryService->update($request, $id);

        return redirect()->route('category.index');
    }


    public function destroy($id)
    {
        $categoryId = $this->categoryRepository->findID($id);
        $checkCategory = $this->productRepository->findCategoryFromProductById($id);

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

<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryService
{
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function create(Request $request)
    {
        $attributes = $request->all();

        $categoryName = $request['title'];
        $categories = $this->categoryRepository->findByName($categoryName);
        $count = count($categories);
        if ($count > 0) {
            return false;
        } else {
            return $this->categoryRepository->create($attributes);
        }
    }

    public function update(Request $request, $id)
    {
        $categoryId = $this->categoryRepository->findID($id);

        $categoryName = $request['title'];
        $categories = $this->categoryRepository->findByName($categoryName);
        $count = count($categories);

        if ($count > 0) {
            $categoryId->delete();
        } else {
            $categoryId->title = $request['title'];
            $categoryId->status = $request['status'];
            $categoryId->save();
        }
    }

    public function updateStatus(Request $request)
    {
        $brand = $this->categoryRepository->findID($request['id']);
        $brand->status = $request['status'];
        $brand->save();
    }

}

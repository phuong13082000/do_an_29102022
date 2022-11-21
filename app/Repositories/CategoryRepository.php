<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getAll()
    {
        return Category::all();
    }

    public function findID($id)
    {
        return Category::find($id);
    }

    public function create($attributes)
    {
        return $this->category->create($attributes);
    }

    public function findByName($name)
    {
        return Category::where('title', $name)->get();
    }

    public function getListCategoryIndex()
    {
        return Category::where('status', 0)->get();
    }
}

<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Product;

class CategoryRepository
{
    protected $category;
    protected $product;

    public function __construct(Category $category, Product $product)
    {
        $this->category = $category;
        $this->product = $product;
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

    public function findCategoryFromProductById($id)
    {
        return Product::where('category_id', $id)->first();
    }
}

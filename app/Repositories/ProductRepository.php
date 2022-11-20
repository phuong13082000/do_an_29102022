<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Models\Product;

class ProductRepository
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getAll()
    {
        return Product::with('reBrand', 'reCategory')->get();
    }

    public function findID($id)
    {
        return Product::find($id);
    }

    public function create($attributes)
    {
        return $this->product->create($attributes);
    }

    public function findByName($name)
    {
        return Product::where('title', $name)->get();
    }

    public function countProduct()
    {
        return Product::count();
    }
}

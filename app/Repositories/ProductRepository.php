<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Models\Product;

class ProductRepository
{
    protected $product;
    protected $comment;

    public function __construct(Product $product, Comment $comment)
    {
        $this->product = $product;
        $this->comment = $comment;
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

    public function findCommentByProductId($id)
    {
        return Comment::where('product_id', $id)->get();
    }

    public function countProduct()
    {
        return Product::count();
    }
}

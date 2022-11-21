<?php

namespace App\Repositories;

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

    public function findCategoryFromProductById($id)
    {
        return Product::where('category_id', $id)->first();
    }

    public function getListProductIndex()
    {
        return Product::where('number', '>', 2)
            ->where('status', 0)
            ->orderBy('created_at', 'DESC')
            ->take(4)
            ->get();
    }

    public function getListProductSaleIndex()
    {
        return Product::where('price_sale', '!=', '0')
            ->where('number', '>', 2)
            ->where('status', 0)
            ->orderBy('price_sale', 'ASC')
            ->take(4)
            ->get();
    }

    public function getListProductRecommentIndex()
    {
        return Product::orderBy('updated_at', 'DESC')
            ->take(10)
            ->get();
    }

    public function getListProductFromBrandId($id)
    {
        return Product::where('brand_id', $id)->get();
    }

    public function getListProductFromCategoryId($id)
    {
        return Product::where('category_id', $id)->get();
    }

    public function getListProductFromSearch($tukhoa)
    {
        return Product::where('title', 'LIKE', '%' . $tukhoa . '%')->get();
    }
}

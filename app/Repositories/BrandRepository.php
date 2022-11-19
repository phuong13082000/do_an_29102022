<?php

namespace App\Repositories;

use App\Models\Brand;
use App\Models\Product;

class BrandRepository
{
    protected $brand;
    protected $product;

    public function __construct(Brand $brand, Product $product)
    {
        $this->brand = $brand;
        $this->product = $product;
    }

    public function getAll()
    {
        return Brand::all();
    }

    public function findID($id)
    {
        return Brand::find($id);
    }

    public function create($attributes)
    {
        return $this->brand->create($attributes);
    }

    public function findByName($name)
    {
        return Brand::where('title', $name)->get();
    }

    public function findBrandFromProductById($id)
    {
        return Product::where('brand_id', $id)->first();
    }
}

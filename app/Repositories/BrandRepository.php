<?php

namespace App\Repositories;

use App\Models\Brand;

class BrandRepository
{
    protected $brand;

    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
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

    public function getBrandProduct()
    {
        return Brand::pluck('title', 'id');
    }

    public function findByName($name)
    {
        return Brand::where('title', $name)->get();
    }

    public function getListBrandIndex()
    {
        return Brand::where('status', 0)->take(5)->get();
    }
}

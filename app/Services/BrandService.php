<?php

namespace App\Services;

use App\Repositories\BrandRepository;
use App\Repositories\ProductRepository;

class BrandService
{
    public function __construct(BrandRepository $brandRepository, ProductRepository $productRepository)
    {
        $this->brandRepository = $brandRepository;
        $this->productRepository = $productRepository;
    }

    public function create($request)
    {
        $attributes = $request->all();

        $brandName = $request['title'];
        $brands = $this->brandRepository->findByName($brandName);
        $count = count($brands);
        if ($count > 0) {
            return false;
        } else {
            return $this->brandRepository->create($attributes);
        }
    }

    public function update($request, $id)
    {
        $brandId = $this->brandRepository->findID($id);
        $brandId->title = $request['title'];
        $brandId->status = $request['status'];
        $brandId->save();

    }

    public function updateStatus($request)
    {
        $brand = $this->brandRepository->findID($request['id']);
        $brand->status = $request['status'];
        $brand->save();
    }

    public function checkProductBrand($id)
    {
        $brand = $this->brandRepository->findID($id);
        $check_brand = $this->productRepository->findBrandFromProductById($id);

        if ($check_brand) {
            return true;
        } else {
            $brand->delete();
            return false;
        }
    }
}

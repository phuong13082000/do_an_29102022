<?php

namespace App\Services;

use App\Repositories\BrandRepository;
use Illuminate\Http\Request;

class BrandService
{
    public function __construct(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function create(Request $request)
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

    public function update(Request $request, $id)
    {
        $brandId = $this->brandRepository->findID($id);

        $brandName = $request['title'];
        $brands = $this->brandRepository->findByName($brandName);
        $count = count($brands);

        if ($count > 0) {
            $brandId->delete();
        } else {
            $brandId->title = $request['title'];
            $brandId->status = $request['status'];
            $brandId->save();
        }
    }

    public function updateStatus(Request $request)
    {
        $brand = $this->brandRepository->findID($request['id']);
        $brand->status = $request['status'];
        $brand->save();
    }

}

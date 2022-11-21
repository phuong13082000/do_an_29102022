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
            ->where('number', '>', 2)
            ->where('status', 0)
            ->take(10)
            ->get();
    }

    public function getListProductFromBrandId($id)
    {
        return Product::where('brand_id', $id)
            ->where('status', 0)
            ->get();
    }

    public function getListProductFromCategoryId($id)
    {
        return Product::where('category_id', $id)
            ->where('status', 0)
            ->get();
    }

    public function getListProductFromSearch($tukhoa)
    {
        return Product::where('title', 'LIKE', '%' . $tukhoa . '%')
            ->where('number', '>', 2)
            ->where('status', 0)
            ->get();
    }

    public function getListProductWhereBoNho($bonho)
    {
        return Product::where('bonho', $bonho)
            ->where('number', '>', 2)
            ->where('status', 0)
            ->get();
    }

    public function getListProductWhereRam($ram)
    {
        return Product::where('ram', $ram)
            ->where('number', '>', 2)
            ->where('status', 0)
            ->get();
    }

    public function getListProductWherePrice($operation , $price)
    {
        return Product::where('price', $operation, $price)
            ->where('number', '>', 2)
            ->where('status', 0)
            ->get();
    }

    public function getListProductWherePrices($operation_s , $operation_e, $price_s, $price_e)
    {
        return Product::where('price', $operation_s, $price_s)
            ->where('price', $operation_e, $price_e)
            ->where('number', '>', 2)
            ->where('status', 0)
            ->get();
    }

    public function getListProductWherePinSac($pinsac)
    {
        return Product::where('pin_sac', 'LIKE', '%'. $pinsac. '%')
            ->where('number', '>', 2)
            ->where('status', 0)
            ->get();
    }

    public function getListProductWhereTienIch($tienich)
    {
        return Product::where('tienich', 'LIKE', '%'. $tienich. '%')
            ->where('number', '>', 2)
            ->where('status', 0)
            ->get();
    }

    public function getListProductArrange($column, $arrange)
    {
        return Product::where('number', '>', 2)
            ->where('status', 0)
            ->orderBy($column, $arrange)
            ->take(8)
            ->get();
    }
}

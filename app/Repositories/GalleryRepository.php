<?php

namespace App\Repositories;

use App\Models\Gallery;

class GalleryRepository
{
    protected $gallery;

    public function __construct(Gallery $gallery)
    {
        $this->gallery = $gallery;
    }

    public function getAll()
    {
        return Gallery::all();
    }

    public function findID($id)
    {
        return Gallery::find($id);
    }

    public function findProductId($productId)
    {
        return Gallery::where('product_id', $productId)->get();
    }

}

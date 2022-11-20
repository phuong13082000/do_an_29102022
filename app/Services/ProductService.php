<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\CommentRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductService
{
    public function __construct(ProductRepository $productRepository, ImageService $imageService, CommentRepository $commentRepository)
    {
        $this->productRepository = $productRepository;
        $this->imageService = $imageService;
        $this->commentRepository = $commentRepository;
    }

    public function create(Request $request)
    {
        $productName = $request['title'];
        $products = $this->productRepository->findByName($productName);
        $count = count($products);
        if ($count > 0) {
            return false;
        } else {
            $data = $request->all();
            $product = new Product();
            $product->title = $data['title'];
            $product->number = $data['number'];
            $product->price = $data['price'];
            $product->price_sale = $data['price_sale'];
            $product->manhinh = $data['manhinh'];
            $product->mausac = $data['mausac'];
            $product->camera_sau = $data['camera_sau'];
            $product->camera_truoc = $data['camera_truoc'];
            $product->cpu = $data['cpu'];
            $product->bonho = $data['bonho'];
            $product->ram = $data['ram'];
            $product->ketnoi = $data['ketnoi'];
            $product->pin_sac = $data['pin_sac'];
            $product->tienich = $data['tienich'];
            $product->thongtin_chung = $data['thongtin_chung'];
            $product->height = $data['height'];
            $product->length = $data['length'];
            $product->weight = $data['weight'];
            $product->width = $data['width'];
            $product->status = $data['status'];
            $product->brand_id = $data['brand_id'];
            $product->category_id = $data['category_id'];
            $get_image = $request->file('image');
            $product->image = $this->imageService->saveImageProduct($get_image);
            return $product->save();
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $product = $this->productRepository->findID($id);
        $product->title = $data['title'];
        $product->number = $data['number'];
        $product->price = $data['price'];
        $product->price_sale = $data['price_sale'];
        $product->manhinh = $data['manhinh'];
        $product->mausac = $data['mausac'];
        $product->camera_sau = $data['camera_sau'];
        $product->camera_truoc = $data['camera_truoc'];
        $product->cpu = $data['cpu'];
        $product->bonho = $data['bonho'];
        $product->ram = $data['ram'];
        $product->ketnoi = $data['ketnoi'];
        $product->pin_sac = $data['pin_sac'];
        $product->tienich = $data['tienich'];
        $product->thongtin_chung = $data['thongtin_chung'];
        $product->height = $data['height'];
        $product->length = $data['length'];
        $product->weight = $data['weight'];
        $product->width = $data['width'];
        $product->status = $data['status'];
        $product->brand_id = $data['brand_id'];
        $product->category_id = $data['category_id'];

        $get_image = $request->file('image');
        if ($get_image) {
            if (file_exists('../public/uploads/product/' . $product->image)) {
                unlink('../public/uploads/product/' . $product->image);
            } else {
                $product->image = $this->imageService->saveImageProduct($get_image);
            }
        }
        $product->save();
    }

    public function delete($id)
    {
        $product = $this->productRepository->findID($id);
        if (file_exists('../public/uploads/product/' . $product->image)) {
            unlink('../public/uploads/product/' . $product->image);
        }

        $comments = $this->commentRepository->findCommentByProductId($id);
        $count_comment = $comments->count();
        if ($count_comment <= 0) {
            foreach ($comments as $comment) {
                $comment->delete();
            }
        }

        $product->delete();
    }
}

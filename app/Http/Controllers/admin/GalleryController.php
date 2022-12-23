<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Comment;
use App\Services\GalleryService;
use App\Services\ImageService;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    protected $galleryService, $imageService;

    public function __construct(GalleryService $galleryService, ImageService $imageService)
    {
        $this->galleryService = $galleryService;
        $this->imageService = $imageService;
    }

    public function gallery_index($id)
    {
        $title = 'Gallery';
        $count_message = Comment::where('status', 1)
            ->where('comment_parent_id', NULL)->count();

        $messages = Comment::with('reCustomer')
            ->where('status', 1)
            ->where('comment_parent_id', NULL)->get();

        $list_brand = Brand::pluck('title', 'id');
        $list_category = Category::pluck('title', 'id');

        $product_id = $id;

        return view('admin.pages.product.gallery')->with(compact('title', 'list_brand', 'list_category', 'count_message', 'messages', 'product_id'));
    }

    public function select_gallery(Request $request)
    {
        $this->galleryService->selectGallery($request);
    }

    public function insert_gallery(Request $request, $id)
    {
        $this->galleryService->insertGallery($request, $id);
        return redirect()->back();
    }

    public function update_gallery_name(Request $request)
    {
        $this->galleryService->updateNameGallery($request);
    }

    public function delete_gallery(Request $request)
    {
        $this->galleryService->deleteGallery($request);
    }

    public function update_gallery(Request $request)
    {
        $this->galleryService->updateGallery($request);
    }
}

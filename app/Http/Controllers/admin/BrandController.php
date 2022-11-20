<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Repositories\BrandRepository;
use App\Repositories\CommentRepository;
use App\Services\BrandService;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    protected $brandRepository, $brandService, $commentRepository;

    public function __construct(BrandRepository $brandRepository, BrandService $brandService, CommentRepository $commentRepository)
    {
        $this->brandRepository = $brandRepository;
        $this->brandService = $brandService;
        $this->commentRepository = $commentRepository;
    }

    public function index()
    {
        $title = 'Brand';
        $count_message = $this->commentRepository->countComment();
        $messages = $this->commentRepository->getMessage();

        $listBrand = $this->brandRepository->getAll();

        return view('admin.pages.brand.index')->with(compact('title', 'listBrand', 'count_message', 'messages'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->brandService->create($request);

        return redirect()->route('brand.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $title = 'Edit Brand';
        $count_message = $this->commentRepository->countComment();
        $messages = $this->commentRepository->getMessage();

        $brand = $this->brandRepository->findID($id);

        return view('admin.pages.brand.form')->with(compact('title', 'brand', 'count_message', 'messages'));
    }

    public function update(Request $request, $id)
    {
        $this->brandService->update($request, $id);

        return redirect()->route('brand.index');
    }


    public function destroy($id)
    {
        $brand = $this->brandRepository->findID($id);
        $check_brand = $this->brandRepository->findBrandFromProductById($id);

        if ($check_brand) {
            return redirect()->route('brand.index')->with('error', 'Brand đang có sản phẩm');;
        } else {
            $brand->delete();
            return redirect()->route('brand.index')->with('success', 'Xóa brand thành công');;
        }
    }

    public function update_Status_Brand(Request $request)
    {
        $this->brandService->updateStatus($request);
    }
}

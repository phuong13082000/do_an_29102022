<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use App\Models\Comment;
use App\Services\BrandService;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    protected $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }

    public function index()
    {
        $title = 'Brand';
        $count_message = Comment::where('status', 1)
            ->where('comment_parent_id', NULL)->count();

        $messages = Comment::with('reCustomer')
            ->where('status', 1)
            ->where('comment_parent_id', NULL)->get();

        $listBrand = Brand::all();

        return view('admin.pages.brand.index')->with(compact('title', 'listBrand', 'count_message', 'messages'));
    }

    public function create()
    {
        //
    }

    public function store(BrandRequest $request)
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
        $count_message = Comment::where('status', 1)
            ->where('comment_parent_id', NULL)->count();

        $messages = Comment::with('reCustomer')
            ->where('status', 1)
            ->where('comment_parent_id', NULL)->get();

        $brand = Brand::find($id);

        return view('admin.pages.brand.form')->with(compact('title', 'brand', 'count_message', 'messages'));
    }

    public function update(Request $request, $id)
    {
        $this->brandService->update($request, $id);

        return redirect()->route('brand.index');
    }


    public function destroy($id)
    {
        $check_brand = $this->brandService->checkProductBrand($id);

        if ($check_brand) {
            return redirect()->route('brand.index')->with('error', 'Brand đang có sản phẩm');
        } else {
            return redirect()->route('brand.index')->with('success', 'Xóa brand thành công');
        }
    }

    public function update_Status_Brand(Request $request)
    {
        $this->brandService->updateStatus($request);
    }
}

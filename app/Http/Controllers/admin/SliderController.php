<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\CommentRepository;
use App\Repositories\SliderRepository;
use App\Services\SliderService;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    protected $commentRepository, $sliderRepository, $sliderService;

    public function __construct(
        CommentRepository $commentRepository,
        SliderRepository  $sliderRepository, SliderService $sliderService,
    )
    {
        $this->commentRepository = $commentRepository;
        $this->sliderRepository = $sliderRepository;
        $this->sliderService = $sliderService;
    }

    public function index()
    {
        $title = 'Slider';
        $count_message = $this->commentRepository->countComment();
        $messages = $this->commentRepository->getMessage();

        $list_Slider = $this->sliderRepository->getSliderWithProduct();

        return view('admin.pages.slider.index')->with(compact('title', 'list_Slider', 'count_message', 'messages'));
    }

    public function create()
    {
        $title = 'Create Slider';
        $count_message = $this->commentRepository->countComment();
        $messages = $this->commentRepository->getMessage();

        $list_products = Product::pluck('title', 'id');

        return view('admin.pages.slider.form')->with(compact('title', 'count_message', 'messages', 'list_products'));
    }

    public function store(Request $request)
    {
        $this->sliderService->create($request);

        return redirect()->route('slider.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $title = 'Edit Slider';
        $count_message = $this->commentRepository->countComment();
        $messages = $this->commentRepository->getMessage();

        $list_products = Product::pluck('title', 'id');
        $slider = $this->sliderRepository->findID($id);

        return view('admin.pages.slider.form')->with(compact('title', 'slider', 'count_message', 'messages', 'list_products'));
    }

    public function update(Request $request, $id)
    {
        $this->sliderService->update($request, $id);

        return redirect()->route('slider.index');
    }


    public function destroy($id)
    {
        $slider = $this->sliderRepository->findID($id);

        if (file_exists('../public/uploads/slider/' . $slider->image)) {
            unlink('../public/uploads/slider/' . $slider->image);
        }

        $slider->delete();
        return redirect()->route('slider.index');
    }
}

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Slider;
use App\Services\SliderService;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    protected $sliderService;

    public function __construct(SliderService $sliderService)
    {
        $this->sliderService = $sliderService;
    }

    public function index()
    {
        $title = 'Slider';
        $count_message = Comment::where('status', 1)
            ->where('comment_parent_id', NULL)->count();

        $messages = Comment::with('reCustomer')
            ->where('status', 1)
            ->where('comment_parent_id', NULL)->get();

        $list_Slider = Slider::with('reProduct')->get();

        return view('admin.pages.slider.index')->with(compact('title', 'list_Slider', 'count_message', 'messages'));
    }

    public function create()
    {
        $title = 'Create Slider';
        $count_message = Comment::where('status', 1)
            ->where('comment_parent_id', NULL)->count();

        $messages = Comment::with('reCustomer')
            ->where('status', 1)
            ->where('comment_parent_id', NULL)->get();

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
        $count_message = Comment::where('status', 1)
            ->where('comment_parent_id', NULL)->count();

        $messages = Comment::with('reCustomer')
            ->where('status', 1)
            ->where('comment_parent_id', NULL)->get();

        $list_products = Product::pluck('title', 'id');
        $slider = Slider::find($id);

        return view('admin.pages.slider.form')->with(compact('title', 'slider', 'count_message', 'messages', 'list_products'));
    }

    public function update(Request $request, $id)
    {
        $this->sliderService->update($request, $id);

        return redirect()->route('slider.index');
    }


    public function destroy($id)
    {
        $slider = Slider::find($id);

        if (file_exists('../public/uploads/slider/' . $slider->image)) {
            unlink('../public/uploads/slider/' . $slider->image);
        }

        $slider->delete();
        return redirect()->route('slider.index');
    }
}

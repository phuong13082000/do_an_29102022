<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        $title = 'Slider';
        $list_Slider = Slider::with('reProduct')->get();
        $count_message = Comment::where('status', 1)->where('comment_parent_id', NULL)->count();
        $messages = Comment::with('reCustomer')->where('status', 1)->where('comment_parent_id', NULL)->get();

        return view('admin.pages.slider.index')->with(compact('title', 'list_Slider', 'count_message', 'messages'));
    }

    public function create()
    {
        $title = 'Create Slider';
        $list_products = Product::pluck('title', 'id');
        $count_message = Comment::where('status', 1)->where('comment_parent_id', NULL)->count();
        $messages = Comment::with('reCustomer')->where('status', 1)->where('comment_parent_id', NULL)->get();

        return view('admin.pages.slider.form')->with(compact('title', 'count_message', 'messages', 'list_products'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $slider = new Slider();
        $slider->title = $data['title'];
        $slider->product_id = $data['product_id'];
        $slider->status = $data['status'];

        $get_image = $request->file('image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('../public/uploads/slider/', $new_image);
            $slider->image = $new_image;
        }

        $slider->save();

        return redirect()->route('slider.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $title = 'Edit Slider';
        $list_products = Product::pluck('title', 'id');
        $slider = Slider::find($id);
        $count_message = Comment::where('status', 1)->where('comment_parent_id', NULL)->count();
        $messages = Comment::with('reCustomer')->where('status', 1)->where('comment_parent_id', NULL)->get();

        return view('admin.pages.slider.form')->with(compact('title', 'slider', 'count_message', 'messages', 'list_products'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $slider = Slider::find($id);
        $slider->title = $data['title'];
        $slider->url = $data['url'];
        $slider->status = $data['status'];

        $get_image = $request->file('image');
        if ($get_image) {
            if (file_exists('../public/uploads/slider/' . $slider->image)) {
                unlink('../public/uploads/slider/' . $slider->image);
            } else {
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move('../public/uploads/slider/', $new_image);
                $slider->image = $new_image;
            }
        }

        $slider->save();

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

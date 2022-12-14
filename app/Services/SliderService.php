<?php

namespace App\Services;

use App\Models\Slider;

class SliderService
{
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function create($request)
    {
        $sliderName = $request['title'];
        $sliders = Slider::where('title', $sliderName)->get();
        $count = count($sliders);
        if ($count > 0) {
            return false;
        } else {
            $slider = new Slider();
            $slider->title = $request['title'];
            $slider->product_id = $request['product_id'];
            $slider->status = $request['status'];
            $get_image = $request->file('image');
            $new_image = $this->imageService->saveImageSlider($get_image);
            $slider->image = $new_image;
            $slider->save();
            return true;
        }
    }

    public function update($request, $id)
    {
        $sliderId = Slider::find($id);
        $sliderId->title = $request['title'];
        $sliderId->product_id = $request['product_id'];
        $sliderId->status = $request['status'];
        $get_image = $request->file('image');
        if ($get_image) {
            if (file_exists('../public/uploads/slider/' . $sliderId->image)) {
                unlink('../public/uploads/slider/' . $sliderId->image);
            } else {
                $new_image = $this->imageService->saveImageSlider($get_image);
                $sliderId->image = $new_image;
            }
        }

        $sliderId->save();
    }

}

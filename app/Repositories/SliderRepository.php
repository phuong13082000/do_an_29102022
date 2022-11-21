<?php

namespace App\Repositories;

use App\Models\Slider;

class SliderRepository
{
    protected $slider;

    public function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }

    public function getAll()
    {
        return Slider::all();
    }

    public function findID($id)
    {
        return Slider::find($id);
    }

    public function findByName($name)
    {
        return Slider::where('title', $name)->get();
    }

    public function getSliderWithProduct()
    {
        return Slider::with('reProduct')->get();
    }

    public function getSliderFirstWithProductIndex()
    {
        return Slider::with('reProduct')
            ->where('status', 0)
            ->orderBy('id', 'ASC')
            ->first();
    }

    public function getListSliderWithProductIndex($id_firstSlider)
    {
        return Slider::with('reProduct')
            ->where('id', '>', $id_firstSlider)
            ->where('status', 0)
            ->take(2)
            ->get();
    }
}

<?php

namespace App\Services;

use Illuminate\Http\Request;

class ImageService
{
    public function saveImageProduct($getImage)
    {
        $get_name_image = $getImage->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image . rand(0, 9999) . '.' . $getImage->getClientOriginalExtension();
        $getImage->move('../public/uploads/product/', $new_image);
        return $new_image;
    }

    public function saveImageGallery($getImage)
    {
        $get_name_image = $getImage->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image . rand(0, 9999) . '.' . $getImage->getClientOriginalExtension();
        $getImage->move('../public/uploads/gallery/', $new_image);
        return $new_image;
    }

    public function saveImageSlider($getImage)
    {
        $get_name_image = $getImage->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image . rand(0, 9999) . '.' . $getImage->getClientOriginalExtension();
        $getImage->move('../public/uploads/slider/', $new_image);
        return $new_image;
    }
}

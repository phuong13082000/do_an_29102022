<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if (request()->isMethod('post')) {
            return [
                'title' => 'required|unique:products|max:255',
                'number' => 'required',
                'price' => 'required',
                'price_sale' => 'required',
                'manhinh' => 'required',
                'mausac' => 'required',
                'camera_sau' => 'required',
                'camera_truoc' => 'required',
                'cpu' => 'required',
                'bonho' => 'required',
                'ram' => 'required',
                'ketnoi' => 'required',
                'pin_sac' => 'required',
                'tienich' => 'required',
                'thongtin_chung' => 'required',
                'height' => 'required',
                'length' => 'required',
                'weight' => 'required',
                'width' => 'required',
                'status' => 'required',
                'brand_id' => 'required',
                'category_id' => 'required',
            ];
        } else {
            return [
                'title' => 'required|max:255',
                'number' => 'required',
                'price' => 'required',
                'price_sale' => 'required',
                'manhinh' => 'required',
                'mausac' => 'required',
                'camera_sau' => 'required',
                'camera_truoc' => 'required',
                'cpu' => 'required',
                'bonho' => 'required',
                'ram' => 'required',
                'ketnoi' => 'required',
                'pin_sac' => 'required',
                'tienich' => 'required',
                'thongtin_chung' => 'required',
                'height' => 'required',
                'length' => 'required',
                'weight' => 'required',
                'width' => 'required',
                'status' => 'required',
                'brand_id' => 'required',
                'category_id' => 'required',
            ];
        }
    }
}

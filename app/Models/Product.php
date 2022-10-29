<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $casts = [
        'image' => 'array'
    ];

    protected $fillable = [
        'id',
        'title',
        'image',
        'number',
        'price',
        'price_sale',
        'manhinh',
        'mausac',
        'camera_sau',
        'camera_truoc',
        'cpu',
        'bonho',
        'ram',
        'ketnoi',
        'pin_sac',
        'tienich',
        'thongtin_chung',
        'status',
        'brand_id',
        'category_id',
    ];

    public function reBrand()
    {
        return $this->belongsTo(Brand::class,'brand_id');
    }

    public function reCategory()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}

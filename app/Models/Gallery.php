<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'title',
        'image',
        'product_id',
    ];

    public function reProduct()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}

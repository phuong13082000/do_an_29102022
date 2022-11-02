<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'num',
        'price',
        'status',
        'order_id',
        'product_id',
    ];

    public function reProduct()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'title',
        'answer',
        'status',
        'customer_id',
        'product_id',
        'feedback_parent_id',
    ];

    public function reProduct()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function reCustomer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'price_ship',
        'note',
        'status',
        'payment_method',
        'name_nguoinhan',
        'phone_nguoinhan',
        'address_nguoinhan',
        'customer_id',
    ];
}

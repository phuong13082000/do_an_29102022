<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'fullname',
        'email',
        'password',
        'phone',
        'address',
        'status',
        'customer_token',
        'google_id',
        'facebook_id',
        'provider',
    ];

    protected $hidden = [
        'password',
    ];
}

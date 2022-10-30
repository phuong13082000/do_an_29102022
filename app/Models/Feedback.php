<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
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
}

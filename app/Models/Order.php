<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_ids',
        'name',
        'last_name',
        'email',
        'phone',
        'new_post_num',
        'new_post_adress',
        'post_num',
        'post_adress',
        'self_shipping',
        'order_note',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}

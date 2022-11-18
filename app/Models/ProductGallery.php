<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'image',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];


    public function product() {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}

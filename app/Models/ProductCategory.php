<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_type_id',
        'user_id',
        'slug',
        'name',
        'description',
        'main_img',
        'logo',
        'public',
        'seo_keywords',
        'seo_description',
        'seo_title',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function type() {
        return $this->belongsTo('App\Models\ProductType', 'product_type_id');
    }

    public function products() {
        return $this->hasMany('App\Models\Product');
    }

}

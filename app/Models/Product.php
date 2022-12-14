<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'product_category_id',
        'name',
        'slug',
        'price',
        'old_price',
        'price_type',
        'description',
        'main_img',
        'status',
        'quantity',
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

    public function category() {
        return $this->belongsTo('App\Models\ProductCategory', 'product_category_id');
    }

    public function notes() {
        return $this->hasMany(Note::class)->orderByDesc('created_at');
    }

    public function orderItem() {
        return $this->hasMany(OrderItem::class)->orderByDesc('created_at');
    }

    public function gallery() {
        return $this->hasMany(ProductGallery::class)->orderByDesc('created_at');
    }

    // public function images()
    // {
    //    return $this->hasMany(ProductImage::class)->limit(10);
    // }





}

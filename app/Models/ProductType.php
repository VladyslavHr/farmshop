<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'description',
        'slug',
        'logo',
        'main_img',
        'public',
        'seo_title',
        'seo_keywords',
        'seo_description',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function categories() {
        return $this->hasMany('App\Models\ProductCategory');
    }
}

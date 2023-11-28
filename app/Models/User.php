<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'phone',
        'password',
        'public',
        'admin',
        'cart',
        'post_number',
        'street',
        'city',
        'region',
        'role',
        'sex',
        'new_post_num',
        'new_post_city',
        'new_post_adress',
        'post_num',
        'post_city',
        'post_adress',
        'discount',
        'selfship',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function cartArray(): Attribute
	{
		return Attribute::make(
            get: fn ($value, $attributes) => json_decode($attributes['cart'], true),
        );
	}


	public function getCartProductsAttribute()
	{
        if(!$this->cart_array) return [];
		$ids = array_keys($this->cart_array);

		$products = Product::whereIn('id', $ids)->get();

		return $products;
	}


    public function cart_add($product_id)
    {
        if ($this->cart && $cart = json_decode($this->cart, true)) {
			if (isset($cart[$product_id])) {
				$cart[$product_id]++;
			}else{
				$cart[$product_id] = 1;
			}
		}else{
			$cart = [$product_id => 1];
		}
		$this->cart = json_encode($cart);
		$this->save();
    }

    public function orders(){
        return $this->hasMany(Order::class)->orderBy('created_at', 'desc');
    }
}

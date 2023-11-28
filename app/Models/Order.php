<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'total',
        'product_quantity',
        'name',
        'last_name',
        'email',
        'phone',
        'new_post_num',
        'new_post_city',
        'new_post_adress',
        'post_num',
        'post_city',
        'post_adress',
        'self_shipping',
        'order_note',
        'payment_status',
        'delivery_status',
        'payment_method',
        'delivery_track',
        'client_mail_sended',
        'admin_mail_sended',
        'transaction_id',
        'promo_id',
        'promo_discount',
        'user_id'

    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public const STATUS_CREATED = 'created';
    public const STATUS_PENDING = 'pending';
    public const STATUS_PAID = 'paid';
    public const STATUS_CANCELED = 'canceled';
    public const STATUS_REFOUNDED = 'refounded';


    public const STATUS_CASH = 'cash';

    public const STATUS_PREPARING = 'preparing';
    public const STATUS_DELIVERED = 'delivered';
    public const STATUS_RETURNED = 'returned';

    public function orderItems() {
        return $this->hasMany(OrderItem::class)->orderByDesc('created_at');
    }
    public function items() {
        return $this->hasMany(OrderItem::class)->orderByDesc('created_at');
    }

    public function getOrderReferenceAttribute()
    {
        return $this->created_at->timestamp . '-' . $this->id;
    }

    public function promoCode() {
        return $this->belongsTo(PromoCode::class, 'promo_id')->orderByDesc('created_at');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}

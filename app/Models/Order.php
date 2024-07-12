<?php

namespace App\Models;

use App\Models\UserShippingInformation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int>
     */
    protected $fillable = [
        'user_id',
        'cart_id',
        'status',
        'user_shipping_information_id',
    ];

    protected $table = 'orders';
    protected $guarded = false;

    /***********************************
     * ORDER STATUSES
     ***********************************/
    private $statuses = [
        'new' => 'Новый',
        'pending_payment' => 'Ожидает оплаты',
        'paid' => 'Оплачен',
        'cancelled' => 'Отменен',
    ];

    public static function getStatuses()
    {
        return self::$statuses;
    }

    /***********************************
     * RELATIONS
     ***********************************/

    public function user_shipping_information()
    {
        return $this->belongsTo(UserShippingInformation::class, 'user_shipping_information_id');
    }
    public function cart()
    {
        return $this->hasOne(Cart::class, 'order_id');
    }

    /***********************************
     * MODEL HELPERS FUNCTIONS
     ***********************************/
}

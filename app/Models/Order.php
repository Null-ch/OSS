<?php

namespace App\Models;

use App\Models\UserShippingInformation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'user_details_id',
        'delivery_service_id'
    ];

    protected $table = 'orders';
    protected $guarded = false;

    /***********************************
     * ORDER STATUSES
     ***********************************/
    private $statuses = [
        '0' => 'Новый',
        '1' => 'Ожидает оплаты',
        '2' => 'Оплачен',
        '3' => 'Отменен',
    ];

    public static function getStatuses()
    {
        return self::$statuses;
    }

    /***********************************
     * RELATIONS
     ***********************************/

    public function user_shipping_information(): BelongsTo
    {
        return $this->belongsTo(UserShippingInformation::class, 'user_shipping_information_id');
    }

    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class, 'order_id');
    }

    public function user_details(): BelongsTo
    {
        return $this->belongsTo(UserDetails::class, 'user_details_id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function delivery(): BelongsTo
    {
        return $this->belongsTo(Delivery::class, 'delivery_service_id');
    }

    /***********************************
     * MODEL HELPERS FUNCTIONS
     ***********************************/
    public function getStatus()
    {
        return $this->statuses[$this->status];
    }
    public function getTotalCost()
    {
        $totalCost = 0;
        $productCarts = $this->cart->cart_products;
        foreach ($productCarts as $item) {
            $totalCost += $item->quantity * $item->product->price;
        }
        return $totalCost;
    }
}

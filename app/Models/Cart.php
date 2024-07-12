<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Product;
use App\Models\CartProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'order_id',
        'products_data',
    ];

    protected $table = 'carts';
    protected $guarded = false;

    /***********************************
     * RELATIONS
     ***********************************/

    public function products()
    {
        return $this->hasManyThrough(Product::class, CartProduct::class, 'cart_id', 'id', 'id', 'product_id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
    /***********************************
     * MODEL HELPERS FUNCTIONS
     ***********************************/
}

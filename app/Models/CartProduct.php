<?php

namespace App\Models;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CartProduct extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
    ];

    protected $table = 'cart_products';
    protected $guarded = false;

    /***********************************
     * RELATIONS
     ***********************************/
    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }
    /***********************************
     * MODEL HELPERS FUNCTIONS
     ***********************************/
}

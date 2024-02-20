<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    /***********************************
     * MODEL HELPERS FUNCTIONS
     ***********************************/
}

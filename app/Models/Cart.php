<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    /***********************************
     * MODEL HELPERS FUNCTIONS
     ***********************************/
    
}

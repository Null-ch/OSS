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
     * RELATIONS
     ***********************************/

    public function user_shipping_information()
    {
        return $this->belongsTo(UserShippingInformation::class, 'user_shipping_information_id');
    }
    
    /***********************************
     * MODEL HELPERS FUNCTIONS
     ***********************************/
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserShippingInformation extends Model
{
    use HasFactory, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'type',
        'user_id',
        'value',
    ];
    
    protected $table = 'user_shipping_informations';
    protected $guarded = false;
    
    /***********************************
     * RELATIONS
     ***********************************/
    
    /***********************************
     * MODEL HELPERS FUNCTIONS
     ***********************************/
}

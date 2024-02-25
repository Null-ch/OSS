<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserAddres extends Model
{
    use HasFactory, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'addres',
        'user_id',
    ];
    
    protected $table = 'user_addres';
    protected $guarded = false;
    
    /***********************************
     * RELATIONS
     ***********************************/
    
    /***********************************
     * MODEL HELPERS FUNCTIONS
     ***********************************/
}

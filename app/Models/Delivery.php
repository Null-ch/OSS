<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Delivery extends Model
{
    use HasFactory, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'title',
        'is_active',
        'preview_image',
        'description',
    ];

    protected $table = 'deliveries';
    protected $guarded = false;

    /***********************************
     * RELATIONS
     ***********************************/

    /***********************************
     * MODEL HELPERS FUNCTIONS
     ***********************************/

}

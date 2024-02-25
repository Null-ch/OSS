<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SpecialOffer extends Model
{
    use HasFactory, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'header',
        'description',
        'image',
        'sort_order',
        'hex_code',
        'is_active',
    ];

    protected $table = 'special_offers';
    protected $guarded = false;

    /***********************************
     * RELATIONS
     ***********************************/

    /***********************************
     * MODEL HELPERS FUNCTIONS
     ***********************************/

    /**
     * Getting all specialOffers
     *
     * @return \Illuminate\Support\Collection
     * 
     */
    public static function getAllSpecialOffers()
    {
        $specialOffers = collect();
        SpecialOffer::chunk(100, function ($results) use ($specialOffers) {
            foreach ($results as $specialOffer) {
                $specialOffers->push($specialOffer);
            }
        });
        return $specialOffers;
    }
}

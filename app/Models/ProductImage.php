<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
    protected $table = 'product_images';
    protected $guarded = false;
    protected $fillable = [
        'image_path',
        'product_id',
        'sort_order',
    ];
    /***********************************
     * RELATIONS
     ***********************************/

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /***********************************
     * MODEL HELPERS FUNCTIONS
     ***********************************/

}

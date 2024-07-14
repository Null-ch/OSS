<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /***********************************
     * MODEL HELPERS FUNCTIONS
     ***********************************/
}

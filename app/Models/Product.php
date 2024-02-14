<?php

namespace App\Models;

use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'preview_image',
        'price',
        'count',
        'category_id',
        'hex_code',
    ];

    protected $table = 'products';
    protected $guarded = false;

    public function images()
    {
        return $this->hasMany(ProductImage::class,'product_id', 'id')->orderBy('sort_order');
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }
}

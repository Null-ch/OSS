<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'title',
        'preview_image',
        'description',
    ];

    protected $table = 'categories';
    protected $guarded = false;

    /***********************************
     * RELATIONS
     ***********************************/
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id');
    }
    /***********************************
     * MODEL HELPERS FUNCTIONS
     ***********************************/

    /**
     * Getting all categories
     *
     * @return \Illuminate\Support\Collection
     * 
     */
    public static function getAllCategories()
{
    $categories = collect();
    Category::where('is_active', true)->chunk(100, function ($results) use ($categories) {
        foreach ($results as $category) {
            $categories->push($category);
        }
    });
    return $categories;
}
}

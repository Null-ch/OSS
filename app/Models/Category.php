<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    ];

    protected $table = 'categories';
    protected $guarded = false;

    public static function getAllCategories()
    {
        $categories = collect();
        Category::chunk(100, function ($results) use ($categories) {
            foreach ($results as $category) {
                $categories->push($category);
            }
        });
        return $categories;
    }
}

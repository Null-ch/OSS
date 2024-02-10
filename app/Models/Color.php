<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Color extends Model
{
    use HasFactory, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'title', 'html_code', 'group', 'rgb_code',
    ];
    
    protected $table = 'colors';
    protected $guarded = false;
    public static $group = [
        'Red',
        'Pink',
        'Orange',
        'Yellow',
        'Purple',
        'Brown',
        'Main',
        'Green',
        'Blue',
        'White',
        'Grey',
    ];

    public static function getAllColors()
    {
        $colors = collect();
        Color::chunk(100, function ($results) use ($colors) {
            foreach ($results as $color) {
                $colors->push($color);
            }
        });
        return $colors;
    }
}

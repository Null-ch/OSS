<?php

namespace App\Models;

use App\Models\Order;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'middle_name',
        'name',
        'last_name',
        'email',
        'gender',
        'password',
        'role',
    ];
    public static $gender = [
        '0' => 'Мужчина',
        '1' => 'Женщина',
    ];

    public static $role = [
        '0' => 'Администратор',
        '1' => 'Пользователь',
    ];
    protected $table = 'users';
    protected $guarded = false;


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /***********************************
     * RELATIONS
     ***********************************/
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }
    public function shipping_informations(): HasMany
    {
        return $this->hasMany(UserShippingInformation::class);
    }
    
    /***********************************
     * MODEL HELPERS FUNCTIONS
     ***********************************/
    public static function isAdmin()
    {
        if (auth()->check()) {
            if (auth()->user()->role == 0) {
                return true;
            }
        } else {
            return false;
        }
    }
    public function getFullName()
    {
        return "{$this->last_name} {$this->name} {$this->middle_name}";
    }
}

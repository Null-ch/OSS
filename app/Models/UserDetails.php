<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserDetails extends Model
{
    use HasFactory;

    protected $table = 'user_details';
    protected $guarded = false;

    protected $fillable = [
        'user_id',
        'name',
        'last_name',
        'phone_number',
    ];

    /***********************************
     * RELATIONS
     ***********************************/
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

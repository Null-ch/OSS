<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserDetails extends Model
{
    use HasFactory;

    protected $table = 'user_details';
    protected $guarded = false;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone_number',
    ];

    /***********************************
     * RELATIONS
     ***********************************/
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

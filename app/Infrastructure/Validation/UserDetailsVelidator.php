<?php

namespace App\Infrastructure\Validation;

use App\Infrastructure\Validation\BaseValidator;

class UserDetailsVelidator extends BaseValidator
{
    protected $rules = [
        'name' => 'required',
        'email' => 'required',
        'phone_number' => 'required',
    ];
}

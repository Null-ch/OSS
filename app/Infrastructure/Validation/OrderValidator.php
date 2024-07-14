<?php

namespace App\Infrastructure\Validation;

use App\Infrastructure\Validation\BaseValidator;

class OrderValidator extends BaseValidator
{
    protected $rules = [
        'cart_id' => 'required',
    ];
}

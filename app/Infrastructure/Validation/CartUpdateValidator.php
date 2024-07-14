<?php

namespace App\Infrastructure\Validation;

use App\Infrastructure\Validation\BaseValidator;

class CartUpdateValidator extends BaseValidator
{
    protected $rules = [
        'cart_id' => 'required',
        'cart' => 'required',
    ];
}

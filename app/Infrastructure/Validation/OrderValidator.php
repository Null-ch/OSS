<?php

namespace App\Infrastructure\Validation;

use Illuminate\Validation\Rule;
use App\Infrastructure\Validation\BaseValidator;

class OrderValidator extends BaseValidator
{
    protected $rules = [
        'cart_id' => 'required',
    ];
}

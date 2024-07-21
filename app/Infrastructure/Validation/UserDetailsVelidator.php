<?php

namespace App\Infrastructure\Validation;

use App\Infrastructure\Validation\BaseValidator;

class UserDetailsVelidator extends BaseValidator
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
        ];
    }
}

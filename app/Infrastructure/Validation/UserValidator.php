<?php

namespace App\Infrastructure\Validation;

use Illuminate\Validation\Rule;
use App\Infrastructure\Validation\BaseValidator;

class UserValidator extends BaseValidator
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'middle_name' => 'string|max:255',
            'name' => 'required|string|max:255',
            'last_name' => 'string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users'),
            ],
            'gender' => '',
            'role' => '',
        ];
    }
}
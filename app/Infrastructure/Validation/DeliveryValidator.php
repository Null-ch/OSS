<?php

namespace App\Infrastructure\Validation;

use App\Infrastructure\Validation\BaseValidator;

class DeliveryValidator extends BaseValidator
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
        ];
    }
}

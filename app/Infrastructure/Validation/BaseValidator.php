<?php
namespace App\Infrastructure\Validation;

use Illuminate\Support\Facades\Validator;
use App\Infrastructure\Interfaces\ValidatorInterface;

abstract class BaseValidator implements ValidatorInterface
{
    protected $rules = [];

    public function validate(array $data): array
    {
        $validator = Validator::make($data, $this->rules);

        if ($validator->fails()) {
            throw new \InvalidArgumentException(implode(', ', $validator->errors()->all()));
        }

        return $validator->validated();
    }
}

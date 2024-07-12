<?php

namespace App\Infrastructure\Interfaces;

interface ValidatorInterface
{    
    /**
     * validate
     *
     * @param  array $data
     * @return array
     */
    public function validate(array $data): array;
}

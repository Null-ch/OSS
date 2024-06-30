<?php

namespace App\Infrastructure\Services;

class ResponseService
{
    public function getResponse($data): array
    {
        if ($data) {
            return [
                'result' => true,
                'data' => $data,
            ];
        } else {
            return [
                'result' => false,
                'message' => 'Данные не найдены',
            ];
        }
    }
}

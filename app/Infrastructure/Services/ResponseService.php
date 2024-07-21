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
        } elseif (isset($data['error'])) {
            return [
                'result' => false,
                'data' => $data,
            ];
        } else {
            return [
                'result' => false,
                'message' => 'Операция завершена с ошибкой!',
            ];
        }
    }
}

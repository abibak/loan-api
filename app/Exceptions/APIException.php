<?php

namespace App\Exceptions;


use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class APIException extends HttpResponseException
{
    public function __construct(string $message = "", int $code = 0, array $errors = [])
    {
        $data = [
            'data' => [
                'message' => $message,
            ],
        ];

        if (!empty($errors)) {
            $data['errors'] = $errors;
        }

        parent::__construct(new Response($data, $code, ['Content-type', 'application\json']));
    }
}

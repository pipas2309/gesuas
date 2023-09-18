<?php

namespace App\Controller;

use Exception;
use GuzzleHttp\Psr7\Response;

class ErrorController
{
    public function handleException(Exception $e): Response
    {
        $data = [
            'status' => 'error',
            'message' => $e->getMessage(),
        ];

        return new Response(500, [], json_encode($data));
    }
}

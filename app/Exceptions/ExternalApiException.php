<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class ExternalApiException extends Exception
{

    /**
     * APIエラー
     *
     * @param [string] $messages
     * @param [int] $statusCode
     * @param [Throwrable] $previous
     */
    public function __construct(string $messages, int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR, $previous = null)
    {
        parent::__construct($messages, $statusCode, $previous);
    }
}
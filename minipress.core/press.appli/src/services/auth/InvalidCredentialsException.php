<?php

namespace press\app\services\auth;

use Exception;
use Throwable;

class InvalidCredentialsException extends Exception
{
    public function __construct(string $message = "invalidCredentials", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
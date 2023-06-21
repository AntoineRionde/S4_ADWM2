<?php

namespace press\app\services\auth;

use Exception;
use Throwable;
class PasswordNotMatchException extends Exception
{
    public function __construct(string $message = "mot de passe incorrect", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
<?php

namespace press\app\services\auth;

use Exception;
use Throwable;
class WeakPasswordException extends Exception
{
    public function __construct(string $message = "weak password! Must contains at least 1 uppercase, 1 lowercase, 1 digit & 1 special char", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
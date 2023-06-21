<?php

namespace press\app\services\auth;

use Exception;
use Throwable;
class UserAlreadyExistsException extends Exception
{
    public function __construct(string $message = "email déjà utilisé", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
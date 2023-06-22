<?php

namespace press\app\services\categories;

use Exception;
use Throwable;

class CategoryAlreadyExistsException extends \Exception
{
    public function __construct(string $message = "Cette catégorie existe déjà", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
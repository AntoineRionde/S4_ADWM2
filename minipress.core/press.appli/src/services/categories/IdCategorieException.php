<?php

namespace press\app\services\categories;

use Exception;
use Throwable;

class IdCategorieException extends Exception
{
    public function __construct(string $message = "Erreur : la categorie n'existe pas", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
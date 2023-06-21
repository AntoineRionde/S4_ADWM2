<?php

namespace press\app\services\user;

use Exception;

class AccessControlException extends Exception
{
    public function __construct($message = "Vous n'avez pas les droits pour accéder à cette page", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
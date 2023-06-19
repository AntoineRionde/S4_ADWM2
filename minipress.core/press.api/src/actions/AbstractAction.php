<?php
declare(strict_types=1);

namespace press\api\actions;

use Slim\Psr7\Request;
use Slim\Psr7\Response;

abstract class AbstractAction
{
    abstract public function __invoke(Request $request, Response $response, array $args) : Response;

}
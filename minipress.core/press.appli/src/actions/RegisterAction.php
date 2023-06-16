<?php

namespace press\app\actions;

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class RegisterAction extends AbstractAction
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $view = Twig::fromRequest($request);
        $view->render($response, 'register.twig');
        return $response;
    }
}
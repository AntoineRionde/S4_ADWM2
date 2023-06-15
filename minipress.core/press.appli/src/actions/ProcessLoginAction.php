<?php

namespace press\app\actions;

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class ProcessLoginAction extends AbstractAction
{

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $routeContext = RouteContext::fromRequest($request);
        $url = $routeContext->getRouteParser()->urlFor('home');

        // TODO: Implement __invoke() method
        if($request->getMethod() === 'POST'){
            $username = $request->getParsedBody()['username'];
            $password = $request->getParsedBody()['password'];

        }
        return $response->withHeader('Location', $url)->withStatus(302);
    }
}
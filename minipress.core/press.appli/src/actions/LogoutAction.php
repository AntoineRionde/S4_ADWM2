<?php

namespace press\app\actions;

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;

class LogoutAction extends AbstractAction
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
        $url = $routeParser->urlFor('home');
        return $response->withHeader('location', $url)->withStatus(302);
    }
}
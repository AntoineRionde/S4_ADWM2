<?php

namespace press\app\actions;

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;

class LoginVerifyAction extends AbstractAction
{

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $target = "home";
        if (isset($args['target'])) {
            $target = $args['target'];
        }
        if (!isset($_SESSION['user'])) {
            $url = $routeParser->urlFor('login', [], ['target' => $target]);
            return $response->withHeader('location', $url)->withStatus(302);
        }
        $url = $routeParser->urlFor($target);
        return $response->withHeader('location', $url)->withStatus(302);
    }
}
<?php

namespace press\app\actions;

use press\app\services\UserService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;

class ProcessLoginAction extends AbstractAction
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $routeContext = RouteContext::fromRequest($request);


        if ($request->getMethod() === 'POST') {
            $username = $request->getParsedBody()['username'];
            $password = $request->getParsedBody()['password'];
        }

        $userService = new UserService();

        try {
            $userService::authenticate($username, $password);
            $url = $routeContext->getRouteParser()->urlFor('home');
        } catch (\Exception $e) {
            //Afficher message d'erreur
            $url = $routeContext->getRouteParser()->urlFor('login');
        }

        return $response->withHeader('Location', $url)->withStatus(302);
    }
}
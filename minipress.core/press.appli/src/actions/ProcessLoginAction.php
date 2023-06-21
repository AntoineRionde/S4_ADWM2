<?php

namespace press\app\actions;

use press\app\services\auth\AuthService;
use press\app\services\auth\InvalidCredentialsException;
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
        $urlLogin = $routeContext->getRouteParser()->urlFor('login');

        if ($request->getMethod() !== 'POST') {
            return $response->withHeader('Location', $urlLogin)->withStatus(302);
        }

        $data = $request->getParsedBody();

        $email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
        $password = filter_var($data['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $url = $routeContext->getRouteParser()->urlFor($data['target']);

        $authService = new AuthService();

        try {
            $user = $authService->authenticate($email, $password);
            $_SESSION['user'] = $user;
        } catch (InvalidCredentialsException $e) {
            $_SESSION['error'] = $e->getMessage();
            $url = $routeContext->getRouteParser()->urlFor('login');
        }

        return $response->withHeader('Location', $url)->withStatus(302);
    }
}
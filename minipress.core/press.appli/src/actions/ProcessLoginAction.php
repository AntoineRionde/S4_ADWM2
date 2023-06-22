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
        $urlTarget = $routeContext->getRouteParser()->urlFor('home');

        if ($request->getMethod() !== 'POST') {
            $urlTarget = $routeContext->getRouteParser()->urlFor('login');
            return $response->withHeader('Location', $urlTarget)->withStatus(302);
        }

        $data = $request->getParsedBody();

        $email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
        $password = filter_var($data['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        try {
            $authService = new AuthService();
            $user = $authService->authenticate($email, $password);
            $_SESSION['user'] = $user;
        } catch (InvalidCredentialsException $e) {
            $_SESSION['error'] = $e->getMessage();
            $urlTarget = $routeContext->getRouteParser()->urlFor('login');
            return $response->withHeader('location', $urlTarget)->withStatus(302);
        }

        if ($data['target'] !== 'none') {
            $urlTarget = $routeContext->getRouteParser()->urlFor($data['target']);
        }

        return $response->withHeader('Location', $urlTarget)->withStatus(302);
    }
}
<?php

namespace press\app\actions;

use Exception;
use press\app\services\auth\AuthService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;

class ProcessRegisterAction extends AbstractAction
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $routeContext = RouteContext::fromRequest($request);
        $urlRegister = $routeContext->getRouteParser()->urlFor('register');


        if ($request->getMethod() !== 'POST') {
            return $response->withHeader('Location', $urlRegister)->withStatus(302);
        }

        $email = filter_var($request->getParsedBody()['username'], FILTER_SANITIZE_EMAIL);
        $password = htmlspecialchars($request->getParsedBody()['password']);
        $confirm_password = htmlspecialchars($request->getParsedBody()['confirm_password']);

        try {
            $authService = new AuthService();
            $authService->register($email, $password, $confirm_password);
        } catch (Exception $e) {
            $urlRegister = $routeContext->getRouteParser()->urlFor('register', [], ['error' => $e->getMessage()]);
        }
        return $response->withHeader('Location', $urlRegister)->withStatus(302);

    }
}
<?php

namespace press\app\actions;

use PHPUnit\Exception;
use press\app\services\user\UserService;
use press\app\services\auth\AuthService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;

class CreateUserAction extends AbstractAction
{

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $routeContext = RouteContext::fromRequest($request);
        $urlRegister = $routeContext->getRouteParser()->urlFor('create-user');

        if ($request->getMethod() !== 'POST') {
            return $response->withHeader('Location', $urlRegister)->withStatus(302);
        }

        $username = filter_var($request->getParsedBody()['username'], FILTER_SANITIZE_EMAIL);
        $password = htmlspecialchars($request->getParsedBody()['password']);
        $role = filter_var($request->getParsedBody()['role'], FILTER_SANITIZE_NUMBER_INT);

        try {
            $authService = new AuthService();
            $authService->register($username, $password, $password);
            if ($role === 1) {
                $userService = new UserService();
                $userService->setRole($username, $role);
            }
        } catch (Exception $e) {
            $urlRegister = $routeContext->getRouteParser()->urlFor('create-user', [], ['error' => $e->getMessage()]);
        }
        return $response->withHeader('Location', $urlRegister)->withStatus(302);
    }
}
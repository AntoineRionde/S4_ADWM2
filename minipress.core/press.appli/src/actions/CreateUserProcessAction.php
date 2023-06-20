<?php

namespace press\app\actions;

use \Exception;
use press\app\services\user\UserService;
use press\app\services\auth\AuthService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;

class CreateUserProcessAction extends AbstractAction
{

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $routeContext = RouteContext::fromRequest($request);
        $urlRegister = $routeContext->getRouteParser()->urlFor('home');

        if ($request->getMethod() !== 'POST') {
            return $response->withHeader('Location', $urlRegister)->withStatus(302);
        }

        $username = filter_var($request->getParsedBody()['username'], FILTER_SANITIZE_EMAIL);
        $password = htmlspecialchars($request->getParsedBody()['password']);
        $role = 0;
        if(isset($request->getParsedBody()['admin'])){
            $role = $request->getParsedBody()['admin'] === 'on' ? 1 : 0;
        }

        try {
            $authService = new AuthService();
            $authService->register($username, $password, $password, $role);

        } catch (Exception $e) {
            $urlRegister = $routeContext->getRouteParser()->urlFor('createUser', [], ['error' => $e->getMessage()]);
        }
        return $response->withHeader('Location', $urlRegister)->withStatus(302);
    }
}
<?php

namespace press\app\actions;

use Exception;
use press\app\services\auth\AuthService;
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

        $email = filter_var($data['username'], FILTER_SANITIZE_EMAIL);
        $password = htmlspecialchars($data['password']);

        $url = $routeContext->getRouteParser()->urlFor($data['target']);


        $authService = new AuthService();

        try {
            $user = $authService->authenticate($email, $password);
            $_SESSION['user'] = $user;
        } catch (Exception $e) {
            $url = $routeContext->getRouteParser()->urlFor('login', [], ['error' => $e->getMessage()]);
        }

        return $response->withHeader('Location', $url)->withStatus(302);
    }
}
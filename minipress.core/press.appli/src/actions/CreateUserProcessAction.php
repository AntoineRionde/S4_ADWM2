<?php

namespace press\app\actions;

use Exception;
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
        $urlHome = $routeContext->getRouteParser()->urlFor('home');

        if ($request->getMethod() !== 'POST') {
            return $response->withHeader('Location', $urlHome)->withStatus(302);
        }

        $email = filter_var($request->getParsedBody()['email'], FILTER_SANITIZE_EMAIL);
        $password = filter_var($request->getParsedBody()['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $role = 0;
        if(isset($request->getParsedBody()['admin'])){
            $role = $request->getParsedBody()['admin'] === 'on' ? 1 : 0;
        }

        try {
            $authService = new AuthService();
            $authService->register($email, $password, $password, $role);
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            $urlCreateUser = $routeContext->getRouteParser()->urlFor('createUser');
            return $response->withHeader('Location', $urlCreateUser)->withStatus(302);
        }

        $url = $routeContext->getRouteParser()->urlFor('home', [], ['success' => 'Le compte a bien été créé.']);
        return $response->withHeader('Location', $url)->withStatus(302);
    }
}
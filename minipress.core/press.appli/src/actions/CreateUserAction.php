<?php

namespace press\app\actions;

use press\app\services\user\AccessControlException;
use press\app\services\user\UserService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class CreateUserAction extends AbstractAction
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();

        if (!isset($_SESSION['user'])) {
            $_SESSION['error'] = 'Vous devez être connecté pour créer une catégorie';
            $urlLogin = $routeParser->urlFor('login', [], ['target' => 'createCategorie']);
            return $response->withHeader('location', $urlLogin)->withStatus(302);
        }
        try {
            UserService::checkAcessRole($_SESSION['user']['id']);
        } catch (AccessControlException $e){
            $_SESSION['error'] = $e->getMessage();
            $urlHome = $routeParser->urlFor('home');
            return $response->withHeader('location', $urlHome)->withStatus(302);
        }

        $error = $_SESSION['error'] ?? "";
        unset($_SESSION['error']);

        $view = Twig::fromRequest($request);
        $view->render($response, 'createUser.twig', ['user' => $_SESSION['user'], 'error' => $error]);
        return $response;
    }
}
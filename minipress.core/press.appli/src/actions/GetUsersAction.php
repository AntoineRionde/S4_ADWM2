<?php

namespace press\app\actions;

use Exception;
use press\app\services\articles\ArticleService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class GetUsersAction extends AbstractAction
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
            $_SESSION['error'] = 'Vous devez être connecté pour accéder à la catégorie';
            $urlLogin = $routeParser->urlFor('login', [], ['target' => 'getUsers']);
            return $response->withHeader('location', $urlLogin)->withStatus(302);
        }

        try {
            $articlesService = new ArticleService();
            $articles = $articlesService->getArticlesByAuteur();
        } catch (Exception $e) {
            $_SESSION['error'] = 'Une erreur est survenue lors de la récupération des articles';
           $url = $routeParser->urlFor('getHome');
           return $response->withHeader('location', $url)->withStatus(302);
        }

        $error = $_SESSION['error'] ?? "";
        unset($_SESSION['error']);

        $view = Twig::fromRequest($request);
        return $view->render($response, 'usersList.twig', ['articles' => $articles, 'user' => $_SESSION['user'], 'error' => $error]);
    }
}
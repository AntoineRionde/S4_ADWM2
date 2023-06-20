<?php

namespace press\app\actions;

use press\app\services\articles\ArticleService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;

class CreateArticleProcessAction extends AbstractAction
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $data['titre'] = htmlspecialchars($data['titre']);
        
        $data['resume'] = htmlspecialchars($data['resume']);
        $data['contenu'] = htmlspecialchars($data['contenu']);

        $data['image'] = filter_var($data['image'], FILTER_SANITIZE_SPECIAL_CHARS);

        $data['auteur'] = $_SESSION['user']['prenom'] . " " . $_SESSION['user']['nom'] ?? $_SESSION['user']['email'];

        $articleService = new ArticleService();
        $articleService->createArticle($data);

        $routeParser = RouteContext::fromRequest($request)->getRouteParser();

        return $response->withHeader('location', $routeParser->urlFor('articles'))->withStatus(302);
    }
}
<?php

namespace press\app\actions;

use Exception;
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
        if ($request->getMethod() !== 'POST') {
            $routeParser = RouteContext::fromRequest($request)->getRouteParser();
            return $response->withHeader('location', $routeParser->urlFor('articles'))->withStatus(302);
        }

        $data = $request->getParsedBody();
        $data['titre'] = htmlspecialchars($data['titre'], ENT_QUOTES, 'UTF-8');

        $data['email'] = $_SESSION['user']['email'];

        $data['image'] = filter_var($data['image'], FILTER_SANITIZE_URL);

        $data['resume'] = htmlspecialchars($data['resume'], ENT_QUOTES, 'UTF-8');
        $data['contenu'] = htmlspecialchars($data['contenu'], ENT_QUOTES, 'UTF-8');

        $data['auteur'] = $_SESSION['user']['prenom'] . " " . $_SESSION['user']['nom'] ?? $_SESSION['user']['email'];

        if (!$data['cat_id']){
            unset($data['cat_id']);
        }

        try {
            $articleService = new ArticleService();
            $articleService->createArticle($data);
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            $routeParser = RouteContext::fromRequest($request)->getRouteParser();
            return $response->withHeader('location', $routeParser->urlFor('createArticle'))->withStatus(302);
        }

        $routeParser = RouteContext::fromRequest($request)->getRouteParser();

        return $response->withHeader('location', $routeParser->urlFor('articles'))->withStatus(302);
    }
}
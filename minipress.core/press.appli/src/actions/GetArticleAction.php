<?php

namespace press\app\actions;

use Slim\Psr7\Response as Response;
use Slim\Psr7\Request as Request;
use press\app\services\articles\ArticleService;
use Slim\Routing\RouteContext;
use Slim\Views\twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class GetArticleAction extends AbstractAction
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $service = new ArticleService();
        $articles = $service->getArticles();

        foreach ($articles as $article) {
            $article['titre'] = html_entity_decode($article['titre']);
        }
        $routeContext = RouteContext::fromRequest($request)->getRouteParser();
        $data = ['articles' => $articles];
        $view = Twig::fromRequest($request);
        return $view->render($response, 'templateArticles.twig', $data);
    }
}

<?php

namespace press\app\actions;

use press\app\services\ArticleService;
use Slim\Psr7\Request as Request;
use Slim\Psr7\Response as Response;
use Slim\Views\twig;

class GetArticleAction extends AbstractAction
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $service = new ArticleService();
        $articles = $service->getArticles();
        $routeContext = \Slim\Routing\RouteContext::fromRequest($request)->getRouteParser();
        $data = ['articles' => $articles];
        $view = Twig::fromRequest($request);
        return $view->render($response, 'templateArticles.twig', $data);
    }
}

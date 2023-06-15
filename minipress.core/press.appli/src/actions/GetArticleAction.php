<?php

namespace press\app\actions;

use Slim\Psr7\Response as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use press\app\models\Article;
use press\app\actions\AbstractAction;
use press\app\services\ArticleService;
use Slim\Views\twig;

class GetArticleAction extends AbstractAction{

    public function __invoke(Request $request, Response $response, array $args) : Response{
        $service = new ArticleService();
        $articles = $service->getArticles();
        $routeContext = \Slim\Routing\RouteContext::fromRequest($request)->getRouteParser();
        $data = ['articles' => $articles];
        $view = Twig::fromRequest($request);
        return $view->render($response, 'templateArticles.twig', $data);
    }
}

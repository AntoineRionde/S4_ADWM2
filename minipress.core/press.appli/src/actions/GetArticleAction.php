<?php

namespace press\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use press\app\models\Article;
use press\app\actions\AbstractAction;
use press\app\services\ArticleService;
use Slim\Views\twig;

class GetArticleAction extends AbstractAction{

    public function __invoke(Request $request, Response $response, array $args){
        $service = new ArticleService();
        $articles = $service->getArticles();
        $routeContext = \Slim\Routing\RouteContext::fromRequest($request)->getRouteParser();
        $data = ['articles' => $articles];
        $view = Twig::fromRequest($request);
        return $view->render($response, 'templateArticles.html.twig', $data);
    }
}

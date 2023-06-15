<?php

namespace press\app\actions;

use press\app\services\ArticleService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;

class CreateArticleProcessAction extends AbstractAction
{

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $data['titre'] = filter_var($data['titre'], FILTER_SANITIZE_SPECIAL_CHARS);
        $data['auteur'] = filter_var($data['auteur'], FILTER_SANITIZE_SPECIAL_CHARS);
        $data['resume'] = filter_var($data['resume'], FILTER_SANITIZE_SPECIAL_CHARS);
        $data['contenu'] = filter_var($data['contenu'], FILTER_SANITIZE_SPECIAL_CHARS);
        $data['date'] = filter_var($data['date'], FILTER_SANITIZE_SPECIAL_CHARS);
        $data['image'] = filter_var($data['image'], FILTER_SANITIZE_SPECIAL_CHARS);

        $articleService = new ArticleService();
        $article = $articleService->createArticle($data);

        $routeParser = RouteContext::fromRequest($request)->getRouteParser();

        return $response->withHeader('location', $routeParser->urlFor('home'))->withStatus(302);
    }
}
<?php

namespace press\app\actions;

use press\app\services\ArticleService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class CreateArticleAction extends AbstractAction
{

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $articleService = new ArticleService();
        $article = $articleService->createArticle($data);
        $response->getBody()->write(json_encode($article));
        return $response->withHeader('Content-Type', 'application/json');
    }
}
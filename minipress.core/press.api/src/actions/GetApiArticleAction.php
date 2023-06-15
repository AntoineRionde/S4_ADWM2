<?php

namespace press\api\actions;

use press\app\actions\AbstractAction;
use press\app\services\ArticleService;
use Slim\Psr7\Response as Response;
use Slim\Psr7\Request as Request;

class GetApiArticleAction extends AbstractAction{

    public function __invoke(Request $request, Response $response, array $args) : Response{
        $service = new ArticleService();
        $articles = $service->getArticles();
        $data = ['articles' => $articles];
        $response->getBody()->write(json_encode($data));
        return
            $response->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
    }
}

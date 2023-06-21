<?php

namespace press\api\actions;

use press\api\services\ArticleService;
use press\api\services\UserService;

use Slim\Psr7\Request as Request;
use Slim\Psr7\Response as Response;

class GetApiArticlesByIdAuteurAction extends AbstractAction
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $service = new ArticleService();
        $article = $service->getArticlesByEmailAuteur(getEmailByUserId($args['id']));
        $data = ['article' => $article];
        $response->getBody()->write(json_encode($data));
        return
            $response->withHeader('Content-Type', 'application/json')
                ->withHeader('Access-Control-Allow-Origin', '*')
                ->withStatus(200);
    }
}
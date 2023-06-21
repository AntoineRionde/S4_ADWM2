<?php

namespace press\api\actions;

use press\api\services\ArticleService;
use press\api\services\UserService;
use Slim\Psr7\Request as Request;
use Slim\Psr7\Response as Response;

class GetApiArticleByIdAction
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $service = new ArticleService();
        $serviceUser = new UserService();
        $article = $service->getArticlePublishedById($args['id_a']);
        $articles['id-auteur'] =$serviceUser->getIdUsersByEmail($service->getEmailByArticleId($args['id_a']));
        $data = ['article' => $article];

        $response->getBody()->write(json_encode($data));
        return
            $response->withHeader('Content-Type', 'application/json')
                ->withHeader('Access-Control-Allow-Origin', '*')
                ->withStatus(200);
    }
}
<?php

namespace press\api\actions;

use press\api\services\ArticleService;
use Slim\Psr7\Response as Response;
use Slim\Psr7\Request as Request;

class GetApiArticleAction extends AbstractAction{

    public function __invoke(Request $request, Response $response, array $args) : Response{
        $service = new ArticleService();
        $articles = $service->getArticles();

        foreach ($articles as $key => $value) {
            $articles[$key]['url']['self']['href'] = 'http://docketu.iutnc.univ-lorraine.fr:45005/api/articles/' . $value['id'];
            unset($articles[$key]['id']);
            unset($articles[$key]['contenu']);
            unset($articles[$key]['resume']);
            unset($articles[$key]['date_publication']);
            unset($articles[$key]['image']);
            unset($articles[$key]['idCateg']);
        }

        $data = ['articles' => $articles];
        $response->getBody()->write(json_encode($data));
        return
            $response->withHeader('Content-Type', 'application/json')
                ->withHeader('Access-Control-Allow-Origin', '*')
                ->withStatus(200);
    }
}
<?php

namespace press\api\actions;

use press\api\services\CategorieService;
use Slim\Psr7\Request as Request;
use Slim\Psr7\Response as Response;

class GetApiCategoriesAction extends AbstractAction
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $service = new CategorieService();
        $cat = $service->getCategories();
        $data = ['categories' => $cat];
        $response->getBody()->write(json_encode($data));
        return
            $response->withHeader('Content-Type', 'application/json')
                ->withHeader('Access-Control-Allow-Origin', '*')
                ->withStatus(200);
    }
}
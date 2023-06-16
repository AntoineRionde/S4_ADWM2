<?php

namespace press\app\actions;

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use press\app\services\CategorieService;

class createCategorieAction extends AbstractAction
{

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $titre = $request->getParsedBody()['titre'];
        $desc = $request->getParsedBody()['description'];

        $service = new CategorieService();
        $categories = $service->getCategories();
        $id = count($categories)+1;

        $data=[
            'id' => $id,
            'titre' => $titre,
            'description' =>$desc
        ];

        $service->create($data);
        $view = Twig::fromRequest($request);
        return $view->render($response, 'createCategorieDone.twig', $data);
    }
}
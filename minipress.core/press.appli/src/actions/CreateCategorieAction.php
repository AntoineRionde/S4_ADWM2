<?php

namespace press\app\actions;

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use press\app\services\categories\CategorieService;
use Slim\Views\twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class CreateCategorieAction extends AbstractAction
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
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

        $categorie = $service->create($data);
        $view = Twig::fromRequest($request);
        return $view->render($response, 'createCategorieDone.twig', $data);
    }
}
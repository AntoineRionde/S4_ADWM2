<?php

namespace press\app\actions;

use press\app\services\categories\CategoryAlreadyExistsException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use press\app\services\categories\CategorieService;
use Slim\Routing\RouteContext;
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
     * @throws \Exception
     */
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $routeContext = RouteContext::fromRequest($request);
        $urlCreateCateg = $routeContext->getRouteParser()->urlFor('register');

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

        try {
            $categorie = $service->create($data);
        } catch (CategoryAlreadyExistsException $ce){
            $_SESSION['error'] = $ce->getMessage();
            $urlCreateCateg = $routeContext->getRouteParser()->urlFor('createCategorie');
        }
        $urlCreateCateg = $routeContext->getRouteParser()->urlFor('categories');
        $view = Twig::fromRequest($request);
        return $response->withHeader('Location', $urlCreateCateg)->withStatus(302);
    }
}
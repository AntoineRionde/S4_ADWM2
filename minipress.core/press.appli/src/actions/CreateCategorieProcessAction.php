<?php

namespace press\app\actions;

use press\app\services\categories\CategoryAlreadyExistsException;
use press\app\services\user\AccessControlException;
use press\app\services\user\UserService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use press\app\services\categories\CategorieService;
use Slim\Routing\RouteContext;
use Slim\Views\twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class CreateCategorieProcessAction extends AbstractAction
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $routeContext = RouteContext::fromRequest($request);
        $routeParser = $routeContext->getRouteParser();

        $titre = $request->getParsedBody()['titre'];
        $desc = $request->getParsedBody()['description'];

        $categorieService = new CategorieService();
        $categories = $categorieService->getCategories();
        $id = count($categories)+1;

        $data=[
            'id' => $id,
            'titre' => $titre,
            'description' =>$desc
        ];

        try {
            $categorieService->createCategory($data);
        } catch (CategoryAlreadyExistsException $ce){
            $_SESSION['error'] = $ce->getMessage();
            $urlCreateCateg = $routeParser->urlFor('createCategorie');
            return $response->withHeader('Location', $urlCreateCateg)->withStatus(302);
        }
        $urlCateg = $routeParser->urlFor('categories');
        return $response->withHeader('Location', $urlCateg)->withStatus(302);
    }
}
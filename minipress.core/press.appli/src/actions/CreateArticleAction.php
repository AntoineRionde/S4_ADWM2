<?php

namespace press\app\actions;

use gift\app\services\utils\CsrfService;
use press\app\models\Categorie;
use press\app\services\articles\ArticleService;
use press\app\services\categories\CategorieService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class CreateArticleAction extends AbstractAction
{

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $view = Twig::fromRequest($request);
        $categService = new CategorieService();
        $categories = $categService->getCategories();
        return $view->render($response, 'createArticle.twig', ['categories' => $categories]);
    }
}
<?php

namespace press\app\actions;

use gift\app\services\utils\CsrfService;
use press\app\models\Categorie;
use press\app\services\ArticleService;
use press\app\services\CategorieService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class CreateArticleAction extends AbstractAction
{

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $view = Twig::fromRequest($request);
        $categService = new CategorieService();
        $categories = $categService->getCategories();
        return $view->render($response, 'createArticle.twig', ['categories' => $categories]);
    }
}
<?php

namespace press\app\actions;

use press\app\services\articles\ArticleService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class GetUsersAction extends AbstractAction
{

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $articlesService = new ArticleService();
        $articles = $articlesService->getArticlesByAuteur();
                
        $view = Twig::fromRequest($request);
        return $view->render($response, 'usersList.twig', ['articles' => $articles]);
    }
}
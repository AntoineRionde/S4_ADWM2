<?php

namespace press\app\actions;

use gift\app\services\utils\CsrfService;
use press\app\services\ArticleService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class CreateArticleAction extends AbstractAction
{

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $view = Twig::fromRequest($request);
        return $view->render($response, 'createArticle.twig');
    }
}
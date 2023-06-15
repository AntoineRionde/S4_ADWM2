<?php


use press\app\actions\GetCategoriesAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

return function (\Slim\App $app): void {
    $app->get('/', function (Request $request, Response $response, array $args) {
        $response->getBody()->write("Hellorld!");
        return $response;
    });

    $app->get('/articles[/]', \press\app\actions\GetArticleAction::class)->setName("articles");
    $app->get('/categories[/]',\press\app\actions\GetCategoriesAction::class)->setName("categories");
    
};

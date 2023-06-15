<?php

use press\api\actions\GetApiArticleAction;
use press\api\actions\GetApiCategoriesAction;
use press\app\actions\CreateArticleAction;
use press\app\actions\CreateArticleProcessAction;
use press\app\actions\GetArticleAction;
use press\app\actions\GetCategoriesAction;
use press\app\actions\GetHomeAction;
use Slim\App;

return function (App $app): void {

    $app->get('/', GetHomeAction::class)->setName('home');
    $app->get('/articles[/]', GetArticleAction::class)->setName("articles");
    $app->get('/categories[/]', GetCategoriesAction::class)->setName("categories");

    //Routes to API
    $app->get('/api/articles[/]', GetApiArticleAction::class)->setName("articlesApi");
    $app->get('/api/categories[/]', GetApiCategoriesAction::class)->setName("categoriesApi");

    $app->get('/createArticle[/]', CreateArticleAction::class)->setName('createArticle');
    $app->post('/createArticle[/]', CreateArticleProcessAction::class)->setName('createArticlePost');

};

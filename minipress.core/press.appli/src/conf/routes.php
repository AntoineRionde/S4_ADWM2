<?php

use press\api\actions\GetApiArticleAction;
use press\api\actions\GetApiCategoriesAction;
use press\app\actions\CreateArticleAction;
use press\app\actions\CreateArticleProcessAction;
use press\app\actions\GetArticleAction;
use press\app\actions\GetCategoriesAction;
use press\app\actions\GetHomeAction;
use press\app\actions\GetCreateCategorieFormAction;
use press\app\actions\createCategorieAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use press\app\actions\loginAction;
use Slim\App;

return function (App $app): void {

    $app->get('/', GetHomeAction::class)->setName('home');
    $app->get('/articles[/]', GetArticleAction::class)->setName("articles");
    $app->get('/categories[/]', GetCategoriesAction::class)->setName("categories");
    $app->get('/createCategorie',GetCreateCategorieFormAction::class)->setName('CreateCategorie');
    $app->post('/createcategorie/done[/]',createCategorieAction::class)->setName('categorie created');
    $app->get('/login[/]', LoginAction::class)->setName("login");
    $app->post('/LoginAction[/]', \press\app\actions\ProcessLoginAction::class)->setName("loginAction");

    //Routes to API
    $app->get('/api/articles[/]', GetApiArticleAction::class)->setName("articlesApi");
    $app->get('/api/categories[/]', GetApiCategoriesAction::class)->setName("categoriesApi");

    $app->get('/createArticle[/]', CreateArticleAction::class)->setName('createArticle');
    $app->post('/createArticle[/]', CreateArticleProcessAction::class)->setName('createArticlePost');
};

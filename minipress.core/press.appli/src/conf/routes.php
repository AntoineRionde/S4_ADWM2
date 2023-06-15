<?php

use press\api\actions\GetApiArticleAction;
use press\api\actions\GetApiCategoriesAction;
use press\app\actions\CreateArticleAction;
use press\app\actions\CreateArticleProcessAction;
use press\app\actions\GetArticleAction;
use press\app\actions\GetCategoriesAction;
use press\app\actions\GetHomeAction;
use press\app\actions\loginAction;
use press\app\actions\ProcessLoginAction;
use press\app\actions\ProcessRegisterAction;
use press\app\actions\RegisterAction;
use Slim\App;

return function (App $app): void {

    $app->get('/', GetHomeAction::class)->setName('home');
    $app->get('/articles[/]', GetArticleAction::class)->setName("articles");
    $app->get('/categories[/]', GetCategoriesAction::class)->setName("categories");

    //Routes to register
    $app->get('/register[/]', RegisterAction::class)->setName("register");
    $app->post('/register-action[/]', ProcessRegisterAction::class)->setName("registerAction");

    //Routes to login
    $app->get('/login[/]', LoginAction::class)->setName("login");
    $app->post('/login-action[/]', ProcessLoginAction::class)->setName("loginAction");

    //Routes to API
    $app->get('/api/articles[/]', GetApiArticleAction::class)->setName("articlesApi");
    $app->get('/api/categories[/]', GetApiCategoriesAction::class)->setName("categoriesApi");

    $app->get('/createArticle[/]', CreateArticleAction::class)->setName('createArticle');
    $app->post('/createArticle[/]', CreateArticleProcessAction::class)->setName('createArticlePost');

};

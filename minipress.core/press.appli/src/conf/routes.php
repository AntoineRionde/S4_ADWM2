<?php

use press\api\actions\GetApiArticleAction;
use press\api\actions\GetApiCategoriesAction;
use press\app\actions\CreateArticleAction;
use press\app\actions\CreateArticleProcessAction;
use press\app\actions\createCategorieAction;
use press\app\actions\GetArticleAction;
use press\app\actions\GetCategoriesByIdAction;
use press\app\actions\GetCategoriesAction;
use press\app\actions\GetCreateCategorieFormAction;
use press\app\actions\GetHomeAction;
use press\app\actions\GetArticlesByCategorie;
use press\app\actions\LoginAction;
use press\app\actions\LoginErrorAction;
use press\app\actions\LoginVerifyAction;
use press\app\actions\LogoutAction;
use press\app\actions\ProcessLoginAction;
use press\app\actions\ProcessRegisterAction;
use press\app\actions\RegisterAction;
use Slim\App;

return function (App $app): void {

    $app->get('/', GetHomeAction::class)->setName('home');

    // Routes de vérification de connection (Redirection)
    $app->get('/login-verify/{target}[/]', LoginVerifyAction::class)->setName('loginVerify');

    // Routes to articles
    $app->get('/articles[/]', GetArticleAction::class)->setName("articles");
    $app->get('/createArticle[/]', CreateArticleAction::class)->setName('createArticle');
    $app->post('/createArticle[/]', CreateArticleProcessAction::class)->setName('createArticlePost');

    // Routes to categories
    $app->get('/categories[/]', GetCategoriesAction::class)->setName("categories");
    $app->get('/categories/{id:\d+}[/]', GetCategoriesByIdAction::class)->setName('getCategoriesByIdAction');
    $app->get('/categories/{id:\d+}/articles', GetArticlesByCategorie::class)->setName('getArticlesByCategorie');

    $app->get('/create-categorie',GetCreateCategorieFormAction::class)->setName('createCategorie');
    $app->post('/create-categorie/done[/]',createCategorieAction::class)->setName('categorie created');

    //Routes to register
    $app->get('/register[/]', RegisterAction::class)->setName("register");
    $app->post('/register-action[/]', ProcessRegisterAction::class)->setName("registerAction");

    //Routes to login
    $app->get('/login', LoginAction::class)->setName("login");
    $app->post('/login-action[/]', ProcessLoginAction::class)->setName("loginAction");

    //Routes to logout
    $app->get('/logout', LogoutAction::class)->setName("logout");

    //Routes to API
    $app->get('/api/articles[/]', GetApiArticleAction::class)->setName("articlesApi");
    $app->get('/api/categories[/]', GetApiCategoriesAction::class)->setName("categoriesApi");
};

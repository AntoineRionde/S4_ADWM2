<?php

use press\app\actions\CreateArticleAction;
use press\app\actions\CreateArticleProcessAction;
use press\app\actions\CreateCategorieAction;
use press\app\actions\CreateUserAction;
use press\app\actions\CreateUserProcessAction;
use press\app\actions\GetArticleAction;
use press\app\actions\GetArticlesByCategorie;
use press\app\actions\GetCategoriesAction;
use press\app\actions\GetCategoriesByIdAction;
use press\app\actions\GetCreateCategorieFormAction;
use press\app\actions\GetHomeAction;
use press\app\actions\LoginAction;
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

    $app->get('/create-categorie', GetCreateCategorieFormAction::class)->setName('createCategorie');
    $app->post('/create-categorie', CreateCategorieAction::class)->setName('categorie created');

    //Routes to register
    $app->get('/register[/]', RegisterAction::class)->setName("register");
    $app->post('/register[/]', ProcessRegisterAction::class)->setName("registerAction");

    //Routes to login
    $app->get('/login', LoginAction::class)->setName("login");
    $app->post('/login', ProcessLoginAction::class)->setName("loginAction");

    //Routes to logout
    $app->get('/logout', LogoutAction::class)->setName("logout");

    //route de création d'utilisateur par admin
    $app->get('/createUser[/]', CreateUserAction::class)->setName("createUser");
    $app->post('/createUser[/]', CreateUserProcessAction::class)->setName("createUserPost");

};

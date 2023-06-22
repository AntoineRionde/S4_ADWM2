<?php

use press\app\actions\CreateArticleAction;
use press\app\actions\CreateArticleProcessAction;
use press\app\actions\CreateCategorieProcessAction;
use press\app\actions\CreateUserAction;
use press\app\actions\CreateUserProcessAction;
use press\app\actions\GetArticlesAction;
use press\app\actions\GetCategoriesAction;
use press\app\actions\GetCategoriesByIdAction;
use press\app\actions\CreateCategorieAction;
use press\app\actions\GetHomeAction;
use press\app\actions\LoginAction;
use press\app\actions\LogoutAction;
use press\app\actions\ProcessLoginAction;
use press\app\actions\ProcessRegisterAction;
use press\app\actions\RegisterAction;
use press\app\actions\GetUsersAction;
use press\app\actions\PublishArticlesAction;
use Slim\App;

return function (App $app): void {

    $app->get('/', function ($request, $response, $args) {
        return $response->withHeader('Location', '/home')->withStatus(302);
    });

    $app->get('/home', GetHomeAction::class)->setName('home');

    // Routes to articles
    $app->get('/articles[/]', GetArticlesAction::class)->setName("articles");
    $app->get('/articles/{id:\d+}[/]', GetArticlesAction::class)->setName('getArticle');
    $app->get('/create-article[/]', CreateArticleAction::class)->setName('createArticle');
    $app->get('/publishArticles[/]', PublishArticlesAction::class)->setName('publishArticles');
    $app->post('/create-article[/]', CreateArticleProcessAction::class)->setName('createArticlePost');

    // Routes to categories
    $app->get('/categories[/]', GetCategoriesAction::class)->setName("categories");
    $app->get('/categories/{id:\d+}/articles', GetCategoriesByIdAction::class)->setName('getCategoriesById');

    $app->get('/create-categorie', CreateCategorieAction::class)->setName('createCategorie');
    $app->post('/create-categorie', CreateCategorieProcessAction::class)->setName('createCategorieAction');



    //Routes to register
    $app->get('/register[/]', RegisterAction::class)->setName("register");
    $app->post('/register[/]', ProcessRegisterAction::class)->setName("registerAction");

    //Routes to login
    $app->get('/login', LoginAction::class)->setName("login");
    $app->post('/login', ProcessLoginAction::class)->setName("loginAction");

    //Routes to logout
    $app->get('/logout', LogoutAction::class)->setName("logout");

    //Routes to users
    $app->get('/users[/]', GetUsersAction::class)->setName("getUsers");
    //Route to create user with admin
    $app->get('/create-user[/]', CreateUserAction::class)->setName("createUser");
    $app->post('/create-user[/]', CreateUserProcessAction::class)->setName("createUserPost");
};

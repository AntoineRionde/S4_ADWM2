<?php

use press\api\actions\GetApiArticleAction;
use press\api\actions\GetApiArticleByCategorieAction;
use press\api\actions\GetApiArticleByIdAction;
use press\api\actions\GetApiCategoriesAction;
use Slim\App;

return function (App $app): void {

    //Routes to API
    $app->get('/api/articles[/]', GetApiArticleAction::class)->setName("articlesApi");
    $app->get('/api/categories[/]', GetApiCategoriesAction::class)->setName("categoriesApi");
    $app->get('/api/categories/{cat_id}/articles', GetApiArticleByCategorieAction::class)->setName("articlesByCategoriesApi");
    $app->get('/api/articles/{id_a}', GetApiArticleByIdAction::class)->setName("articleByIdApi");
    $app->get('/api/auteurs/{id_auteur}/articles', GetApiArticlesByIdAuteur::class)->setName("articlesByAuteurApi");
};

<?php

namespace press\app\services;

use press\app\models\Article;
use Slim\Exception\HttpBadRequestException;

class ArticleService{

    function getArticles(){
        $articles = Categorie::all();
        return $articles;
    }
}
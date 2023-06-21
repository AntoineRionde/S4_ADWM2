<?php

namespace press\api\services;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use press\api\models\Article;

class ArticleService
{
    public function getPublishedArticles() : array
    {
        try {
            return Article::where('date_publication', '<=', date_create()->format('Y-m-d H:i:s'))->get()->toArray();
        } catch (ModelNotFoundException $e) {
            throw new Exception("Aucun article n'est publié");
        }
    }

    public function getArticlesPublishedByCategorieId(int $cat_id) : array
    {
        try {
            return Article::where('cat_id', $cat_id)->where('date_publication', '<=', date_create()->format('Y-m-d H:i:s'))->get()->toArray();
        } catch (ModelNotFoundException $e) {
            throw new Exception("L'id de la catégorie n'est pas renseigné");
        }
    }

    public function getArticlePublishedById(int $id_a) : array
    {
        try {
            return Article::where('id', $id_a)->where('date_publication', '<=', date_create()->format('Y-m-d H:i:s'))->firstOrFail()->toArray();
        } catch (ModelNotFoundException $e) {
            throw new Exception("L'id de l'article n'est pas renseigné");
        }
    }

    function getEmailByUserId(int $id): string
    {
        try {
            return User::findOrFail($id)->email;
        } catch (ModelNotFoundException $e) {
            throw new Exception("L'id de l'utilisateur n'est pas renseigné");
        }
    }

    
    function getArticlesByEmailAuteur(int $email): array
    {
        try {
            return Article::where('email', $email)->get()->toArray();
        } catch (ModelNotFoundException $e) {
            throw new Exception("L'id de l'auteur n'est pas renseigné");
        }
    }

}
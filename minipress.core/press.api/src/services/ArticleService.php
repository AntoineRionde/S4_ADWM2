<?php

namespace press\api\services;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use press\api\models\Article;
use press\api\models\Categorie;
use Slim\Exception\HttpBadRequestException;

class ArticleService{

    /**
     * Méthode permettant de récupérer tous les articles
     * @return array $articles
     */
    function getArticles(): array
    {
        $articles = Article::all();
        return $articles->toArray();
    }


    /**
     * Méthode permettant de récupérer un article par son id
     * @param int $id
     * @return array $article
     * @throws Exception $e
     */
    function getArticleById(int $id) : array {
        try {
            return Article::findOrFail($id)->toArray();
        }catch(\Exception $e) {
            throw new \Exception( "L'id de l'article n'est pas renseigné");
        }
    }

    /**
     * Méthode permettant de créer un article
     * @param array $data
     * @return array $article
     */
    function createArticle(array &$data): array
    {
        $article = new Article();
        $article->titre = $data['titre'];
        $article->date_creation = date_create()->format('Y-m-d H:i:s');
        $article->auteur = $data['auteur'];
        $article->resume = $data['resume'];
        $article->contenu = $data['contenu'];
        $article->date_publication = date_create()->format('Y-m-d H:i:s');

        if ($data['image'] === '') {
            $data['image'] = null;
        }
        $article->image = $data['image'];

        $article->cat_id = $data['cat_id'];
        $article->save();
        return $article->toArray();
    }

    /**
     * Méthode permettant de supprimer un article
     * @param int $idArt
     * @return array $article
     */
    function deleteArticle(int $idArt): array
    {
        try {
            $article = Article::findOrFail($idArt);
            $article->delete();
            return $article->toArray();
        }catch(\Exception $e) {
            throw new \Exception( "L'id de l'article n'est pas renseigné");
        }
    }
    /**
     * Méthode permettant de mettre à jour un article
     * @param int $idArt
     * @param array $data
     * @return array $article
     */
    function updateArticle(int $idArt, array $data) : array {
        try {
            $article = Article::findOrFail($idArt);
            $article->titre = $data['titre'];
            $article->contenu = $data['contenu'];
            $article->cat_id = $data['idCateg'];
            $article->save();
            return $article->toArray();
        }catch(\Exception $e) {
            throw new \Exception( "L'id de l'article n'est pas renseigné");
        }
    }

    /**
     * Méthode permettant de récupérer les articles d'une catégorie
     * @param int $id id de la catégorie
     * @return array $articles
     * @throws Exception $e
     */
    public function getArticlesByCategorieId($id) : array {
        try {
            return Article::where('cat_id', $id)->get()->toArray();
        }catch(ModelNotFoundException $e) {
                throw new Exception("L'id de la catégorie n'est pas renseigné");
        }
    }

    public function getPublishedArticles()
    {
        return Article::where('date_publication', '<=', date_create()->format('Y-m-d H:i:s'))->get()->toArray();
    }


}
<?php

namespace press\app\services;

use press\app\models\Article;
use press\app\models\Categorie;
use Exception;

class ArticleService{

    /**
     *
     * @return array $articles
     */
    function getArticles(){
        $articles = Categorie::all();
        return $articles;
    }

    function getArticleById(int $id){
        try {
            return Article::findOrFail($id)->toArray();
        }catch(\Exception $e) {
            throw new \Exception( "L'id de l'article n'est pas renseigné");
        }
    }

    /**
     * @param array $data
     * @return array $article
     */
    function createArticle(array $data){
        $article = new Article();
        $article->titre = $data['titre'];
        $article->contenu = $data['contenu'];
        $article->idCateg = $data['idCateg'];
        $article->save();
        return $article->toArray();
    }

    /**
     * @param int $idArt
     * @return array $article
     */
    function deleteArticle($idArt){
        try {
            $article = Article::findOrFail($idArt);
            $article->delete();
            return $article->toArray();
        }catch(\Exception $e) {
            throw new \Exception( "L'id de l'article n'est pas renseigné");
        }
    }
    /**
     * @param int $idArt
     * @param array $data
     * @return array $article
     */
    function updateArticle($idArt, array $data){
        try {
            $article = Article::findOrFail($idArt);
            $article->titre = $data['titre'];
            $article->contenu = $data['contenu'];
            $article->idCateg = $data['idCateg'];
            $article->save();
            return $article->toArray();
        }catch(\Exception $e) {
            throw new \Exception( "L'id de l'article n'est pas renseigné");
        }
    }

    function getArticlesByCategorie($idCat){
        try {
            $articles = Article::where('idCateg', $idCat)->get();
            return $articles->toArray();
        }catch(\Exception $e) {
            throw new \Exception( "L'id de la catégorie n'est pas renseigné");
        }
    }




}
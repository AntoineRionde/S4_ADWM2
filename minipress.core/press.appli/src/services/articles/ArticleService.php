<?php

namespace press\app\services\articles;

use cebe\markdown\Markdown;
use Exception;
use press\app\models\Article;

class ArticleService
{

    /**
     * Méthode permettant de récupérer tous les articles
     * @return array $articles
     */
    function getArticles(): array
    {
        $articles = Article::all();

        $parser = new Markdown();
        $parser->html5 = true;
        $parser->keepListStartNumber = true;
        foreach ($articles as $art) {
            // chaque resume et contenu d'un article est converti en html
            $art['resume'] = $parser->parse($art['resume']);
            $art['contenu'] = $parser->parse($art['contenu']);
        }

        return $articles->toArray();
    }

    /**
     * Méthode permettant de récupérer un article par son id
     * @param int $id
     * @return array $article
     * @throws Exception $e
     */
    function getArticleById(int $id): array
    {
        try {
            return Article::findOrFail($id)->toArray();
        } catch (Exception $e) {
            //TODO : modifier exception
            throw new Exception("L'id de l'article n'est pas renseigné");
        }
    }

    /**
     * Méthode permettant de créer un article
     * @param array $data
     */
    function createArticle(array $data): void
    {
        //pens

        $article = new Article();
        $article->titre = $data['titre'];
        $article->date_creation = date_create()->format('Y-m-d H:i:s');
        $article->auteur = $data['auteur'];
        $article->email = $data['email'];


        $article->resume = htmlspecialchars_decode(str_replace("&#13;&#10;", "", $data['resume']));
        $article->contenu = htmlspecialchars_decode(str_replace("&#13;&#10;", "", $data['contenu']));

        $article->image = $data['image'];
        $article->cat_id = $data['cat_id'];

        $article->save();
    }

    /**
     * Méthode permettant de supprimer un article
     * @param int $idArt
     * @return array $article
     * @throws Exception
     */
    function deleteArticle(int $idArt): array
    {
        try {
            $article = Article::findOrFail($idArt);
            $article->delete();
            return $article->toArray();
        } catch (Exception $e) {
            //TODO : modifier exception
            throw new Exception("L'id de l'article n'est pas renseigné");
        }
    }

    /**
     * Méthode permettant de mettre à jour un article
     * @param int $idArt
     * @param array $data
     * @return array $article
     * @throws Exception
     */
    function updateArticle(int $idArt, array $data): array
    {
        try {
            $article = Article::findOrFail($idArt);
            $article->titre = $data['titre'];
            $article->contenu = $data['contenu'];
            $article->cat_id = $data['cat_id'];
            $article->save();
            return $article->toArray();
        } catch (Exception $e) {
            //TODO : modifier exception
            throw new Exception("L'id de l'article n'est pas renseigné");
        }
    }


    /**
     * Méthode permettant de récupérer les articles d'une catégorie
     * @param int $id id de la catégorie
     * @return array $articles
     * @throws Exception $e
     */
    public function getArticlesByCategorieId(int $id): array
    {
        try {
            return Article::where('cat_id', $id)->get()->toArray();
        } catch (Exception $e) {
            //TODO : modifier exception
            throw new Exception("L'id de la catégorie n'est pas renseigné");
        }
    }

    public function getPublishedArticles()
    {
        return Article::where('date_publication', '<=', date_create()->format('Y-m-d H:i:s'))->get()->toArray();
    }

}
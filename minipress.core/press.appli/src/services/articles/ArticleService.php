<?php

namespace press\app\services\articles;

use cebe\markdown\Markdown;
use Exception;
use press\app\models\Article;
use press\app\services\categories\IdCategorieException;

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
            throw new IdCategorieException();
        }
    }

    public function getPublishedArticles()
    {
        return Article::where('date_publication', '<=', date_create()->format('Y-m-d H:i:s'))->get()->toArray();
    }
    

}
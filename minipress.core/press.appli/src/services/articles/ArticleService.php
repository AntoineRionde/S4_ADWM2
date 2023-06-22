<?php

namespace press\app\services\articles;


use Exception;
use Parsedown;
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

        $parsedown = new Parsedown();
        foreach ($articles as &$art) {
            $art['resume'] = $parsedown->text($art['resume']);
            $art['contenu'] = $parsedown->text($art['contenu']);
        }
        unset($art);

        return $articles->toArray();
    }

    /**
     * Méthode permettant de créer un article
     * @param array $data
     */
    function createArticle(array $data): void
    {
        $article = new Article();
        $article->titre = $data['titre'];
        $article->date_creation = date_create()->format('Y-m-d H:i:s');
        $article->auteur = $data['auteur'];
        $article->email = $data['email'];

        $article->resume = $data['resume'];
        $article->contenu = $data['contenu'];


        $article->image = $data['image'];
        if (isset($data['cat_id'])) {
            $article->cat_id = $data['cat_id'];
        }

        $article->save();
    }


    /**
     * Méthode permettant de récupérer les articles d'une catégorie
     * @param int $id id de la catégorie
     * @return array $articles
     * @throws IdCategorieException
     */
    public function getArticlesByCategorieId(int $id): array
    {
        try {
            $articles = Article::where('cat_id', $id)->get()->toArray();
            $parsedown = new Parsedown();
            foreach ($articles as &$art) {
                $art['resume'] = $parsedown->text($art['resume']);
                $art['contenu'] = $parsedown->text($art['contenu']);
            }
            return $articles;
        } catch (Exception $e) {
            throw new IdCategorieException();
        }
    }

    public function getPublishedArticles()
    {
        return Article::where('date_publication', '<=', date_create()->format('Y-m-d H:i:s'))->get()->toArray();
    }


    public function getArticlesByAuteur()
    {
        return Article::select('email', 'titre')->distinct()->get()->toArray();
    }

    public function sortArticlesByDate(array $articles) : array
    {
        usort($articles, function ($a, $b) {
            return $a['date_publication'] <=> $b['date_publication'];
        });
        return $articles;
    }

}
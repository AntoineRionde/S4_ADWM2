<?php

namespace press\app\actions;

use Exception;
use Slim\Psr7\Response as Response;
use Slim\Psr7\Request as Request;
use press\app\services\articles\ArticleService;
use Slim\Routing\RouteContext;
use Slim\Views\twig;
class PublishArticlesAction extends AbstractAction
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        
        if (!isset($_SESSION['user'])) {
            $_SESSION['error'] = 'Vous devez être connecté pour accéder à cette page';
            $urlLogin = $routeParser->urlFor('login', [], ['target' => 'articles']);
            return $response->withHeader('Location', $urlLogin)->withStatus(302);
        }

        $queryParams = $request->getQueryParams();
        $id = $queryParams['id'] ?? null;
        $publish = $queryParams['publish'] ?? null;
        $service = new ArticleService();
        try {
            $articles = $service->getArticles();
            $sortedArticles = $service->sortArticlesByDate($articles);

            if($publish=="true"){
                $service->publishArticle($id);
                $_SESSION['sucess'] = 'L\'article a bien été publié';
            }else if($publish=="false"){
                $service->unpublishArticle($id);
                $_SESSION['sucess'] = 'L\'article a bien été dépublié';
            }
        } catch (Exception $e) {
            $_SESSION['error'] = 'Une erreur est survenue lors de la récupération des articles';
            $urlHome = $routeParser->urlFor('getHome');
            return $response->withHeader('Location', $urlHome)->withStatus(302);
        }

        $error = $_SESSION['error'] ?? "";
        unset($_SESSION['error']);

        $success = $_SESSION['success'] ?? "";
        unset($_SESSION['success']);

        $data = ['articles' => $sortedArticles, 'user' => $_SESSION['user'], 'error' => $error, 'success' => $success];
        $view = Twig::fromRequest($request);
        return $view->render($response, 'publishArticles.twig', $data); 

        
    }
}

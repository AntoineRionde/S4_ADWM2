<?php
namespace press\app\actions;

use Exception;
use press\app\services\categories\IdCategorieException;
use Slim\Psr7\Response as Response;
use Slim\Psr7\Request as Request;
use press\app\services\articles\ArticleService;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class GetCategoriesByIdAction extends AbstractAction
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $routeContext = RouteContext::fromRequest($request);
        $routeParser = $routeContext->getRouteParser();

        if (!isset($args['id']) && !is_numeric($args['id'])) {
            $url = $routeParser->urlFor('categories');
            return $response->withHeader('location',$url)->withStatus(302);
        }

        if (!isset($_SESSION['user'])) {
            $_SESSION['error'] = 'Vous devez être connecté pour accéder à la catégorie';
            $urlLogin = $routeParser->urlFor('login', [], ['target' => 'categories']);
            return $response->withHeader('location', $urlLogin)->withStatus(302);
        }

        $service = new ArticleService();
        try{
            $articles = $service->getArticlesByCategorieId($args['id']);
        } catch (IdCategorieException $ie){
            $_SESSION['error'] = $ie->getMessage();
            $url = $routeParser->urlFor('categories');
            return $response->withHeader('location',$url)->withStatus(302);
        }

        $error = "";
        if (isset($_SESSION['error'])) {
            $error = $_SESSION['error'];
            unset($_SESSION['error']);
        }


        $data = ['articles' => $articles, 'user' => $_SESSION['user'], 'error' => $error];
        $view = Twig::fromRequest($request);
        return $view->render($response, 'categoriesByIdAction.twig', $data);
    }
}
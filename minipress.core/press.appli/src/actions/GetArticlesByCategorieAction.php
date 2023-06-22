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

class GetArticlesByCategorieAction extends AbstractAction
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     * @throws Exception
     */
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $routeContext = RouteContext::fromRequest($request);
        $urlGet = $routeContext->getRouteParser()->urlFor('getArticlesByCategorie');

        if (isset($args['id']) && !is_numeric($args['id'])) {
            throw new Exception("La catégorie n'existe pas");
        }

        $service = new ArticleService();
        try{
            $articles = $service->getArticlesByCategorieId($args['id']);
        } catch (IdCategorieException $ie){
            $_SESSION['error'] = $ie->getMessage();
            $urlGet = $routeContext->getRouteParser()->urlFor('getArticlesByCategorie');
        }
        //$routeParser = RouteContext::fromRequest($request)->getRouteParser();

        foreach ($articles as $index => $art) {
            $articles[$index]['url'] = '/articles?id=' . $art['id'];
        }
        $data = ['cat_id' => $args['id'], 'articles_liste' => $articles];
        $view = Twig::fromRequest($request);
        return $view->render($response, 'articlesByCategorie.twig', $data);
    }
}
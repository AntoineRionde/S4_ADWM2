<?php
namespace press\app\actions;

use Exception;
use Slim\Exception\HttpBadRequestException;
use Slim\Psr7\Response as Response;
use Slim\Psr7\Request as Request;
use press\app\services\articles\ArticleService;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class GetArticlesByCategorie extends AbstractAction
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();
    }

    //TODO à vérifier

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     * @throws Exception
     */
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        if (isset($args['id']) && !is_numeric($args['id'])) {
            throw new HttpBadRequestException($request, "La catégorie n'existe pas");
        }
        $service = new ArticleService();
        $articles = $service->getArticlesByCategorieId($args['id']);

        $routeParser = RouteContext::fromRequest($request)->getRouteParser();

        foreach ($articles as $index => $art) {
            $articles[$index]['url'] = '/articles?id=' . $art['id'];

        }
        $data = ['idCateg' => $args['id'], 'articles_liste' => $articles];
        $view = Twig::fromRequest($request);
        return $view->render($response, 'articlesByCategorie.twig', $data);
    }
}
<?php
namespace press\app\actions;


use Slim\Psr7\Response as Response;
use Slim\Psr7\Request as Request;
use Slim\Exception\HttpBadRequestException;
use press\app\services\categories\CategorieService;
use Slim\Views\Twig;

class GetCategoriesByIdAction extends AbstractAction
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {

        if(!isset($args['id'])){
            throw new HttpBadRequestException($request);
        }
        else {
            $categorieService = new CategorieService();
            $cat = $categorieService->getCategorieById($args['id']);


        }
        $routeContext = \Slim\Routing\RouteContext::fromRequest($request);

        $url = $routeContext->getRouteParser()->urlFor('getArticlesByCategorie', ['id' => $args['id']]);
        $cat['url_articles'] = $url;

        $view = Twig::fromRequest($request);
        return $view->render($response, 'categoriesByIdAction.twig', $cat);
    }
}
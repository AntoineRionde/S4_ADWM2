<?php
namespace press\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use press\app\models\Categorie;
use Slim\Exception\HttpBadRequestException;
use press\app\actions\AbstractAction;
use press\app\services\CategorieService;
use Slim\Views\Twig;

class GetCategoriesAction extends AbstractAction
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $service = new CategorieService();
        $cat = $service->getCategories();       
        $data = ['categories' => $cat];
        $view = Twig::fromRequest($request);
        return $view->render($response, 'categories.twig', $data);

    }
}
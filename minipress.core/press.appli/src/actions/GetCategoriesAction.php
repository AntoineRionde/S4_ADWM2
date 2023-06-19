<?php
namespace press\app\actions;

use Slim\Psr7\Response as Response;
use Slim\Psr7\Request as Request;
use press\app\services\categories\CategorieService;
use Slim\Views\Twig;

class GetCategoriesAction extends AbstractAction
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();
    }
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $service = new CategorieService();
        $cat = $service->getCategories();       
        $data = ['categories' => $cat];
        $view = Twig::fromRequest($request);
        return $view->render($response, 'categories.twig', $data);

    }
}
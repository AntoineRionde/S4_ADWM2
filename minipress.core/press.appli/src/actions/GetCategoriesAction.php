<?php
namespace press\app\actions;

use Slim\Psr7\Response as Response;
use Slim\Psr7\Request as Request;
use press\app\services\categories\CategorieService;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class GetCategoriesAction extends AbstractAction
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
     */
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $error = $_SESSION['error'] ?? "";
        unset($_SESSION['error']);
        $service = new CategorieService();
        $cat = $service->getCategories();       
        $data = ['categories' => $cat, 'error' => $error];
        $view = Twig::fromRequest($request);
        return $view->render($response, 'categories.twig', $data);

    }
}
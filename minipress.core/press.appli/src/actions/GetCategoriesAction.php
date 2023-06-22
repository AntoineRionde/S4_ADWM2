<?php
namespace press\app\actions;

use Exception;
use Slim\Psr7\Response as Response;
use Slim\Psr7\Request as Request;
use press\app\services\categories\CategorieService;
use Slim\Routing\RouteContext;
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

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        if (!isset($_SESSION['user'])) {
            $_SESSION['error'] = 'Vous devez être connecté pour accéder à la catégorie';
            $urlLogin = $routeParser->urlFor('login', [], ['target' => 'categories']);
            return $response->withHeader('location', $urlLogin)->withStatus(302);
        }

        try {
            $service = new CategorieService();
            $cat = $service->getCategories();
        } catch (Exception $e) {
            $_SESSION['error'] = 'Une erreur est survenue lors de la récupération des catégories';
            $urlHome = $routeParser->urlFor('home');
            return $response->withHeader('location', $urlHome)->withStatus(302);
        }

        $error = $_SESSION['error'] ?? "";
        unset($_SESSION['error']);

        $data = ['categories' => $cat, 'error' => $error, 'user' => $_SESSION['user']];
        $view = Twig::fromRequest($request);
        return $view->render($response, 'categories.twig', $data);

    }
}
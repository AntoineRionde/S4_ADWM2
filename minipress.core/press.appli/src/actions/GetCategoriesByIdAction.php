<?php

namespace press\app\actions;


use Exception;
use press\app\services\categories\CategorieService;
use press\app\services\user\AccessControlException;
use press\app\services\user\UserService;
use Slim\Psr7\Request as Request;
use Slim\Psr7\Response as Response;
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

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $routeContext = RouteContext::fromRequest($request);
        $routeParser = $routeContext->getRouteParser();

        if (!isset($args['id'])) {
            $_SESSION['error'] = 'L\'identifiant de la catégorie est manquant';
            $urlHome = $routeParser->urlFor('home');
            return $response->withHeader('location', $urlHome)->withStatus(302);
        }

        if (!isset($_SESSION['user'])) {
            $_SESSION['error'] = 'Vous devez être connecté pour accéder à la catégorie';
            $urlLogin = $routeParser->urlFor('login', [], ['target' => 'categories/' . $args['id']]);
            return $response->withHeader('location', $urlLogin)->withStatus(302);
        }


        try {
            $categorieService = new CategorieService();
            $categorieService->getCategorieById($args['id']);
        } catch (Exception $e) {
            $_SESSION['error'] = 'La catégorie n\'existe pas';
            $urlHome = $routeParser->urlFor('home');
            return $response->withHeader('location', $urlHome)->withStatus(302);
        }

        $url = $routeContext->getRouteParser()->urlFor('getArticlesByCategorie', ['id' => $args['id']]);

        $error = $_SESSION['error'] ?? "";
        unset($_SESSION['error']);

        $view = Twig::fromRequest($request);
        return $view->render($response, 'categoriesByIdAction.twig', ['url_articles' => $url, 'error' => $error, 'user' => $_SESSION['user']]);
    }
}
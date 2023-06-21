<?php

namespace press\app\actions;

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class LoginAction extends AbstractAction
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();
    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $error = $_SESSION['error'] ?? "";
        $target = $_GET['target'] ?? "home";
        $basePath = RouteContext::fromRequest($request)->getBasePath();
        $css_dir = $basePath . "/styles";
        $img_dir = $basePath . "/img";
        $resources = ['css' => $css_dir, 'img' => $img_dir, 'isConnected' => isset($_SESSION['user']), 'target' => $target];
        $view = Twig::fromRequest($request);
        $view->render($response, 'login.twig', ['resources' => $resources, 'error' => $error]);
        return $response;
    }
}
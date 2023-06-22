<?php

namespace press\app\actions;

use Slim\Psr7\Request;
use Slim\Psr7\Response;
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
        unset($_SESSION['error']);

        $target = 'none';
        if (isset($_GET['target'])) {
            $target = $_GET['target'];
            unset($_GET['target']);
        }

        $view = Twig::fromRequest($request);
        $view->render($response, 'login.twig', ['error' => $error, 'target' => $target]);
        return $response;
    }
}
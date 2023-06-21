<?php

namespace press\app\actions;

use press\app\services\auth\AuthService;
use press\app\services\auth\PasswordNotMatchException;
use press\app\services\auth\UserAlreadyExistsException;
use press\app\services\auth\WeakPasswordException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;

class ProcessRegisterAction extends AbstractAction
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $routeContext = RouteContext::fromRequest($request);
        $urlRegister = $routeContext->getRouteParser()->urlFor('register');


        if ($request->getMethod() !== 'POST') {
            return $response->withHeader('Location', $urlRegister)->withStatus(302);
        }

        $email = filter_var($request->getParsedBody()['email'], FILTER_SANITIZE_EMAIL);
        $password = filter_var($request->getParsedBody()['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $confirm_password = filter_var($request->getParsedBody()['confirm_password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        try {
            $authService = new AuthService();
            $authService->register($email, $password, $confirm_password);
        } catch (PasswordNotMatchException $pe) {
            $_SESSION['error'] = $pe->getMessage();
            $urlRegister = $routeContext->getRouteParser()->urlFor('register');
        } catch (WeakPasswordException $we) {
            $_SESSION['error'] = $we->getMessage();
            $urlRegister = $routeContext->getRouteParser()->urlFor('register');
        } catch (UserAlreadyExistsException $ue) {
            $_SESSION['error'] = $ue->getMessage();
            $urlRegister = $routeContext->getRouteParser()->urlFor('register');
        }
        $urlRegister = $routeContext->getRouteParser()->urlFor('login');
        return $response->withHeader('Location', $urlRegister)->withStatus(302);

    }
}
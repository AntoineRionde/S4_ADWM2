<?php

namespace press\app\actions;

use Erusev\Parsedown\Parsedown;
use Michelf\Markdown;
use press\app\services\articles\ArticleService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;

class CreateArticleProcessAction extends AbstractAction
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $data['titre'] = filter_var($data['titre'], FILTER_SANITIZE_SPECIAL_CHARS);
        $data['auteur'] = filter_var($data['auteur'], FILTER_SANITIZE_SPECIAL_CHARS);

        // nl2br permet de conserver les sauts de ligne
        $data['resume'] = nl2br(htmlspecialchars($data['resume']));
        $data['contenu'] = nl2br(htmlspecialchars($data['contenu']));

        $data['date'] = filter_var($data['date'], FILTER_SANITIZE_SPECIAL_CHARS);
        $data['image'] = filter_var($data['image'], FILTER_SANITIZE_SPECIAL_CHARS);

        $articleService = new ArticleService();
        /*$article = */$articleService->createArticle($data);

        $routeParser = RouteContext::fromRequest($request)->getRouteParser();

        return $response->withHeader('location', $routeParser->urlFor('home'))->withStatus(302);
    }
}
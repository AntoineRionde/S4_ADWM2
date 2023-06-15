<?php

use press\app\services\utils\Eloquent;
use Slim\Factory\AppFactory as Factory;
use Twig\Loader\FilesystemLoader;

$app = Factory::create();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, false, false);

$twig = \Slim\Views\Twig::create(__DIR__ . '/../templates/', ['cache'=> __DIR__ . '/../templates/cache/', 'auto_reload' => true]);
$app->add(\Slim\Views\TwigMiddleware::create($app, $twig));


Eloquent::init(__DIR__ . '/../conf/db.conf');

return $app;        
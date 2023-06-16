<?php

use press\api\services\utils\Eloquent;
use Slim\Factory\AppFactory as Factory;


$app = Factory::create();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, false, false);

Eloquent::init(__DIR__ . '/../conf/db.conf');

return $app;        
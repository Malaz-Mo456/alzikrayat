<?php

require_once __DIR__ . '/../core/Router.php';

$router = new Router();

$router->add('GET', '/index.php', ['TestController', 'index']);
$router->add('GET', '/index.php/{id}', ['TestController', 'show']);

$router->dispatch();
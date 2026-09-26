<?php
/**
 * Application Entry Point
 * 
 * All requests are routed through this single file.
 * 
 * @author  Malaz Mohamed Ahmed Mohamed
 * @version 1.0
 */

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

define('BASE_PATH', dirname(__DIR__));

require_once BASE_PATH . '/config/database.php';
require_once BASE_PATH . '/core/Model.php';
require_once BASE_PATH . '/core/Controller.php';
require_once BASE_PATH . '/core/Router.php';

$router = new Router();

// Photos
$router->add('GET', '/photos', ['PhotoController', 'index']);
$router->add('GET', '/photo/create', ['PhotoController', 'create']);
$router->add('GET', '/photo/{id}', ['PhotoController', 'show']);

$router->add('POST', '/photo/store', ['PhotoController', 'store']);
$router->add('GET', '/photo/{id}/delete', ['PhotoController', 'delete']);
//Comments
$router->add('POST', '/comment/store', ['CommentController', 'store']);
// Likes
$router->add('POST', '/photo/{id}/like', ['LikeController', 'toggle']);
// Home
$router->add('GET', '/', ['HomeController', 'index']);
$router->add('GET', '/about', ['HomeController', 'about']);
// Auth
$router->add('GET',  '/register', ['AuthController', 'registerForm']);
$router->add('POST', '/register', ['AuthController', 'register']);
$router->add('GET',  '/login',    ['AuthController', 'loginForm']);
$router->add('POST', '/login',    ['AuthController', 'login']);
$router->add('GET',  '/logout',   ['AuthController', 'logout']);

$router->dispatch();
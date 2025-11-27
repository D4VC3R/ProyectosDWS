<?php
include_once "vendor/autoload.php";
include_once "env.php";

use App\Controller\UserController;
use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Exception;

$router = new RouteCollector();

$router->get('/', function () {
	include_once DIR_VIEWS . 'login.php';
});

$router->get('/admin', function () {
	include_once DIR_BACKEND_VIEWS . "indexAdmin.php";
});

$router->get('/login', [UserController::class, 'showLogin']);
$router->post('/user/login', [UserController::class, 'verify']);
$router->get('/user/create', [UserController::class, 'create']);
$router->post('/user', [UserController::class, 'store']);
$router->get('/user/${id}/edit', [UserController::class, 'edit']);
$router->put('/user/${id}', [UserController::class,'update']);
$router->get('/user', [UserController::class, 'index']);
$router->get('user/{$id}', [UserController::class, 'show']);
$router->delete('/user',[UserController::class,'delete']);
$router->get('/user/logout',[UserController::class, 'logout']);














$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

try {
	$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

}catch (Exception\HttpRouteNotFoundException $e){
	return include_once DIR_BACKEND_VIEWS."404.php";
}
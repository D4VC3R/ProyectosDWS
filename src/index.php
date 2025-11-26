<?php
include_once "vendor/autoload.php";
include_once "env.php";


use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Exception;

$router = new RouteCollector();

$router->get('/', function () {
	echo "hola mundo";
});

$router->get('/admin', function () {
	include_once DIR_BACKEND_VIEWS . "indexAdmin.php";
});














$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

try {
	$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

}catch (Exception\HttpRouteNotFoundException $e){
	return include_once DIR_BACKEND_VIEWS."404.php";
}
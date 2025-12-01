<?php
include_once "vendor/autoload.php";
include_once "env.php";

session_start();

use App\Controller\UserController;
use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Exception;

$router = new RouteCollector();



$router->filter('admin', function(){
  if (!isset($_SESSION['user']) || !$_SESSION['user']->isAdmin()){
    header( 'Location: /error');
    return false;
  }
});

$router->filter('auth', function (){
  if (!isset($_SESSION['user'])){
    header('Location: /login');
    return false;
  }
});

$router->get('/login', [UserController::class, 'showLogin']);
$router->post('/user/login', [UserController::class, 'verify']);
$router->get('/user/create', [UserController::class, 'create']);
$router->post('/user', [UserController::class, 'store']);
$router->get('/user/{id}/edit', [UserController::class, 'edit'],['before' => 'auth']);
$router->put('/user/{id}', [UserController::class,'update'],['before' => 'admin']);
$router->get('/user', [UserController::class, 'index'],['before' => 'admin']);
$router->get('user/{id}', [UserController::class, 'show'],['before' => 'auth']);
$router->delete('/user/{id}',[UserController::class,'delete'],['before' => 'admin']);
$router->get('/logout',[UserController::class, 'logout'],['before' => 'auth']);


$router->get('/', function () {
  $error = null;
  include_once DIR_VIEWS . 'login.php';
});

$router->get('/admin', function () {
  include_once DIR_BACKEND_VIEWS . "indexAdmin.php";
},['before'=>'admin']);












$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

try {
	$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

}catch (Exception\HttpRouteNotFoundException $e){
	return include_once DIR_VIEWS."404.php";
}
<?php
include_once ('./vendor/autoload.php');
include_once ('./env.php');
include_once './auxiliar/funciones.php';

session_start();
// Directiva para insertar o utilizar el router
use App\Controller\UserController;
use App\Controller\VillageController;
use Phroute\Phroute\Exception\HttpRouteNotFoundException;
use Phroute\Phroute\RouteCollector;

// Instancia del objeto router
$router = new RouteCollector();


//Definir los filtros de las rutas
$router->filter('auth',function(){

	if(!isset($_SESSION['user'])) {
		header('Location: /login');
		return false;
	}
});


$router->filter('admin',function(){

	if (isset($_SESSION['user']) && !$_SESSION['user']->isAdmin()){
		header('Location: /error');
		return false;
	}
});

$router->get('/error',function(){
	if (isset($_SESSION['error'])){
		$error = $_SESSION['error'];
	}else{
		$error = "Error desconocido";
	}
	include_once DIRECTORIO_VISTAS_FRONTEND."404.php";
});

//Definir las rutas de mi aplicación

$router->get('/',function(){
	return include_once DIRECTORIO_VISTAS_FRONTEND."indice.php";
});

$router->get('/admin',function(){
	return include_once DIRECTORIO_VISTAS_BACKEND."indexAdmin.php";
});


//Rutas de Usuario CRUD
//Rutas asociadas a las vistas de usuario
$router->get('/user/create',[UserController::class,'create']);
$router->get('/user/{id}/edit',[UserController::class,'edit'],["before"=>'auth']);
$router->get('/login',[UserController::class,'show_login']);
$router->post('/user/login',[UserController::class,'verify']);
$router->get('/user/logout',[UserController::class,'logout'],["before"=>'auth']);

//Rutas para la aplicacion web visual
$router->get('/user',[UserController::class,'index'],["before"=>'admin']);
$router->get('/user/{id}',[UserController::class,'show'],["before"=>'auth']);
$router->post('/user',[UserController::class,'store']);
$router->put('/user/{id}',[UserController::class,'update']);
$router->delete('/user/{id}',[UserController::class,'destroy'],["before"=>'admin']);


$router->get('/village/create', [VillageController::class,'create']);
$router->get('/village/{$id}/edit',[VillageController::class,'edit']);

$router->get('/village',[VillageController::class,'index']);
$router->get('/village/{$id}',[VillageController::class,'show']);
$router->post('/village',[VillageController::class, 'store']);
$router->put('/village/{id}', [VillageController::class,'update']);
$router->delete('/village/{$id}', [VillageController::class,'destroy']);


$router->get('/control', function(){
	include_once DIRECTORIO_VISTAS_BACKEND . "indexAdmin.php";
});




// Resolver la ruta que debemos cargar
$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

try {
	$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
	echo $response;
} catch (HttpRouteNotFoundException $e){
	include_once DIRECTORIO_VISTAS_FRONTEND . "404.php";
};



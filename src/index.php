<?php
include_once ('./vendor/autoload.php');
include_once ('./env.php');
include_once './auxiliar/funciones.php';

session_start();
// Directiva para insertar o utilizar el router
use App\Controller\UserController;
use Phroute\Phroute\Exception\HttpRouteNotFoundException;
use Phroute\Phroute\RouteCollector;

// Instancia del objeto router
$router = new RouteCollector();

// Rutas de la aplicación
$router->get('/', function(){
	return 'Estoy en la pagina principal';
});

//Rutas de Usuario CRUD
//Rutas asociadas a la vistas de usuarios
$router->get('/user/{id}/edit', [UserController::class, 'edit']);
$router->get('/user/create', [UserController::class, 'create']);
$router->get('/login',[UserController::class,'show_login']);
$router->post('/user/login',[UserController::class,'verify']);
$router->get('/logout',[UserController::class,'logout']);

//Rutas para la aplicación web visual
$router->get('/user',[UserController::class,'index']);
$router->get('/user/{id}',[UserController::class,'show']);
$router->post('/user',[UserController::class,'store']);
$router->put('/user/{id}',[UserController::class,'update']);
$router->delete('/user/{id}',[UserController::class,'destroy']);

//Rutas de Servvicio API REST
$router->get('/api/user',[UserController::class,'index']);
$router->get('/api/user/{id}',[UserController::class,'show']);
$router->post('/api/user',[UserController::class,'store']);
$router->put('/api/user/{id}',[UserController::class,'update']);
$router->delete('/api/user/{id}',[UserController::class,'destroy']);



//Rutas de Servicio API REST


$router->get('/control', function(){
	include_once DIRECTORIO_VISTAS_BACKEND . "welcome.php";
});




// Resolver la ruta que debemos cargar
$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

try {
	$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
	echo $response;
} catch (HttpRouteNotFoundException $e){
	include_once DIRECTORIO_VISTAS_FRONTEND . "404.php";
};



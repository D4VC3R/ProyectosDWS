<?php
include_once ('./vendor/autoload.php');
include_once ('./env.php');
include_once './auxiliar/funciones.php';

session_start();
// Directiva para insertar o utilizar el router
use App\Controller\DirectorController;
use App\Controller\MovieController;
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




//Rutas de Peliculas CRUD
//Rutas de Servicio API REST
$router->get('/movie',[MovieController::class,'index']);
$router->get('/movie/{id}',[MovieController::class,'show']);
$router->get('/create-movie',[MovieController::class,'create']);
$router->post('/movie',[MovieController::class,'store']);
$router->put('/movie/{id}',[MovieController::class,'update']);
$router->delete('/movie/{id}',[MovieController::class,'destroy']);

$router->get('/control', function(){
    include_once DIRECTORIO_VISTAS_BACKEND . "welcome.php";
});

// Rutas de Director CRUD
// index es por el framework futuro, lo que hace es obtener todos los directores
$router->get('/director', [DirectorController::class, 'index']);
// mostrar un único director
$router->get('/director/{id}', [DirectorController::class, 'show']);
// Crear un director
$router->post('/director', [DirectorController::class, 'store']);
// Modificar un director
$router->post('/director/{id}', [DirectorController::class, 'update']);
// Borrar un director
$router->delete('/director/{id}', [DirectorController::class, 'destroy']);


$router->get('/password', function(){
    include_once DIRECTORIO_VISTAS_FRONTEND . "generate-password.php";
});

$router->get('/control/addPelicula', function(){
    include_once DIRECTORIO_VISTAS_BACKEND . "Movie/addPelicula.php";
});

$method =$_SERVER['REQUEST_METHOD'];
if ($method === 'POST' && isset($_POST['_method']))
    $method = strtoupper($_POST['_method']);

// Resolver la ruta que debemos cargar
$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

try {
    $response = $dispatcher->dispatch($method, parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    echo $response;
} catch (HttpRouteNotFoundException $e){
    include_once DIRECTORIO_VISTAS_FRONTEND . "404.php";
};



// Definición de rutas



$router->post('/pelicula', function ()
{
    var_dump($_POST);
    var_dump($_FILES);
});
/*
$router->get('/pass', function(){
    echo "Generar contraseña </br>";
    var_dump($_GET);

    if (!isset($_GET["longitud"]) || !is_numeric($_GET["longitud"]) || $_GET["longitud"] < 1) {
        echo "La longitud debe ser un número positivo mayor que cero.";
    } else {
        echo "Tu contraseña es: " . generarPassword($_GET["longitud"], $_GET["numeros"], $_GET["letras"], $_GET["signos"]);
    }
});

$router->get('/calculadora', function(){

    if (!isset($_GET["x"]) || !is_numeric($_GET["x"]) || !isset($_GET["y"]) || !is_numeric($_GET["y"])) {
        echo "Los parámetros x e y deben ser números válidos.";
    } else {
        $resultados = calculos($_GET["x"], $_GET["y"]);
        echo "Resultados:</br>";
        echo "Suma: " . $resultados["suma"] . "</br>";
        echo "Resta: " . $resultados["resta"] . "</br>";
        echo "Multiplicación: " . $resultados["multiplicacion"] . "</br>";
        echo "División: " . $resultados["division"] . "</br>";
    }
});*/





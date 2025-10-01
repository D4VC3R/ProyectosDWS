<?php
include_once ('./vendor/autoload.php');
include_once ('./env.php');
// Directiva para insertar o utilizar el router
use Phroute\Phroute\Exception\HttpRouteNotFoundException;
use Phroute\Phroute\RouteCollector;

// Instancia del objeto router
$router = new RouteCollector();

// Definición de rutas
$router->get('/', function(){
    return 'Estoy en la pagina principal';
});

$router->get('/control', function(){
    include_once DIRECTORIO_VISTAS_ADMIN."welcome.php";
});
$router->get('/loginAdmin', function(){
    include_once DIRECTORIO_VISTAS_ADMIN."login.php";
});

$router->get('/login', function(){
    include_once DIRECTORIO_VISTAS."indice.php";
});

$router->get('/cuenta', function(){
    include_once DIRECTORIO_VISTAS."generate-password.php";
});

$router->get('/pass', function(){
    echo "Generar contraseña </br>";
    var_dump($_GET);

    include_once './auxiliar/funciones.php';

    if (!isset($_GET["longitud"]) || !is_numeric($_GET["longitud"]) || $_GET["longitud"] < 1) {
        echo "La longitud debe ser un número positivo mayor que cero.";
    } else {
        echo "Tu contraseña es: " . generatePassword($_GET["longitud"], true, true, true);
    }
});

// Resolver la ruta que debemos cargar
$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

try {
    $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    echo $response;
} catch (HttpRouteNotFoundException $e){
    echo "Error 404, página no encontrada";
};



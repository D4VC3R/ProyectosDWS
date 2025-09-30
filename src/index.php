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
    echo "Se va a generar una contraseña.";
    include_once ('./src/auxiliar/funciones.php');

    echo "Tu contraseña es: " . generatePassword(10);
});




// Resolver la ruta que debemos cargar
$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

try {
    $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    echo $response;
} catch (HttpRouteNotFoundException $e){
    echo "Error 404, página no encontrada";
};



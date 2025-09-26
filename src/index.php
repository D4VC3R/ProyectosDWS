<?php
include_once ('./vendor/autoload.php');
include_once ('./env.php');
// Directiva para insertar o utilizar el router
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




// Resolver la ruta que debemos cargar
$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Print out the value returned from the dispatched function
echo $response;

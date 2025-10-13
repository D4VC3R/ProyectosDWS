<?php
include_once ('./vendor/autoload.php');
include_once ('./env.php');
include_once './auxiliar/funciones.php';
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

$router->get('/control/addPelicula', function(){
    include_once DIRECTORIO_VISTAS_ADMIN."addPelicula.php";
});


$router->post('/pelicula', function ()
{
    var_dump($_POST);
    var_dump($_FILES);
});

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
});

// Resolver la ruta que debemos cargar
$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

try {
    $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    echo $response;
} catch (HttpRouteNotFoundException $e){
    echo "Error 404, página no encontrada";
};



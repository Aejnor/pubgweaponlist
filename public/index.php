<?php
require_once '../vendor/autoload.php';

use Phroute\Phroute\RouteCollector;
use Illuminate\Database\Capsule\Manager as Capsule;

// Punto de entrada a la aplicación
require_once '../helpers.php';

session_start();

$baseDir = str_replace(
    basename($_SERVER['SCRIPT_NAME']),
    '',
    $_SERVER['SCRIPT_NAME']);

$baseUrl = "http://" . $_SERVER['HTTP_HOST'] . $baseDir;
define('BASE_URL', $baseUrl);

if(file_exists(__DIR__ . '/../.env')){
    $dotenv = new Dotenv\Dotenv(__DIR__ . '/..');
    $dotenv->load();
}


// Instancia de Eloquent
$capsule = new Capsule;
$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => getenv('DB_HOST'),
    'database'  => getenv('DB_NAME'),
    'username'  => getenv('DB_USER'),
    'password'  => getenv('DB_PASS'),
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$route = $_GET['route'] ?? "/";

$router = new RouteCollector();

// Filtro para aplicar a rutas a USUARIOS AUTENTICADOS
// en el sistema
$router->filter('auth', function(){
    if(!isset($_SESSION['userId'])){
        header('Location: '. BASE_URL);
        return false;
    }
});

$router->group(['before' => 'auth'], function ($router){
    $router->get('/guns/new', ['\App\Controllers\GunController', 'getNew']);
    $router->post('/guns/new', ['\App\Controllers\GunController', 'postNew']);
    $router->get('/guns/edit/{id}', ['\App\Controllers\GunController', 'getEdit']);
    $router->put('/guns/edit/{id}', ['\App\Controllers\GunController', 'putEdit']);
    $router->delete('/guns/', ['\App\Controllers\GunController', 'deleteIndex']);
    $router->get('/logout', ['\App\Controllers\HomeController', 'getLogout']);
});

// Filtro para aplicar a rutas a USUARIOS NO LOGEADOS en la "web"
$router->filter('noAuth', function(){
    if( isset($_SESSION['userId'])){
        header('Location: '. BASE_URL);
        return false;
    }
});

$router->group(['before' => 'noAuth'], function ($router){
    $router->get('/login', ['\App\Controllers\HomeController', 'getLogin']);
    $router->post('/login', ['\App\Controllers\HomeController', 'postLogin']);
    $router->get('/registro', ['\App\Controllers\HomeController', 'getRegistro']);
    $router->post('/registro', ['\App\Controllers\HomeController', 'postRegistro']);
    $router->get('/invitacion', ['\App\Controllers\HomeController', 'getInvitation']);
    $router->post('/invitacion', ['\App\Controllers\HomeController', 'postInvitation']);
});

// Rutas sin filtros
$router->get('/',['\App\Controllers\HomeController', 'getIndex']);
$router->get('/guns/{id}', ['\App\Controllers\GunController', 'getIndex']);
$router->post('/guns/{id}', ['\App\Controllers\GunController', 'postIndex']);

$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

$method = $_REQUEST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$response = $dispatcher->dispatch($method, $route);

// Print out the value returned from the dispatched function
echo $response;
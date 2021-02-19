<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

// Add error middleware
$app->addErrorMiddleware(true, true, true);

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Hello world!");
    return $response;
});
//RUTAS
require_once "../src/routes/routes.php";

$app->run();  
/*   
try {
   $app->run();     
} catch (Exception $e) {    
   die( 'Not Found Page'); 
}*/
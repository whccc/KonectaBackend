<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
require __DIR__ . '/../vendor/autoload.php';

header('Access-Control-Allow-Origin:*'); 
header('Access-Control-Allow-Headers:X-Requested-With, Content-Type, Accept, Origin, Authorization');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('Content-Type: application/json');


$app = AppFactory::create();

// Add error middleware
$app->addBodyParsingMiddleware();

//RUTAS
require_once "../src/routes/routes.php";

$app->run();  
/*   
try {
   $app->run();     
} catch (Exception $e) {    
   die( 'Not Found Page'); 
}*/
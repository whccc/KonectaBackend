<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require_once '../src/controllers/CategoryController.php';

//CREAR USUARIO
$app->post('/api/category/create', function (Request $request, Response $response, $args) {
    try{
        $Data=$request->getParsedBody();

        $Category= new ClsControllerCategory();
        $Category->CreateCategory($Data);
        $Category=null;

        $response->getBody()->write(json_encode(array("Success"=>true)));
        return $response->withStatus(201);
    }catch(Exception $Error){
        $response->getBody()->write(json_encode(array("Success"=>false)));
        return $response->withStatus(500);
    }
});


//GET BLOG POST
$app->get('/api/category',function (Request $request, Response $response, $args) {
    try{
        $Categories= new ClsControllerCategory();
        $Categories->GetCategories();

        $response->getBody()->write(json_encode(array("Success"=>true ,"DataCategories"=>$Categories->getResponseDataApi())));
        $Categories=null;
        return $response->withStatus(201);
    }catch(Exeption $Error){
        $response->getBody()->write(json_encode(array("Success"=>false)));
        return $response->withStatus(500);
    }
});
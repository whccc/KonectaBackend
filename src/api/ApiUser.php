<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require_once '../src/controllers/UserController.php';

//CREAR USUARIO
$app->post('/api/user/createuser', function (Request $request, Response $response, $args) {
    try{
        $Data=$request->getParsedBody();
        //CLASE USERCONTROLLER
        $User= new ClsControllerUser();
        $User->CreateUser($Data);
        $User=null;

        $response->getBody()->write(json_encode(array("Success"=>true)));
        return $response->withStatus(201);
    }catch(Exception $Error){
        $response->getBody()->write(json_encode(array("Success"=>false)));
        return $response->withStatus(500);
    }
});

//VALIDAR EMAIL
$app->post('/api/user/validateemail',function (Request $request, Response $response, $args) {
    try{
        $Data=$request->getParsedBody();
        //CLASE USERCONTROLLER
        $User= new ClsControllerUser();
        $User->ValidateEmail($Data);

        $response->getBody()->write(json_encode(array("Success"=>$User->getResponseDataApi())));
        $User=null;
        return $response->withStatus(201);
    }catch(Exeption $Error){
        $response->getBody()->write(json_encode(array("Success"=>false)));
        return $response->withStatus(500);
    }
});

//LOGIN USER
$app->post('/api/user/login',function (Request $request, Response $response, $args) {
    try{
        $Data=$request->getParsedBody();
        //CLASE USERCONTROLLER
        $User= new ClsControllerUser();
        $User->LoginUser($Data);

        $response->getBody()->write(json_encode(array("Success"=>$User->getResponseDataApi()!=null ? true : false,"DataUser"=>$User->getResponseDataApi())));
        $User=null;
        return $response->withStatus(201);
    }catch(Exeption $Error){
        $response->getBody()->write(json_encode(array("Success"=>false)));
        return $response->withStatus(500);
    }
});

//GET USERS
$app->get('/api/user',function (Request $request, Response $response, $args) {
    try{
        //CLASE USERCONTROLLER
        $User= new ClsControllerUser();
        $User->GetUsers();

        $response->getBody()->write(json_encode(array("Success"=>true ,"DataUsers"=>$User->getResponseDataApi())));
        $User=null;
        return $response->withStatus(201);
    }catch(Exeption $Error){
        $response->getBody()->write(json_encode(array("Success"=>false)));
        return $response->withStatus(500);
    }
});

//GET USER POR ID
$app->get('/api/user/{_idUser}',function (Request $request, Response $response, $args) {
    try{
        
        //CLASE USERCONTROLLER
        $User= new ClsControllerUser();
        $User->GetUser($args['_idUser']);

        $response->getBody()->write(json_encode(array("Success"=>true ,"DataUser"=>$User->getResponseDataApi())));
        $User=null;
        return $response->withStatus(201);
    }catch(Exeption $Error){
        $response->getBody()->write(json_encode(array("Success"=>false)));
        return $response->withStatus(500);
    }
});
//ACTUALIZAR USUARIO
$app->post('/api/user/updateuser', function (Request $request, Response $response, $args) {
    try{
        $Data=$request->getParsedBody();
        //CLASE USERCONTROLLER
        $User= new ClsControllerUser();
        $User->UpdateUser($Data);
        $User=null;

        $response->getBody()->write(json_encode(array("Success"=>true)));
        return $response->withStatus(201);
    }catch(Exception $Error){
        $response->getBody()->write(json_encode(array("Success"=>false)));
        return $response->withStatus(500);
    }
});
//DELETE USUARIO
$app->delete('/api/user/deleteuser', function (Request $request, Response $response, $args) {
    try{
        $Data=$request->getParsedBody();
        //CLASE USERCONTROLLER
        $User= new ClsControllerUser();
        $User->DeleteUser($Data);
        $User=null;

        $response->getBody()->write(json_encode(array("Success"=>true)));
        return $response->withStatus(201);
    }catch(Exception $Error){
        $response->getBody()->write(json_encode(array("Success"=>false)));
        return $response->withStatus(500);
    }
});
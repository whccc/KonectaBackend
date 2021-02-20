<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require_once '../src/controllers/BlogPostController.php';

//CREAR USUARIO
$app->post('/api/blogpost/createblogpost', function (Request $request, Response $response, $args) {
    try{
        $Data=$request->getParsedBody();

        $BlogPost= new ClsControllerBlogPost();
        $BlogPost->CreateBlogPost($Data);
        $BlogPost=null;

        $response->getBody()->write(json_encode(array("Success"=>true)));
        return $response->withStatus(201);
    }catch(Exception $Error){
        $response->getBody()->write(json_encode(array("Success"=>false)));
        return $response->withStatus(500);
    }
});


//GET BLOG POST
$app->get('/api/blogpost',function (Request $request, Response $response, $args) {
    try{
        $BlogPost= new ClsControllerBlogPost();
        $BlogPost->GetBlogPosts();

        $response->getBody()->write(json_encode(array("Success"=>true ,"DataBlogPosts"=>$BlogPost->getResponseDataApi())));
        $BlogPost=null;
        return $response->withStatus(201);
    }catch(Exeption $Error){
        $response->getBody()->write(json_encode(array("Success"=>false)));
        return $response->withStatus(500);
    }
});
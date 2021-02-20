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


//GET BLOG POR ID
$app->get('/api/blogpost/{_idBlogPost}',function (Request $request, Response $response, $args) {
    try{
        
        //CLASE USERCONTROLLER
        $BlogPost= new ClsControllerBlogPost();
        $BlogPost->GetBlogPost($args['_idBlogPost']);

        $response->getBody()->write(json_encode(array("Success"=>true ,"DataBlogPost"=>$BlogPost->getResponseDataApi())));
        $BlogPost=null;
        return $response->withStatus(201);
    }catch(Exeption $Error){
        $response->getBody()->write(json_encode(array("Success"=>false)));
        return $response->withStatus(500);
    }
});
//ACTUALIZAR BLOG POST
$app->put('/api/blogpost/updateblogpost', function (Request $request, Response $response, $args) {
    try{
        $Data=$request->getParsedBody();
        //CLASE USERCONTROLLER
        $BlogPost= new ClsControllerBlogPost();
        $BlogPost->UpdateBlogPost($Data);
        $BlogPost=null;

        $response->getBody()->write(json_encode(array("Success"=>true)));
        return $response->withStatus(201);
    }catch(Exception $Error){
        $response->getBody()->write(json_encode(array("Success"=>false)));
        return $response->withStatus(500);
    }
});
//DELETE USUARIO
$app->delete('/api/blogpost/deleteblogpost', function (Request $request, Response $response, $args) {
    try{
        $Data=$request->getParsedBody();
        //CLASE USERCONTROLLER
        $BlogPost= new ClsControllerBlogPost();
        $BlogPost->DeleteBlogPost($Data);
        $BlogPost=null;

        $response->getBody()->write(json_encode(array("Success"=>true)));
        return $response->withStatus(201);
    }catch(Exception $Error){
        $response->getBody()->write(json_encode(array("Success"=>false)));
        return $response->withStatus(500);
    }
});
//GET BLOG POST LIMIT
$app->get('/api/blogpost/post/new',function (Request $request, Response $response, $args) {
    try{
        $BlogPost= new ClsControllerBlogPost();
        $BlogPost->GetBlogPostsLimit();

        $response->getBody()->write(json_encode(array("Success"=>true ,"DataBlogPosts"=>$BlogPost->getResponseDataApi())));
        $BlogPost=null;
        return $response->withStatus(201);
    }catch(Exeption $Error){
        $response->getBody()->write(json_encode(array("Success"=>false)));
        return $response->withStatus(500);
    }
});

//ADD COMMENT BLOG POST
$app->post('/api/blogpost/addcomment', function (Request $request, Response $response, $args) {
    try{
        $Data=$request->getParsedBody();
        //CLASE USERCONTROLLER
        $BlogPost= new ClsControllerBlogPost();
        $BlogPost->AddCommentBlogPost($Data);
        $BlogPost=null;

        $response->getBody()->write(json_encode(array("Success"=>true)));
        return $response->withStatus(201);
    }catch(Exception $Error){
        $response->getBody()->write(json_encode(array("Success"=>false)));
        return $response->withStatus(500);
    }
});


//ADD LIKE BLOG POST
$app->put('/api/blogpost/addlike', function (Request $request, Response $response, $args) {
    try{
        $Data=$request->getParsedBody();
        //CLASE USERCONTROLLER
        $BlogPost= new ClsControllerBlogPost();
        $BlogPost->AddCountLikes($Data);
        $BlogPost=null;

        $response->getBody()->write(json_encode(array("Success"=>true)));
        return $response->withStatus(201);
    }catch(Exception $Error){
        $response->getBody()->write(json_encode(array("Success"=>false)));
        return $response->withStatus(500);
    }
});
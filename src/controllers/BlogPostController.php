<?php

require_once '../src/model/BlogPostModel.php';
class ClsControllerBlogPost{
    private $ResponseDataApi;

    //------------
    //CONSTRUCTOR  
    //------------
    public function __constructor(){

    }

    //-------------------------
    //METODOS PUBLICOS GET SET
    //-------------------------
    public function setResponseDataApi($Data){
        $this->ResponseDataApi=$Data;
    }
    public function getResponseDataApi(){
        return $this->ResponseDataApi;
    }
     //------------------
    // METODOS PUBLICOS
    //------------------
    public function CreateBlogPost($Data){
        try{
            $ModelBlog= new ClsBlogPostModel();
 
            $ModelBlog->setStrTitleBlogPost($Data['strTitle']);
            $ModelBlog->setStrIdCategoryBlogPost($Data['strIdCategory']);
            $ModelBlog->setStrTextSmallBlogPost($Data['strTextSmall']);
            $ModelBlog->setStrTextLargeBlogPost($Data['strTextLarge']);
            $ModelBlog->setBlobImg($Data['blobImg']);
            $ModelBlog->setDtCreateBlogPost(date("d/m/y T H:i:s"));
            $ModelBlog->setDtUpdateBlogPost(date("d/m/y T H:i:s"));
 
            //Creación usuario
            $ModelBlog->CreateBlogPost();
 
            $ModelBlog=null;
 
        }catch(Exeption $Error){
            throw $Error;
        }
     }
     //----------------
    // BLOGPOTS
    //----------------
    public function GetBlogPosts(){
        try{
            $ModelBlogPost= new ClsBlogPostModel();

            $ArrayBlogPosts=array();
            //Obtener usuarios
            $ModelBlogPost->GetBlogPosts();
            foreach ($ModelBlogPost->getResponseData() as $BlogPost)
            {
                array_push($ArrayBlogPosts,
                    array(
                    "_id"=>$BlogPost->_id->__toString(),
                    "strTitle"=>$BlogPost->strTitle,
                    "strTextSmall"=>$BlogPost->strTextSmall,
                    "strTextLarge"=>$BlogPost->strTextLarge,
                    "strIdCategory"=>$BlogPost->strIdCategory,
                    "blobImg"=>$BlogPost->blobImg,
                    "dtDateCreate"=>$BlogPost->dtDateCreation,
                    "dtDateUpdate"=>$BlogPost->dtDateUpdate
                    )
                );
            }
          
           $this->setResponseDataApi($ArrayBlogPosts);

           $ModelBlogPost=null;
        }catch(Exeption $Error){
            throw $Error;
        }
    }
}
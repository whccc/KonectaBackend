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
                    "dtDateUpdate"=>$BlogPost->dtDateUpdate,
                    "ArrayComments"=>$BlogPost->ArrayComments
                    )
                );
            }
          
           $this->setResponseDataApi($ArrayBlogPosts);

           $ModelBlogPost=null;
        }catch(Exeption $Error){
            throw $Error;
        }
    }
    //--------------
    //GET BLOG POST
    //--------------
    public function GetBlogPost($Data){
        try{
            $ModelBlogPost= new ClsBlogPostModel();
            $ModelBlogPost->setStrIdBlogPost($Data);
           //Creación usuario
           $ModelBlogPost->GetBlogPost();
           $BlogPost=$ModelBlogPost->getResponseData();
           if($BlogPost!=null){
                $ArrayUser=array(
                            "_id"=>$BlogPost->_id->__toString(),
                            "strTitle"=>$BlogPost->strTitle,
                            "strIdCategory"=>$BlogPost->strIdCategory,
                            "strTextSmall"=>$BlogPost->strTextSmall,
                            "strTextLarge"=>$BlogPost->strTextLarge,
                            "blobImg"=>$BlogPost->blobImg,
                            "dtDateCreation"=>$BlogPost->dtDateCreation,
                            "dtDateUpdate"=>$BlogPost->dtDateUpdate,
                            "ArrayComments"=>$BlogPost->ArrayComments
                );
           }
           $this->setResponseDataApi($ArrayUser);
           $ModelBlogPost=null;
        }catch(Exeption $Error){
            throw $Error;
        }
    }
    //---------------------
    // ACTUALIZAR BLOG POST
    //---------------------
    public function UpdateBlogPost($Data){
        try{
            $ModelBlogPost= new ClsBlogPostModel();

            $ModelBlogPost->setStrIdBlogPost($Data['_id']);
            $ModelBlogPost->setStrTitleBlogPost($Data['strTitle']);
            $ModelBlogPost->setStrIdCategoryBlogPost($Data['strIdCategory']);
            $ModelBlogPost->setStrTextSmallBlogPost($Data['strTextSmall']);
            $ModelBlogPost->setStrTextLargeBlogPost($Data['strTextLarge']);
            $ModelBlogPost->setBlobImg($Data['blobImg']);
            $ModelBlogPost->setDtUpdateBlogPost(date("d/m/y T H:i:s"));
 
 
            //Actualizar blog post
            $ModelBlogPost->UpdateBlogPost();
 
            $ModelBlogPost=null;
 
        }catch(Exeption $Error){
            throw $Error;
        }
     }
     //------------------
    // ELIMINAR BLOG POST
    //------------------
    public function DeleteBlogPost($Data){
        try{
            $ModelBlogPost= new ClsBlogPostModel();

            $ModelBlogPost->setStrIdBlogPost($Data['_id']);
            $ModelBlogPost->DeleteBlogPost();
 
            $ModelBlogPost=null;
 
        }catch(Exeption $Error){
            throw $Error;
        }
     }
    //----------------
    // BLOGPOTS LIMIT
    //----------------
    public function GetBlogPostsLimit(){
        try{
            $ModelBlogPost= new ClsBlogPostModel();

            $ArrayBlogPosts=array();
            //Obtener usuarios
            $ModelBlogPost->GetBlogPostsLimit();
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
                    "dtDateUpdate"=>$BlogPost->dtDateUpdate,
                    "ArrayComments"=>$BlogPost->ArrayComments
                    )
                );
            }
          
           $this->setResponseDataApi($ArrayBlogPosts);

           $ModelBlogPost=null;
        }catch(Exeption $Error){
            throw $Error;
        }
    }
    //---------------------
    // ADD COMMENTS
    //---------------------
    public function AddCommentBlogPost($Data){
        try{
            $ModelBlogPost= new ClsBlogPostModel();

            $ModelBlogPost->setStrIdBlogPost($Data['_id']);
            $ModelBlogPost->setStrCommentBlogPost($Data['strComments']);
            $ModelBlogPost->setStrNameUserComment($Data['strNameUser']);
            $ModelBlogPost->setDtCreateBlogPost(date("d/m/y T H:i:s"));
 
 
            //Actualizar blog post
            $ModelBlogPost->AddCommentBlogPost();
 
            $ModelBlogPost=null;
 
        }catch(Exeption $Error){
            throw $Error;
        }
     }
     

}
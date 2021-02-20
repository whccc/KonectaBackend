<?php

require_once '../src/config/MongoDB.php';

class ClsBlogPostModel{
    private $strId;
    private $strTitle;
    private $strIdCategory;
    private $strTextSmall;
    private $strTextLarge;
    private $blobImg;
    private $dtCreateBlogPost;
    private $dtUpdateBlogPost;

    private $ResponseData;

    //------------------
    // METODOS PUBLICOS
    //------------------
    
    public function setResponseData($Data){
        $this->ResponseData=$Data;
    }
    public function setStrIdBlogPost($strId){
        $this->strId=$strId;
    }
    public function setStrTitleBlogPost($strTitle){
        $this->strTitle=$strTitle;
    }
    public function setStrIdCategoryBlogPost($strIdCategory){
        $this->strIdCategory=$strIdCategory;
    }
    public function setStrTextSmallBlogPost($strTextSmall){
        $this->strTextSmall=$strTextSmall;
    }
    public function setStrTextLargeBlogPost($strTextLarge){
        $this->strTextLarge=$strTextLarge;
    }
    public function setDtCreateBlogPost($dtCreateBlogPost){
        $this->dtCreateBlogPost=$dtCreateBlogPost;
    } 
    public function setDtUpdateBlogPost($dtUpdateBlogPost){
        $this->dtUpdateBlogPost=$dtUpdateBlogPost;
    }
    public function setBlobImg($blobImg){
        $this->blobImg=$blobImg;
    }

    public function getResponseData(){
        return $this->ResponseData;
    }
    //------------------
    // METODOS PUBLICOS
    //------------------

    //----------------
    //CREAR BLOG POST
    //----------------
    public function CreateBlogPost(){
        try{
            $ClsMongoDB = new ClsMongoDB();
            $ConnectionMongo=$ClsMongoDB->getConnectionDB();

            $ConnectionMongo->BlogPost->insertOne([
                'strTitle' => $this->strTitle,
                'strIdCategory' => $this->strIdCategory,
                'strTextSmall' => $this->strTextSmall,
                'strTextLarge' => $this->strTextLarge,
                'blobImg'=> $this->blobImg,
                'dtDateCreation'=>$this->dtCreateBlogPost,
                'dtDateUpdate'=> $this->dtUpdateBlogPost
            ]);

            $ClsMongoDB=null;
            $ConnectionMongo=null;
        }catch(Exception $Error){
            throw $Error;
        }
    }
    //-----------------
    //OBTENER BLOG POSTS
    //-----------------
    public function GetBlogPosts(){
        try{
            $ClsMongoDB = new ClsMongoDB();
            $ConnectionMongo=$ClsMongoDB->getConnectionDB();
            
            $DataResult=$ConnectionMongo->BlogPost->find();
            
            $this->setResponseData($DataResult);

            $ClsMongoDB=null;
            $ConnectionMongo=null;
        }catch(Exeption $Error){
            throw $Error;
        }
    }
}
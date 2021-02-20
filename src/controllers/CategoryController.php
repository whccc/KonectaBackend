<?php

require_once '../src/model/CategoryModel.php';
class ClsControllerCategory{
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
    public function CreateCategory($Data){
        try{
            $ModelCategory= new ClsCategoryModel();
 
            $ModelCategory->setStrNameCategory($Data['strName']);
 
            //Creación usuario
            $ModelCategory->CreateCategory();
 
            $ModelCategory=null;
 
        }catch(Exeption $Error){
            throw $Error;
        }
     }
    //----------------
    // CATEGORIES
    //----------------
    public function GetCategories(){
        try{
            $ModelCategories= new ClsCategoryModel();

            $ArrayCategories=array();
            //Obtener usuarios
            $ModelCategories->GetCategories();
            foreach ($ModelCategories->getResponseData() as $Categories)
            {
                array_push($ArrayCategories,
                    array(
                    "_id"=>$Categories->_id->__toString(),
                    "strName"=>$Categories->strName
                    )
                );
            }
          
           $this->setResponseDataApi($ArrayCategories);

           $ModelCategories=null;
        }catch(Exeption $Error){
            throw $Error;
        }
    }
}
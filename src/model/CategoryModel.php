<?php

class ClsCategoryModel{
    private $strId;
    private $strName;

    private $ResponseData;
    //------------------
    // METODOS PUBLICOS
    //------------------
    public function setResponseData($Data){
        $this->ResponseData=$Data;
    }
    public function setStrIdCategory($strId){
        $this->strId=$strId;
    }   
    public function setStrNameCategory($strName){
        $this->strName=$strName;
    }

    public function getResponseData(){
        return $this->ResponseData;
    }
    //----------------
    //CREAR CATEGORY
    //----------------
    public function CreateCategory(){
        try{
            $ClsMongoDB = new ClsMongoDB();
            $ConnectionMongo=$ClsMongoDB->getConnectionDB();

            $ConnectionMongo->Categories->insertOne([
                'strName' => $this->strName
            ]);

            $ClsMongoDB=null;
            $ConnectionMongo=null;
        }catch(Exception $Error){
            throw $Error;
        }
    }
    //-----------------
    //OBTENER CATEGORIES
    //-----------------
    public function GetCategories(){
        try{
            $ClsMongoDB = new ClsMongoDB();
            $ConnectionMongo=$ClsMongoDB->getConnectionDB();
            
            $DataResult=$ConnectionMongo->Categories->find();
            
            $this->setResponseData($DataResult);

            $ClsMongoDB=null;
            $ConnectionMongo=null;
        }catch(Exeption $Error){
            throw $Error;
        }
    }

}
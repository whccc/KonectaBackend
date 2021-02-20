<?php

require_once '../src/config/MongoDB.php';

class ClsUserModel{
    private $strId;
    private $strName;
    private $strEmail;
    private $strPassword;
    private $strPhone;
    private $strTypeUser;
    private $dtCreateUser;
    private $dtUpdateUser;
    private $ClsMongoDB;

    private $ResponseData;

    //------------------
    // METODOS PUBLICOS
    //------------------
    
    public function setResponseData($Data){
        $this->ResponseData=$Data;
    }
    public function setStrName($strName){
        $this->strName=$strName;
    }
    public function setStrEmail($strEmail){
        $this->strEmail=$strEmail;
    }
    public function setStrPassword($strPassword){
        $this->strPassword=$strPassword;
    } 
    public function setStrPhone($strPhone){
        $this->strPhone=$strPhone;
    }
    public function setStrTypeUser($strTypeUser){
        $this->strTypeUser=$strTypeUser;
    }
    public function setDtCreateUser($dtCreateUser){
        $this->dtCreateUser=$dtCreateUser;
    } 
    public function setDtUpdateUser($dtUpdateUser){
        $this->dtUpdateUser=$dtUpdateUser;
    }
    public function setStrIdUser($strId){
        $this->strId=$strId;
    }

    public function getResponseData(){
        return $this->ResponseData;
    }
    //------------------
    // METODOS PRIVADOS
    //------------------
   
    //--------------
    //CREAR USUARIO
    //--------------
    public function CreateUser(){
        try{
            $ClsMongoDB = new ClsMongoDB();
            $ConnectionMongo=$ClsMongoDB->getConnectionDB();

            $ConnectionMongo->Users->insertOne([
                'strNames' => $this->strName,
                'strEmail' => $this->strEmail,
                'strPassword' => $this->strPassword,
                'strPhone' => $this->strPhone,
                'strTypeUser'=> $this->strTypeUser,
                'dtDateCreation'=>$this->dtCreateUser,
                'dtDateUpdate'=> $this->dtUpdateUser
            ]);

            $ClsMongoDB=null;
            $ConnectionMongo=null;
        }catch(Exception $Error){
            throw $Error;
        }
    }
    //---------------
    // VALIDAR EMAIL
    //---------------
    public function ValidateEmail(){
        try{
            $ClsMongoDB = new ClsMongoDB();
            $ConnectionMongo=$ClsMongoDB->getConnectionDB();
            
            $DataResult=$ConnectionMongo->Users->findOne([
                'strEmail' =>$this->strEmail,
            ]);
            
            $this->setResponseData($DataResult);

            $ClsMongoDB=null;
            $ConnectionMongo=null;
        }catch(Exeption $Error){
            throw $Error;
        }
    }
    //-------
    //LOGIN 
    //-------
    public function LoginUser(){
        try{
            $ClsMongoDB = new ClsMongoDB();
            $ConnectionMongo=$ClsMongoDB->getConnectionDB();
            
            $DataResult=$ConnectionMongo->Users->findOne([
                'strEmail' =>$this->strEmail
            ]);
            
            $this->setResponseData($DataResult);

            $ClsMongoDB=null;
            $ConnectionMongo=null;
        }catch(Exeption $Error){
            throw $Error;
        }
    }
    //-----------------
    //OBTENER USUARIOS
    //-----------------
    public function GetUsers(){
        try{
            $ClsMongoDB = new ClsMongoDB();
            $ConnectionMongo=$ClsMongoDB->getConnectionDB();
            
            $DataResult=$ConnectionMongo->Users->find();
            
            $this->setResponseData($DataResult);

            $ClsMongoDB=null;
            $ConnectionMongo=null;
        }catch(Exeption $Error){
            throw $Error;
        }
    }
    //-----------------
    // OBTENER USUARIO
    //-----------------
    public function GetUser(){
        try{
            $ClsMongoDB = new ClsMongoDB();
            $ConnectionMongo=$ClsMongoDB->getConnectionDB();
            
            $DataResult=$ConnectionMongo->Users->findOne([
                '_id' =>new MongoDB\BSON\ObjectID($this->strId)
            ]);;
            
            $this->setResponseData($DataResult);

            $ClsMongoDB=null;
            $ConnectionMongo=null;
        }catch(Exeption $Error){
            throw $Error;
        }
    }
    //-----------------
    // ACTUALIZAR USUARIO
    //-----------------
    public function UpdateUser(){
        try{
            $ClsMongoDB = new ClsMongoDB();
            $ConnectionMongo=$ClsMongoDB->getConnectionDB();
            
            $ConnectionMongo->Users->findOneAndUpdate([
                '_id' =>new MongoDB\BSON\ObjectID($this->strId)
            ],
            [ '$set' => [ 'strNames' =>  $this->strName,
                          'strPassword' => $this->strPassword,
                          'strPhone' => $this->strPhone,
                          'strTypeUser' => $this->strTypeUser,
                          'dtDateUpdate' => $this->dtUpdateUser ]]);
            
           
            $ClsMongoDB=null;
            $ConnectionMongo=null;
        }catch(Exeption $Error){
            throw $Error;
        }
    }
}
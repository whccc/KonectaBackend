<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require_once '../src/model/UserModel.php';
require_once '../src/helpers/Encrypt.php';
require_once '../src/helpers/Jwt.php';

class ClsControllerUser{
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
    // METODOS PRIVADOS
    //------------------
  
    //------------------
    // METODOS PUBLICOS
    //------------------
    public function CreateUser($Data){
       try{
           $ModelUser= new ClsUserModel();
           $Encrypt= new ClsEncrypt();

           $ModelUser->setStrName($Data['strNames']);
           $ModelUser->setStrEmail($Data['strEmail']);
           $ModelUser->setStrPassword($Encrypt->EncryptData($Data['strPassword'],'12345'));
           $ModelUser->setStrPhone($Data['strPhone']);
           $ModelUser->setStrTypeUser($Data['strTypeUser']);
           $ModelUser->setDtCreateUser($Data['dtCreateUser']);
           $ModelUser->setDtUpdateUser($Data['dtUpdateUser']);

           //Creación usuario
           $ModelUser->CreateUser();

           $ModelUser=null;

       }catch(Exeption $Error){
           throw $Error;
       }
    }
    //----------------
    // VALIDATE EMAIL
    //----------------
    public function ValidateEmail($Data){
        try{
           $ModelUser= new ClsUserModel();

           $ModelUser->setStrEmail($Data['strEmail']);

           //Creación usuario
           $ModelUser->ValidateEmail();
           // Validando Email
           if($ModelUser->getResponseData()==null){
            $this->setResponseDataApi(true);
           }else{
            $this->setResponseDataApi(false);
           }

           $ModelUser=null;
        }catch(Exeption $Error){
            throw $Error;
        }
    }
    //---------------
    //INICIO SESSIÓN
    //---------------
    public function LoginUser($Data){
        try{    
            $ModelUser= new ClsUserModel();
            $Jwt= new ClsJwt();
            $Encrypt= new ClsEncrypt();
 
            $ModelUser->setStrEmail($Data['strEmail']);
            //Creación usuario
            $ModelUser->LoginUser();
            $DataResult=$ModelUser->getResponseData();

            if($DataResult!=null){
                $DataPassword= $Encrypt->DecryptData($DataResult->strPassword,'12345');
                // Validando Login
                if($Data['strEmail']==$DataResult->strEmail && $DataPassword==$Data['strPassword'] ){
                    //Data User
                    $DataUser = array(
                    "strNames"=>$DataResult->strNames,
                    "strEmail"=>$DataResult->strEmail,
                    "strPhone"=>$DataResult->strPhone,
                    "strTypeUser"=>$DataResult->strTypeUser,
                    "Token"=>$Jwt->SignIn($DataResult->strEmail));
                    $this->setResponseDataApi($DataUser);
                }else{
                    $this->setResponseDataApi(null);
                }
            }else{
                $this->setResponseDataApi(null);
            }
            $ModelUser=null;
        }catch(Exeption $Error){
            throw $Error;
        }
    }
    //----------------
    // USERS
    //----------------
    public function GetUsers(){
        try{
            $ModelUser= new ClsUserModel();

            $ArrayUsers=array();
            //Obtener usuarios
            $ModelUser->GetUsers();
            foreach ($ModelUser->getResponseData() as $User)
            {
                array_push($ArrayUsers,
                    array(
                    "_id"=>$User->_id->__toString(),
                    "strNames"=>$User->strNames,
                    "strEmail"=>$User->strEmail,
                    "strTypeUser"=>$User->strTypeUser,
                    "strPhone"=>$User->strPhone,
                    "dtDateCreation"=>$User->dtDateCreation,
                    "dtDateUpdate"=>$User->dtDateUpdate
                    )
                );
            }
          
           $this->setResponseDataApi($ArrayUsers);

           $ModelUser=null;
        }catch(Exeption $Error){
            throw $Error;
        }
    }
    //-----------
    //GET USUARIO
    //-----------
    public function GetUser($Data){
        try{
            $ModelUser= new ClsUserModel();
            $Encrypt= new ClsEncrypt();
            $ArrayUser=array();
            $ModelUser->setStrIdUser($Data);
           //Creación usuario
           $ModelUser->GetUser();
           $User=$ModelUser->getResponseData();
           if($User!=null){
            array_push($ArrayUser,
                array(
                    "_id"=>$User->_id->__toString(),
                    "strNames"=>$User->strNames,
                    "strEmail"=>$User->strEmail,
                    "strPassword"=>$Encrypt->DecryptData($User->strPassword,'12345'),
                    "strTypeUser"=>$User->strTypeUser,
                    "strPhone"=>$User->strPhone,
                    "dtDateCreation"=>$User->dtDateCreation,
                    "dtDateUpdate"=>$User->dtDateUpdate
                    )
            );
           }
        
           $this->setResponseDataApi($ArrayUser);
        
           $ModelUser=null;
        }catch(Exeption $Error){
            throw $Error;
        }
    }
     //------------------
    // ACTUALIZAR USUARIO
    //------------------
    public function UpdateUser($Data){
        try{
            $ModelUser= new ClsUserModel();
            $Encrypt= new ClsEncrypt();

            $ModelUser->setStrIdUser($Data['_id']);
            $ModelUser->setStrName($Data['strNames']);
            $ModelUser->setStrPassword($Encrypt->EncryptData($Data['strPassword'],'12345'));
            $ModelUser->setStrPhone($Data['strPhone']);
            $ModelUser->setStrTypeUser($Data['strTypeUser']);
            $ModelUser->setDtUpdateUser(date("d/m/y T H:i:s"));
 
            //Creación usuario
            $ModelUser->UpdateUser();
 
            $ModelUser=null;
 
        }catch(Exeption $Error){
            throw $Error;
        }
     }
    //------------------
    // ELIMINAR USUARIO
    //------------------
    public function DeleteUser($Data){
        try{
            $ModelUser= new ClsUserModel();

            $ModelUser->setStrIdUser($Data['_id']);
            $ModelUser->DeleteUser();
 
            $ModelUser=null;
 
        }catch(Exeption $Error){
            throw $Error;
        }
     }

}
/*
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
require_once '../src/model/UserModel.php';


$app->post('/api/createuser', function (Request $request, Response $response, $args) {
  try{
      $UserModel= new ClUserModel();  
      $data=$request->getParsedBody();
    $response->getBody()->write(json_encode($data));
    return $response;
  }catch(Exeption $Error){
    $response->getBody()->write(json_encode(array("Success"=>false)));
    $response=$response->withStatus(500);
    return $response;
  }
});*/
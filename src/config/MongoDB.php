<?php
require_once '../src/helpers/Encrypt.php';
class ClsMongoDB{
    private $ConnectionDB;

    public function __construct(){
        $this->ConnectionDB=$this->ConnectionDB();
    }
    //-------------------
    // FUNCTION PRIVATES
    //-------------------

    public function getConnectionDB(){
        return $this->ConnectionDB;
    }

    private function ConnectionDB(){
        try{
            // conectarse
            $mongo = new MongoDB\Client('mongodb://localhost/BlogKonecta');
            //seleccionar
            $db = $mongo->BlogKonecta; 
            
            $Encrypt= new ClsEncrypt();
            $DataResult=$db->Users->findOne([
                'strEmail' =>'administrador@konecta.com',
            ]);
            if($DataResult==null){
                $db->Users->insertOne([
                    'strNames' => 'Administrador',
                    'strEmail' => 'administrador@konecta.com',
                    'strPassword' => $Encrypt->EncryptData('12345','12345'),
                    'strPhone' => '123456',
                    'strTypeUser'=> 'admin',
                    "dtDateCreation"=>date("d/m/y T H:i:s"),
                    "dtDateUpdate"=>date("d/m/y T H:i:s")
                ]);
            }
            //Categories
            $DataResult=$db->Categories->findOne([
                'strName' =>'Deporte',
            ]);
            if($DataResult==null){
                $db->Categories->insertOne([
                    'strName' => 'Deporte',
                ]);
                $db->Categories->insertOne([
                    'strName' => 'Cultura',
                ]);
                $db->Categories->insertOne([
                    'strName' => 'Ciencia',
                ]);
                $db->Categories->insertOne([
                    'strName' => 'Gastronomía',
                ]);
            }
            //$coleccion = $db->createCollection("Users");
            //$coleccion = $db->createCollection("Blogs");
           // echo 'Conexion correcta';
            return $db;
        }catch(Exeption $Error){
            throw $Error;
        }
    }
}